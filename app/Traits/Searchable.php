<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable
{
    /**
     * Scope a query to search across one or more attributes.
     *
     * Models using this trait define a protected `$searchable` array containing
     * local column names, or single-level relationship columns using dot notation
     * such as `ownerStaff.surname`. Relationship entries are searched with
     * `orWhereHas`, so deeper nesting and combined-name matching should be handled
     * explicitly in the owning service when needed.
     *
     * @param  array<int, string>|null  $attributes
     */
    public function scopeSearch(Builder $query, ?string $term, ?array $attributes = null): Builder
    {
        $term = is_string($term) ? trim($term) : null;

        if ($term === null || $term === '') {
            return $query;
        }

        $attributes ??= $this->searchableAttributes();

        if ($attributes === []) {
            return $query;
        }

        $query->where(function (Builder $query) use ($term, $attributes): void {
            foreach ($attributes as $attribute) {
                if (Str::contains($attribute, '.')) {
                    [$relation, $column] = explode('.', $attribute, 2);

                    $query->orWhereHas($relation, function (Builder $query) use ($column, $term): void {
                        $query->where($column, 'like', '%' . $term . '%');
                    });

                    continue;
                }

                $query->orWhere($query->getModel()->qualifyColumn($attribute), 'like', '%' . $term . '%');
            }
        });

        return $query;
    }

    /**
     * @return array<int, string>
     */
    protected function searchableAttributes(): array
    {
        return property_exists($this, 'searchable') && is_array($this->searchable)
            ? $this->searchable
            : [];
    }
}
