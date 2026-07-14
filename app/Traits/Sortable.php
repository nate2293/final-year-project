<?php

namespace App\Traits;

use BadMethodCallException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * Scope queries using local columns or direct BelongsTo / HasOne relationship columns.
 *
 * Models may define a protected `$sortable` array to describe the public sort keys
 * accepted from request input. Numeric entries allow a key directly, while
 * associative entries map a public key to the actual sort expression:
 *
 * protected array $sortable = [
 *     'name',
 *     'surname' => 'surname,forename',
 *     'owner' => 'ownerStaff.surname,ownerStaff.forename',
 * ];
 *
 * If a model does not define `$sortable`, the trait keeps the legacy permissive
 * behaviour and attempts to sort by the provided column expression.
 */
trait Sortable
{
    /**
     * @param  string|array<int, string>|null  $column
     * @param  string|array<int, string>|null  $default
     *
     * @throws \Exception
     */
    public function scopeSortable(Builder $query, $column = 'id', $direction = 'asc', string|array|null $default = null): Builder
    {
        if (is_null($column)) {
            return $query;
        }

        $column = $this->sortableColumn($column, $default);
        $joinedRelations = [];

        foreach ($this->sortableColumns($column) as $sortColumn) {
            $query = $this->applySortableColumn($query, $sortColumn, $direction, $joinedRelations);
        }

        return $query;
    }

    /**
     * @param  string|array<int, string>  $column
     * @param  string|array<int, string>|null  $default
     * @return string|array<int, string>
     */
    private function sortableColumn(string|array $column, string|array|null $default): string|array
    {
        if (! property_exists($this, 'sortable') || ! is_array($this->sortable)) {
            return $column;
        }

        if (is_array($column)) {
            return $column;
        }

        if (array_key_exists($column, $this->sortable)) {
            return $this->sortable[$column];
        }

        if (in_array($column, $this->sortable, true)) {
            return $column;
        }

        if ($default !== null) {
            return $this->sortableColumn($default, null);
        }

        return 'id';
    }

    /**
     * @param  string|array<int, string>  $column
     * @return array<int, string>
     */
    private function sortableColumns(string|array $column): array
    {
        $columns = is_array($column) ? $column : explode(',', $column);

        return array_values(array_filter(
            array_map(fn($sortColumn): string => trim((string) $sortColumn), $columns),
            fn(string $sortColumn): bool => $sortColumn !== ''
        ));
    }

    /**
     * @param  array<int, string>  $joinedRelations
     *
     * @throws \Exception
     */
    private function applySortableColumn(Builder $query, string $column, string $direction, array &$joinedRelations): Builder
    {
        $model = $this;
        $relationName = null;
        $sortColumn = $column;

        // handle relationship column in 'relation.column' format
        $explodeResult = self::explodeSortParameter($column);
        if (! empty($explodeResult)) {
            $relationName = $explodeResult[0];
            $sortColumn = $explodeResult[1];

            // check for existence of relationship
            try {
                $relation = $query->getRelation($relationName);
                if (! in_array($relationName, $joinedRelations, true)) {
                    $query = $this->queryJoinBuilder($query, $relation);
                    $joinedRelations[] = $relationName;
                }
            } catch (BadMethodCallException $e) {
                throw new \Exception($relationName, 1, $e);
            } catch (\Exception $e) {
                throw new \Exception("Non-existent relation - {$relationName}", 2, $e);
            }
            $model = $relation->getRelated();
        }

        // check for existence of column
        if (Schema::connection($model->getConnectionName())->hasColumn($model->getTable(), $sortColumn)) {
            $column = $model->getTable() . '.' . $sortColumn;
            $query = $query->orderBy($column, $direction);
        } else {
            throw new \Exception("Non-existent column - {$column}");
        }

        return $query;
    }

    /**
     * @throws \Exception
     */
    private function queryJoinBuilder(Builder $query, BelongsTo|HasOne $relation): Builder
    {
        $relatedTable = $relation->getRelated()->getTable();
        $parentTable = $relation->getParent()->getTable();

        if ($parentTable === $relatedTable) {
            $query = $query->from($parentTable . ' as parent_' . $parentTable);
            $parentTable = 'parent_' . $parentTable;
            $relation->getParent()->setTable($parentTable);
        }

        if ($relation instanceof HasOne) {
            $relatedPrimaryKey = $relation->getQualifiedForeignKeyName();
            $parentPrimaryKey = $relation->getQualifiedParentKeyName();
        } elseif ($relation instanceof BelongsTo) {
            $relatedPrimaryKey = $relation->getQualifiedOwnerKeyName();
            $parentPrimaryKey = $relation->getQualifiedForeignKeyName();
        } else {
            throw new \Exception;
        }

        return $this->formJoin($query, $parentTable, $relatedTable, $parentPrimaryKey, $relatedPrimaryKey);
    }

    /**
     * @param  Builder<Model>  $query
     */
    private function formJoin(Builder $query, string $parentTable, string $relatedTable, string $parentPrimaryKey, string $relatedPrimaryKey): Builder
    {
        $joinType = 'leftJoin';

        return $query->select($parentTable . '.*')->{$joinType}($relatedTable, $parentPrimaryKey, '=', $relatedPrimaryKey);
    }

    /**
     * Explodes parameter if possible and returns array [column, relation]
     * Empty array is returned if explode could not run eg: separator was not found.
     *
     *
     * @return array
     *
     * @throws \Exception
     */
    public static function explodeSortParameter($parameter)
    {
        $separator = '.';

        if (Str::contains($parameter, $separator)) {
            $oneToOneSort = explode($separator, $parameter);
            if (count($oneToOneSort) !== 2) {
                throw new \Exception('Column could not be exploded');
            }

            return $oneToOneSort;
        }

        return [];
    }
}
