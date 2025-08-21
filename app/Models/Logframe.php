<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Logframe
 *
 * @property int $id
 * @property int $organization_id
 * @property string $title
 * @property string|null $goal
 * @property array|null $outcomes
 * @property array|null $outputs
 * @property array|null $activities
 * @property array|null $assumptions
 * @property array|null $risks
 * @property string $status
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Organization $organization
 * @property-read \App\Models\User $creator
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereAssumptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereOutcomes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereOutputs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereRisks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Logframe whereUpdatedAt($value)

 * 
 * @mixin \Eloquent
 */
class Logframe extends Model
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
        'goal',
        'outcomes',
        'outputs',
        'activities',
        'assumptions',
        'risks',
        'status',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'outcomes' => 'array',
        'outputs' => 'array',
        'activities' => 'array',
        'assumptions' => 'array',
        'risks' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the organization that owns the logframe.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the user who created the logframe.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}