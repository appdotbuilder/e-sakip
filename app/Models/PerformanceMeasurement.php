<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PerformanceMeasurement
 *
 * @property int $id
 * @property int $performance_indicator_id
 * @property float $actual_value
 * @property float $target_value
 * @property float|null $achievement_percentage
 * @property \Illuminate\Support\Carbon $measurement_date
 * @property string|null $notes
 * @property array|null $supporting_documents
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PerformanceIndicator $performanceIndicator
 * @property-read \App\Models\User $creator
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement query()
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereAchievementPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereActualValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereMeasurementDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement wherePerformanceIndicatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereSupportingDocuments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereTargetValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceMeasurement whereUpdatedAt($value)
 * @method static \Database\Factories\PerformanceMeasurementFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class PerformanceMeasurement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'performance_indicator_id',
        'actual_value',
        'target_value',
        'achievement_percentage',
        'measurement_date',
        'notes',
        'supporting_documents',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'actual_value' => 'decimal:2',
        'target_value' => 'decimal:2',
        'achievement_percentage' => 'decimal:2',
        'measurement_date' => 'date',
        'supporting_documents' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the performance indicator that owns the measurement.
     */
    public function performanceIndicator(): BelongsTo
    {
        return $this->belongsTo(PerformanceIndicator::class);
    }

    /**
     * Get the user who created the measurement.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}