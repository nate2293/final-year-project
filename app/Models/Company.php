<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $company_id
 * @property string $company_name
 * @property string $company_email
 * @property string|null $company_address
 * @property string|null $company_location
 * @property string|null $industry
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Opportunity> $opportunities
 * @property-read int|null $opportunities_count
 * @method static \Database\Factories\CompanyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereUpdatedAt($value)
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereId($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected function casts()
    {
        return [
            
        ];
    }

    // A company can have many opportunites -> opportunites.company_id -> companys.company_id
    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }
}
