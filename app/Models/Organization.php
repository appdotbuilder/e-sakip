<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Organization
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $type
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StrategicPlan> $strategicPlans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PerformanceReport> $performanceReports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Evaluation> $evaluations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Logframe> $logframes
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization query()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organization active()
 * @method static \Database\Factories\OrganizationFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'type',
        'description',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the strategic plans for the organization.
     */
    public function strategicPlans(): HasMany
    {
        return $this->hasMany(StrategicPlan::class);
    }

    /**
     * Get the performance reports for the organization.
     */
    public function performanceReports(): HasMany
    {
        return $this->hasMany(PerformanceReport::class);
    }

    /**
     * Get the evaluations for the organization.
     */
    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * Get the logframes for the organization.
     */
    public function logframes(): HasMany
    {
        return $this->hasMany(Logframe::class);
    }

    /**
     * Get the users for the organization.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope a query to only include active organizations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}