<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\PerformanceReport
 *
 * @property int $id
 * @property int $organization_id
 * @property string $title
 * @property string $type
 * @property \Illuminate\Support\Carbon $period_start
 * @property \Illuminate\Support\Carbon $period_end
 * @property array|null $report_data
 * @property string|null $executive_summary
 * @property string $status
 * @property int $created_by
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Organization $organization
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\User|null $approver
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Evaluation> $evaluations
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereExecutiveSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport wherePeriodEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport wherePeriodStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereReportData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PerformanceReport whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class PerformanceReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'organization_id',
        'title',
        'type',
        'period_start',
        'period_end',
        'report_data',
        'executive_summary',
        'status',
        'created_by',
        'approved_by',
        'approved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'report_data' => 'array',
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the organization that owns the report.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the user who created the report.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who approved the report.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the evaluations for the report.
     */
    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class);
    }
}