import { Head, Link, router } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';

interface Organization {
    id: number;
    name: string;
    code: string;
    type: string;
    status: string;
    users_count: number;
    strategic_plans_count: number;
    performance_reports_count: number;
    created_at: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginatedOrganizations {
    data: Organization[];
    links: PaginationLink[];
    current_page: number;
    last_page: number;
    total: number;
}

interface Filters {
    search?: string;
    type?: string;
    status?: string;
}

interface Props {
    organizations: PaginatedOrganizations;
    filters: Filters;
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Organizations', href: '/organizations' },
];

export default function OrganizationsIndex({ organizations, filters }: Props) {
    const getTypeDisplayName = (type: string) => {
        const typeMap: Record<string, string> = {
            regional_apparatus: 'Regional Apparatus',
            district_government: 'District Government',
        };
        return typeMap[type] || type;
    };

    const getStatusBadge = (status: string) => {
        const statusMap: Record<string, { color: string; text: string }> = {
            active: { color: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200', text: 'Active' },
            inactive: { color: 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200', text: 'Inactive' },
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
            <Head title="Organizations - E-SAKIP" />
            <div className="space-y-6 p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-white">🏛️ Organizations</h1>
                        <p className="mt-2 text-gray-600 dark:text-gray-400">
                            Manage government institutions and regional apparatus.
                        </p>
                    </div>
                    <Link
                        href={route('organizations.create')}
                        className="inline-flex items-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:from-blue-700 hover:to-indigo-700 hover:shadow-xl"
                    >
                        <span className="mr-2">➕</span>
                        Create Organization
                    </Link>
                </div>

                {/* Search and Filters */}
                <div className="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
                    <div className="grid gap-4 sm:grid-cols-3">
                        <input
                            type="text"
                            placeholder="Search organizations..."
                            defaultValue={filters.search || ''}
                            className="rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            onChange={(e) => {
                                router.get(route('organizations.index'), {
                                    ...filters,
                                    search: e.target.value,
                                }, {
                                    preserveState: true,
                                    preserveScroll: true,
                                });
                            }}
                        />
                        <select
                            defaultValue={filters.type || ''}
                            className="rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            onChange={(e) => {
                                router.get(route('organizations.index'), {
                                    ...filters,
                                    type: e.target.value,
                                }, {
                                    preserveState: true,
                                    preserveScroll: true,
                                });
                            }}
                        >
                            <option value="">All Types</option>
                            <option value="regional_apparatus">Regional Apparatus</option>
                            <option value="district_government">District Government</option>
                        </select>
                        <select
                            defaultValue={filters.status || ''}
                            className="rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            onChange={(e) => {
                                router.get(route('organizations.index'), {
                                    ...filters,
                                    status: e.target.value,
                                }, {
                                    preserveState: true,
                                    preserveScroll: true,
                                });
                            }}
                        >
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                {/* Organizations Grid */}
                <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    {organizations.data.map((organization) => (
                        <div key={organization.id} className="rounded-2xl bg-white p-6 shadow-lg transition-all hover:shadow-xl dark:bg-gray-800">
                            <div className="flex items-start justify-between">
                                <div className="flex items-center space-x-3">
                                    <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-blue-500 to-indigo-500 text-white text-xl">
                                        {organization.type === 'district_government' ? '🏛️' : '🏢'}
                                    </div>
                                    <div>
                                        <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                            {organization.name}
                                        </h3>
                                        <p className="text-sm text-gray-500 dark:text-gray-400">
                                            {organization.code}
                                        </p>
                                    </div>
                                </div>
                                {getStatusBadge(organization.status)}
                            </div>
                            
                            <div className="mt-4">
                                <p className="text-sm text-gray-600 dark:text-gray-400">
                                    {getTypeDisplayName(organization.type)}
                                </p>
                            </div>

                            <div className="mt-4 grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <p className="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                        {organization.users_count}
                                    </p>
                                    <p className="text-xs text-gray-500 dark:text-gray-400">Users</p>
                                </div>
                                <div>
                                    <p className="text-2xl font-bold text-green-600 dark:text-green-400">
                                        {organization.strategic_plans_count}
                                    </p>
                                    <p className="text-xs text-gray-500 dark:text-gray-400">Plans</p>
                                </div>
                                <div>
                                    <p className="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                        {organization.performance_reports_count}
                                    </p>
                                    <p className="text-xs text-gray-500 dark:text-gray-400">Reports</p>
                                </div>
                            </div>

                            <div className="mt-6 flex space-x-2">
                                <Link
                                    href={route('organizations.show', organization.id)}
                                    className="flex-1 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-2 text-center text-sm font-semibold text-white transition-all hover:from-blue-600 hover:to-blue-700"
                                >
                                    View Details
                                </Link>
                                <Link
                                    href={route('organizations.edit', organization.id)}
                                    className="flex-1 rounded-xl border border-gray-300 px-4 py-2 text-center text-sm font-semibold text-gray-700 transition-all hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                                >
                                    Edit
                                </Link>
                            </div>
                        </div>
                    ))}
                </div>

                {organizations.data.length === 0 && (
                    <div className="rounded-2xl bg-white p-12 text-center shadow-lg dark:bg-gray-800">
                        <div className="text-6xl mb-4">🏛️</div>
                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            No organizations found
                        </h3>
                        <p className="text-gray-600 dark:text-gray-400 mb-6">
                            Get started by creating your first organization.
                        </p>
                        <Link
                            href={route('organizations.create')}
                            className="inline-flex items-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:from-blue-700 hover:to-indigo-700 hover:shadow-xl"
                        >
                            <span className="mr-2">➕</span>
                            Create Organization
                        </Link>
                    </div>
                )}

                {/* Pagination */}
                {organizations.data.length > 0 && (
                    <div className="rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
                        <div className="flex items-center justify-between">
                            <p className="text-sm text-gray-700 dark:text-gray-300">
                                Showing {((organizations.current_page - 1) * 10) + 1} to {Math.min(organizations.current_page * 10, organizations.total)} of {organizations.total} results
                            </p>
                            <div className="flex space-x-2">
                                {organizations.links.map((link, index) => (
                                    <button
                                        key={index}
                                        onClick={() => link.url && router.get(link.url)}
                                        disabled={!link.url}
                                        className={`px-3 py-2 rounded-lg text-sm font-medium ${
                                            link.active
                                                ? 'bg-blue-600 text-white'
                                                : link.url
                                                ? 'bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600'
                                                : 'bg-gray-100 text-gray-400 cursor-not-allowed dark:bg-gray-700 dark:text-gray-500'
                                        }`}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                ))}
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}