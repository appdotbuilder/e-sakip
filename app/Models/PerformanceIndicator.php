<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\PerformanceIndicator
 *
 * @property int $id
 * @property int $strategic_plan_id
 * @property string $name
 * @property string $code
 * @property string|null $definition
 * @property string|null $unit
 * @property float|null $target_value
 * @property string $type
 * @property string $measurement_frequency
 * @property array|null $cascading_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\StrategicPlan $strategicPlan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PerformanceMeasurement> $measurements
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator query()
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereCascadingData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereDefinition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereMeasurementFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereStrategicPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereTargetValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceIndicator whereUpdatedAt($value)
 * @method static \Database\Factories\PerformanceIndicatorFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class PerformanceIndicator extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'strategic_plan_id',
        'name',
        'code',
        'definition',
        'unit',
        'target_value',
        'type',
        'measurement_frequency',
        'cascading_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'target_value' => 'decimal:2',
        'cascading_data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the strategic plan that owns the performance indicator.
     */
    public function strategicPlan(): BelongsTo
    {
        return $this->belongsTo(StrategicPlan::class);
    }

    /**
     * Get the measurements for the performance indicator.
     */
    public function measurements(): HasMany
    {
        return $this->hasMany(PerformanceMeasurement::class);
    }
}