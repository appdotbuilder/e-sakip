<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\StrategicPlan
 *
 * @property int $id
 * @property int $organization_id
 * @property string $name
 * @property string $type
 * @property int $start_year
 * @property int $end_year
 * @property string|null $description
 * @property array|null $objectives
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Organization $organization
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PerformanceIndicator> $performanceIndicators
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereEndYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereObjectives($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereStartYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StrategicPlan whereUpdatedAt($value)
 * @method static \Database\Factories\StrategicPlanFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class StrategicPlan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'organization_id',
        'name',
        'type',
        'start_year',
        'end_year',
        'description',
        'objectives',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'objectives' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the organization that owns the strategic plan.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the performance indicators for the strategic plan.
     */
    public function performanceIndicators(): HasMany
    {
        return $this->hasMany(PerformanceIndicator::class);
    }
}