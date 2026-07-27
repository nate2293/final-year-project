<?php

namespace App\Models;

use App\Traits\FileUpload;
use App\Enums\ActivityType;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $student_id
 * @property int $opportunity_id
 * @property string $application_date
 * @property string $status
 * @property string|null $cover_letter
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cv|null $cv
 * @property-read \App\Models\Opportunity $opportunity
 * @property-read \App\Models\Student $student
 * @method static \Database\Factories\ApplicationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereApplicationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCoverLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereOpportunityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Application whereUpdatedAt($value)
 * @property ActivityType $activity_type
 * @property \Illuminate\Support\Carbon|null $activity_date
 * @property string|null $notes
 * @property string|null $evidence_link
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereActivityDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereActivityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereEvidenceLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity whereNotes($value)
 * @property-read array $config_for
 * @property-read string $default_file
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Activity sortable($column = 'id', $direction = 'asc', array|string|null $default = null)
 * @mixin \Eloquent
 */
class Activity extends Model
{
    use HasFactory, FileUpload, Sortable;

    /**
     * Define one or many file attributes.
     */

    protected function fileUploads(): array
    {
        return [
            'evidence_link' => [ 'as_base64' => false, ],
        ];
    }

    protected $fillable = [
        'student_id',
        'opportunity_id',
        'activity_type',
        'activity_date',
        'notes',
        'evidence_link',
    ];

    protected $sortable = [
        'opportunity_id' => 'opportunity_id, activity_date',
        'activity_type',
        'activity_date',
    ];

    protected $guarded = [
        'id'
    ];

    protected function casts()
    {
        return [
            'activity_type' => ActivityType::class,
            'activity_date' => 'date',
        ];
    }

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
