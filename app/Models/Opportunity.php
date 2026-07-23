<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $company_id
 * @property string $job_title
 * @property string|null $job_description
 * @property string|null $job_category
 * @property string|null $requirements
 * @property string|null $application_deadline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \App\Models\Company $company
 * @method static \Database\Factories\OpportunityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity whereApplicationDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity whereJobCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity whereJobDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Opportunity whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @mixin \Eloquent
 */
class Opportunity extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected function casts(): array
    {
        return [
            'application_deadline' => 'date',
        ];
    }



    // Realtionshiop / An opportunity belongs to a company

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
