import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';

interface DashboardStats {
    total_organizations: number;
    total_strategic_plans: number;
    total_indicators: number;
    total_reports: number;
    total_evaluations: number;
}

interface PerformanceMeasurement {
    id: number;
    actual_value: number;
    target_value: number;
    achievement_percentage: number;
    measurement_date: string;
    performance_indicator: {
        name: string;
        unit: string;
        strategic_plan: {
            name: string;
            organization: {
                name: string;
            };
        };
    };
    creator: {
        name: string;
    };
}

interface PerformanceTrend {
    month: string;
    avg_achievement: number;
}

interface StrategicPlan {
    id: number;
    name: string;
    type: string;
    start_year: number;
    end_year: number;
    status: string;
    organization: {
        name: string;
    };
    performance_indicators: Array<{
        id: number;
        name: string;
    }>;
}

interface Evaluation {
    id: number;
    title: string;
    type: string;
    overall_score: number;
    status: string;
    evaluation_date: string;
    organization: {
        name: string;
    };
    evaluator: {
        name: string;
    };
}

interface Organization {
    id: number;
    name: string;
    type: string;
}

interface Props {
    stats: DashboardStats;
    recentMeasurements: PerformanceMeasurement[];
    performanceTrends: PerformanceTrend[];
    activeStrategicPlans: StrategicPlan[];
    recentEvaluations: Evaluation[];
    userRole: string;
    userOrganization: Organization | null;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({
    stats,
    recentMeasurements,
    performanceTrends,
    activeStrategicPlans,
    recentEvaluations,
    userRole,
    userOrganization,
}: Props) {
    const formatPercentage = (value: number) => {
        return `${value.toFixed(1)}%`;
    };

    const getRoleDisplayName = (role: string) => {
        const roleMap: Record<string, string> = {
            system_admin: 'System Administrator',
            regional_official: 'Regional Official',
            regional_staff: 'Regional Staff',
            evaluator: 'Evaluator',
            inspector: 'Inspector',
            field_staff: 'Field Staff',
            public: 'Public User',
        };
        return roleMap[role] || role;
    };

    const getStatusBadge = (status: string) => {
        const statusMap: Record<string, { color: string; text: string }> = {
            active: { color: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200', text: 'Active' },
            draft: { color: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200', text: 'Draft' },
            completed: { color: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200', text: 'Completed' },
            in_progress: { color: 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200', text: 'In Progress' },
        };
        const status_config = statusMap[status] || { color: 'bg-gray-100 text-gray-800', text: status };
        return (
            <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${status_config.color}`}>
                {status_config.text}
            </span>
        );
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="E-SAKIP Dashboard" />
            <div className="space-y-6 p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">📊 E-SAKIP Dashboard</h1>
                        <p className="mt-2 text-gray-600 dark:text-gray-400">
                            Welcome back! Here's your performance management overview.
                        </p>
                        {userOrganization && (
                            <p className="mt-1 text-sm text-indigo-600 dark:text-indigo-400">
                                {getRoleDisplayName(userRole)} • {userOrganization.name}
                            </p>
                        )}
                    </div>
                    <div className="text-right">
                        <p className="text-sm text-gray-500 dark:text-gray-400">
                            {new Date().toLocaleDateString('id-ID', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                            })}
                        </p>
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                    <div className="overflow-hidden rounded-2xl bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white shadow-lg">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-blue-100">Organizations</p>
                                <p className="text-3xl font-bold">{stats.total_organizations}</p>
                            </div>
                            <div className="text-4xl">🏛️</div>
                        </div>
                    </div>
                    <div className="overflow-hidden rounded-2xl bg-gradient-to-r from-green-500 to-green-600 p-6 text-white shadow-lg">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-green-100">Strategic Plans</p>
                                <p className="text-3xl font-bold">{stats.total_strategic_plans}</p>
                            </div>
                            <div className="text-4xl">📋</div>
                        </div>
                    </div>
                    <div className="overflow-hidden rounded-2xl bg-gradient-to-r from-purple-500 to-purple-600 p-6 text-white shadow-lg">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-purple-100">KPIs</p>
                                <p className="text-3xl font-bold">{stats.total_indicators}</p>
                            </div>
                            <div className="text-4xl">📊</div>
                        </div>
                    </div>
                    <div className="overflow-hidden rounded-2xl bg-gradient-to-r from-orange-500 to-orange-600 p-6 text-white shadow-lg">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-orange-100">Reports</p>
                                <p className="text-3xl font-bold">{stats.total_reports}</p>
                            </div>
                            <div className="text-4xl">📄</div>
                        </div>
                    </div>
                    <div className="overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-500 to-indigo-600 p-6 text-white shadow-lg">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-indigo-100">Evaluations</p>
                                <p className="text-3xl font-bold">{stats.total_evaluations}</p>
                            </div>
                            <div className="text-4xl">🔍</div>
                        </div>
                    </div>
                </div>

                {/* Main Content Grid */}
                <div className="grid gap-6 lg:grid-cols-2">
                    {/* Performance Trends */}
                    <div className="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-4">📈 Performance Trends</h3>
                        {performanceTrends.length > 0 ? (
                            <div className="space-y-3">
                                {performanceTrends.map((trend) => (
                                    <div key={trend.month} className="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                        <span className="text-sm font-medium text-gray-700 dark:text-gray-300">
                                            {new Date(trend.month + '-01').toLocaleDateString('id-ID', { month: 'long', year: 'numeric' })}
                                        </span>
                                        <div className="flex items-center space-x-2">
                                            <div className="w-24 bg-gray-200 rounded-full h-2 dark:bg-gray-600">
                                                <div
                                                    className="bg-gradient-to-r from-green-500 to-blue-500 h-2 rounded-full transition-all duration-300"
                                                    style={{ width: `${Math.min(100, trend.avg_achievement)}%` }}
                                                ></div>
                                            </div>
                                            <span className="text-sm font-semibold text-gray-900 dark:text-white">
                                                {formatPercentage(trend.avg_achievement)}
                                            </span>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        ) : (
                            <p className="text-gray-500 dark:text-gray-400 text-center py-8">
                                No performance data available yet.
                            </p>
                        )}
                    </div>

                    {/* Recent Measurements */}
                    <div className="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-4">📊 Recent Measurements</h3>
                        {recentMeasurements.length > 0 ? (
                            <div className="space-y-3">
                                {recentMeasurements.map((measurement) => (
                                    <div key={measurement.id} className="border-l-4 border-blue-500 pl-4 py-2">
                                        <div className="flex items-center justify-between">
                                            <div>
                                                <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                    {measurement.performance_indicator.name}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                                    {measurement.performance_indicator.strategic_plan.organization.name}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {measurement.actual_value} {measurement.performance_indicator.unit}
                                                </p>
                                                <p className={`text-xs ${
                                                    measurement.achievement_percentage >= 80 
                                                        ? 'text-green-600' 
                                                        : measurement.achievement_percentage >= 60 
                                                        ? 'text-yellow-600' 
                                                        : 'text-red-600'
                                                }`}>
                                                    {formatPercentage(measurement.achievement_percentage)}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        ) : (
                            <p className="text-gray-500 dark:text-gray-400 text-center py-8">
                                No measurements available yet.
                            </p>
                        )}
                    </div>
                </div>

                {/* Bottom Grid */}
                <div className="grid gap-6 lg:grid-cols-2">
                    {/* Active Strategic Plans */}
                    <div className="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-4">📋 Active Strategic Plans</h3>
                        {activeStrategicPlans.length > 0 ? (
                            <div className="space-y-3">
                                {activeStrategicPlans.map((plan) => (
                                    <div key={plan.id} className="p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                                        <div className="flex items-start justify-between">
                                            <div className="flex-1">
                                                <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                    {plan.name}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                                    {plan.organization.name} • {plan.start_year}-{plan.end_year}
                                                </p>
                                                <p className="text-xs text-indigo-600 dark:text-indigo-400 mt-1">
                                                    {plan.performance_indicators.length} KPIs
                                                </p>
                                            </div>
                                            {getStatusBadge(plan.status)}
                                        </div>
                                    </div>
                                ))}
                            </div>
                        ) : (
                            <p className="text-gray-500 dark:text-gray-400 text-center py-8">
                                No active strategic plans found.
                            </p>
                        )}
                    </div>

                    {/* Recent Evaluations */}
                    <div className="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-4">🔍 Recent Evaluations</h3>
                        {recentEvaluations.length > 0 ? (
                            <div className="space-y-3">
                                {recentEvaluations.map((evaluation) => (
                                    <div key={evaluation.id} className="p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                                        <div className="flex items-start justify-between">
                                            <div className="flex-1">
                                                <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                    {evaluation.title}
                                                </p>
                                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                                    {evaluation.organization.name} • {evaluation.evaluator.name}
                                                </p>
                                                {evaluation.overall_score && (
                                                    <p className="text-xs text-green-600 dark:text-green-400 mt-1">
                                                        Score: {evaluation.overall_score}/100
                                                    </p>
                                                )}
                                            </div>
                                            {getStatusBadge(evaluation.status)}
                                        </div>
                                    </div>
                                ))}
                            </div>
                        ) : (
                            <p className="text-gray-500 dark:text-gray-400 text-center py-8">
                                No evaluations found.
                            </p>
                        )}
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 p-6 shadow-lg">
                    <h3 className="text-xl font-semibold text-white mb-4">🚀 Quick Actions</h3>
                    <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <button className="flex items-center space-x-3 rounded-xl bg-white bg-opacity-20 p-4 text-white transition-all hover:bg-opacity-30">
                            <span className="text-2xl">📋</span>
                            <span className="text-sm font-medium">Create Strategic Plan</span>
                        </button>
                        <button className="flex items-center space-x-3 rounded-xl bg-white bg-opacity-20 p-4 text-white transition-all hover:bg-opacity-30">
                            <span className="text-2xl">📊</span>
                            <span className="text-sm font-medium">Add Performance Data</span>
                        </button>
                        <button className="flex items-center space-x-3 rounded-xl bg-white bg-opacity-20 p-4 text-white transition-all hover:bg-opacity-30">
                            <span className="text-2xl">📄</span>
                            <span className="text-sm font-medium">Generate Report</span>
                        </button>
                        <button className="flex items-center space-x-3 rounded-xl bg-white bg-opacity-20 p-4 text-white transition-all hover:bg-opacity-30">
                            <span className="text-2xl">🔍</span>
                            <span className="text-sm font-medium">Start Evaluation</span>
                        </button>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}