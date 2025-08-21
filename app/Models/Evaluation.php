<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Evaluation
 *
 * @property int $id
 * @property int $organization_id
 * @property int|null $performance_report_id
 * @property string $title
 * @property string $type
 * @property string|null $evaluation_criteria
 * @property array|null $findings
 * @property array|null $recommendations
 * @property float|null $overall_score
 * @property string $status
 * @property int $evaluator_id
 * @property \Illuminate\Support\Carbon $evaluation_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Organization $organization
 * @property-read \App\Models\PerformanceReport|null $performanceReport
 * @property-read \App\Models\User $evaluator
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereEvaluationCriteria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereEvaluationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereEvaluatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereFindings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereOverallScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation wherePerformanceReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereRecommendations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class Evaluation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'organization_id',
        'performance_report_id',
        'title',
        'type',
        'evaluation_criteria',
        'findings',
        'recommendations',
        'overall_score',
        'status',
        'evaluator_id',
        'evaluation_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'findings' => 'array',
        'recommendations' => 'array',
        'overall_score' => 'decimal:2',
        'evaluation_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the organization that owns the evaluation.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the performance report associated with the evaluation.
     */
    public function performanceReport(): BelongsTo
    {
        return $this->belongsTo(PerformanceReport::class);
    }

    /**
     * Get the user who conducted the evaluation.
     */
    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}