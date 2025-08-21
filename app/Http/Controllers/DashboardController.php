<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Organization;
use App\Models\PerformanceIndicator;
use App\Models\PerformanceMeasurement;
use App\Models\PerformanceReport;
use App\Models\StrategicPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $userOrganization = $user->organization;
        
        // Get dashboard statistics
        $stats = [
            'total_organizations' => Organization::active()->count(),
            'total_strategic_plans' => StrategicPlan::count(),
            'total_indicators' => PerformanceIndicator::count(),
            'total_reports' => PerformanceReport::count(),
            'total_evaluations' => Evaluation::count(),
        ];

        // Get recent performance measurements
        $recentMeasurements = PerformanceMeasurement::with(['performanceIndicator.strategicPlan.organization', 'creator'])
            ->when($userOrganization, function ($query) use ($userOrganization) {
                $query->whereHas('performanceIndicator.strategicPlan', function ($subQuery) use ($userOrganization) {
                    $subQuery->where('organization_id', $userOrganization->id);
                });
            })
            ->latest()
            ->limit(5)
            ->get();

        // Get performance trends (last 6 months)
        $performanceTrends = PerformanceMeasurement::selectRaw("
                strftime('%Y-%m', measurement_date) as month,
                AVG(achievement_percentage) as avg_achievement
            ")
            ->when($userOrganization, function ($query) use ($userOrganization) {
                $query->whereHas('performanceIndicator.strategicPlan', function ($subQuery) use ($userOrganization) {
                    $subQuery->where('organization_id', $userOrganization->id);
                });
            })
            ->where('measurement_date', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Get active strategic plans
        $activeStrategicPlans = StrategicPlan::with(['organization', 'performanceIndicators'])
            ->when($userOrganization, function ($query) use ($userOrganization) {
                $query->where('organization_id', $userOrganization->id);
            })
            ->where('status', 'active')
            ->latest()
            ->limit(3)
            ->get();

        // Get recent evaluations
        $recentEvaluations = Evaluation::with(['organization', 'evaluator'])
            ->when($userOrganization, function ($query) use ($userOrganization) {
                $query->where('organization_id', $userOrganization->id);
            })
            ->latest()
            ->limit(3)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'recentMeasurements' => $recentMeasurements,
            'performanceTrends' => $performanceTrends,
            'activeStrategicPlans' => $activeStrategicPlans,
            'recentEvaluations' => $recentEvaluations,
            'userRole' => $user->role,
            'userOrganization' => $userOrganization,
        ]);
    }
}