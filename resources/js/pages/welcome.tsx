import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="E-SAKIP - Digital Performance Management System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
                {/* Navigation */}
                <nav className="relative z-10 flex items-center justify-between p-6 lg:px-8">
                    <div className="flex items-center space-x-3">
                        <div className="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold">
                            📊
                        </div>
                        <span className="text-xl font-bold text-gray-900 dark:text-white">E-SAKIP</span>
                    </div>
                    <div className="flex items-center space-x-4">
                        {auth.user ? (
                            <Link
                                href={route('dashboard')}
                                className="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:from-blue-700 hover:to-indigo-700 hover:shadow-xl"
                            >
                                Go to Dashboard
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={route('login')}
                                    className="rounded-xl border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-800"
                                >
                                    Sign In
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:from-blue-700 hover:to-indigo-700 hover:shadow-xl"
                                >
                                    Get Started
                                </Link>
                            </>
                        )}
                    </div>
                </nav>

                {/* Hero Section */}
                <div className="relative px-6 pt-14 lg:px-8">
                    <div className="mx-auto max-w-7xl">
                        <div className="text-center">
                            <h1 className="text-5xl font-bold tracking-tight text-gray-900 sm:text-7xl dark:text-white">
                                📈 E-SAKIP
                            </h1>
                            <p className="mt-4 text-2xl font-semibold text-gray-700 dark:text-gray-300">
                                Elektronik Sistem Akuntabilitas Kinerja Instansi Pemerintah
                            </p>
                            <p className="mx-auto mt-6 max-w-3xl text-lg leading-8 text-gray-600 dark:text-gray-400">
                                Comprehensive digital platform for integrated planning, reporting, and evaluation of government institution performance. Streamline your accountability processes with modern tools and analytics.
                            </p>
                            <div className="mt-10 flex items-center justify-center gap-x-6">
                                {!auth.user && (
                                    <>
                                        <Link
                                            href={route('register')}
                                            className="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-4 text-lg font-semibold text-white shadow-xl transition-all hover:from-blue-700 hover:to-indigo-700 hover:shadow-2xl"
                                        >
                                            Start Managing Performance 🚀
                                        </Link>
                                        <Link
                                            href={route('login')}
                                            className="text-lg font-semibold leading-6 text-gray-900 hover:text-indigo-600 dark:text-white dark:hover:text-indigo-400"
                                        >
                                            Learn more <span aria-hidden="true">→</span>
                                        </Link>
                                    </>
                                )}
                                {auth.user && (
                                    <Link
                                        href={route('dashboard')}
                                        className="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-4 text-lg font-semibold text-white shadow-xl transition-all hover:from-blue-700 hover:to-indigo-700 hover:shadow-2xl"
                                    >
                                        Access Your Dashboard 📊
                                    </Link>
                                )}
                            </div>
                        </div>

                        {/* Features Grid */}
                        <div className="mx-auto mt-20 max-w-6xl">
                            <h2 className="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-white">
                                🎯 Core Modules & Features
                            </h2>
                            <div className="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                                {/* Planning Module */}
                                <div className="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:scale-105 dark:bg-gray-800">
                                    <div className="flex items-center space-x-3 mb-4">
                                        <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-2xl">
                                            📋
                                        </div>
                                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white">Work Planning</h3>
                                    </div>
                                    <p className="text-gray-600 dark:text-gray-400">
                                        Manage Renstra, Renja, RPJMD, and Action Plans with integrated Performance Agreements and KPIs.
                                    </p>
                                    <div className="mt-4 flex flex-wrap gap-2">
                                        <span className="rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-800 dark:bg-blue-900 dark:text-blue-200">Strategic Plans</span>
                                        <span className="rounded-full bg-cyan-100 px-3 py-1 text-sm text-cyan-800 dark:bg-cyan-900 dark:text-cyan-200">KPIs</span>
                                    </div>
                                </div>

                                {/* Performance Measurement */}
                                <div className="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:scale-105 dark:bg-gray-800">
                                    <div className="flex items-center space-x-3 mb-4">
                                        <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 text-white text-2xl">
                                            📊
                                        </div>
                                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white">Performance Measurement</h3>
                                    </div>
                                    <p className="text-gray-600 dark:text-gray-400">
                                        Real-time input and visualization of performance achievements with advanced analytics and trending.
                                    </p>
                                    <div className="mt-4 flex flex-wrap gap-2">
                                        <span className="rounded-full bg-green-100 px-3 py-1 text-sm text-green-800 dark:bg-green-900 dark:text-green-200">Analytics</span>
                                        <span className="rounded-full bg-emerald-100 px-3 py-1 text-sm text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200">Visualization</span>
                                    </div>
                                </div>

                                {/* Performance Reporting */}
                                <div className="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:scale-105 dark:bg-gray-800">
                                    <div className="flex items-center space-x-3 mb-4">
                                        <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 text-white text-2xl">
                                            📄
                                        </div>
                                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white">Performance Reporting</h3>
                                    </div>
                                    <p className="text-gray-600 dark:text-gray-400">
                                        Generate comprehensive reports for regional apparatus and district-wide performance analysis.
                                    </p>
                                    <div className="mt-4 flex flex-wrap gap-2">
                                        <span className="rounded-full bg-purple-100 px-3 py-1 text-sm text-purple-800 dark:bg-purple-900 dark:text-purple-200">Reports</span>
                                        <span className="rounded-full bg-pink-100 px-3 py-1 text-sm text-pink-800 dark:bg-pink-900 dark:text-pink-200">Export</span>
                                    </div>
                                </div>

                                {/* Internal Evaluation */}
                                <div className="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:scale-105 dark:bg-gray-800">
                                    <div className="flex items-center space-x-3 mb-4">
                                        <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-orange-500 to-red-500 text-white text-2xl">
                                            🔍
                                        </div>
                                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white">Internal Evaluation</h3>
                                    </div>
                                    <p className="text-gray-600 dark:text-gray-400">
                                        Systematic evaluation framework based on data and documents with scoring and recommendations.
                                    </p>
                                    <div className="mt-4 flex flex-wrap gap-2">
                                        <span className="rounded-full bg-orange-100 px-3 py-1 text-sm text-orange-800 dark:bg-orange-900 dark:text-orange-200">Evaluation</span>
                                        <span className="rounded-full bg-red-100 px-3 py-1 text-sm text-red-800 dark:bg-red-900 dark:text-red-200">Scoring</span>
                                    </div>
                                </div>

                                {/* Thematic Logframe */}
                                <div className="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:scale-105 dark:bg-gray-800">
                                    <div className="flex items-center space-x-3 mb-4">
                                        <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-2xl">
                                            🌐
                                        </div>
                                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white">Thematic & Logframe</h3>
                                    </div>
                                    <p className="text-gray-600 dark:text-gray-400">
                                        Logical Framework methodology with thematic performance dashboards and achievement tracking.
                                    </p>
                                    <div className="mt-4 flex flex-wrap gap-2">
                                        <span className="rounded-full bg-indigo-100 px-3 py-1 text-sm text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">Logframe</span>
                                        <span className="rounded-full bg-purple-100 px-3 py-1 text-sm text-purple-800 dark:bg-purple-900 dark:text-purple-200">Thematic</span>
                                    </div>
                                </div>

                                {/* Security & Access Control */}
                                <div className="group relative overflow-hidden rounded-2xl bg-white p-8 shadow-xl transition-all hover:shadow-2xl hover:scale-105 dark:bg-gray-800">
                                    <div className="flex items-center space-x-3 mb-4">
                                        <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-gray-500 to-slate-600 text-white text-2xl">
                                            🔐
                                        </div>
                                        <h3 className="text-xl font-semibold text-gray-900 dark:text-white">Security & Authentication</h3>
                                    </div>
                                    <p className="text-gray-600 dark:text-gray-400">
                                        Role-based access control for System Admins, Officials, Evaluators, Field Staff, and Public users.
                                    </p>
                                    <div className="mt-4 flex flex-wrap gap-2">
                                        <span className="rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-800 dark:bg-gray-700 dark:text-gray-200">RBAC</span>
                                        <span className="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-800 dark:bg-slate-700 dark:text-slate-200">Secure</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* User Roles Section */}
                        <div className="mx-auto mt-20 max-w-6xl">
                            <h2 className="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-white">
                                👥 Key User Roles
                            </h2>
                            <div className="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
                                {[
                                    { role: 'System Admin', icon: '👨‍💻', color: 'from-red-500 to-pink-500' },
                                    { role: 'Regional Officials', icon: '🏛️', color: 'from-blue-500 to-indigo-500' },
                                    { role: 'Evaluators', icon: '🔍', color: 'from-green-500 to-emerald-500' },
                                    { role: 'Field Staff', icon: '👷‍♂️', color: 'from-orange-500 to-yellow-500' },
                                    { role: 'Public View', icon: '👥', color: 'from-purple-500 to-pink-500' },
                                ].map((item) => (
                                    <div key={item.role} className="text-center">
                                        <div className={`mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-r ${item.color} text-white text-2xl shadow-lg`}>
                                            {item.icon}
                                        </div>
                                        <p className="mt-3 text-sm font-semibold text-gray-900 dark:text-white">{item.role}</p>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* CTA Section */}
                        <div className="mx-auto mt-20 max-w-4xl text-center">
                            <div className="rounded-3xl bg-gradient-to-r from-blue-600 to-indigo-600 p-12 shadow-2xl">
                                <h2 className="text-3xl font-bold text-white sm:text-4xl">
                                    Ready to Transform Your Performance Management? 🚀
                                </h2>
                                <p className="mt-4 text-xl text-blue-100">
                                    Join government institutions already using E-SAKIP to streamline their accountability processes.
                                </p>
                                <div className="mt-8 flex flex-col items-center justify-center gap-4 sm:flex-row">
                                    {!auth.user && (
                                        <>
                                            <Link
                                                href={route('register')}
                                                className="rounded-xl bg-white px-8 py-4 text-lg font-semibold text-blue-600 shadow-lg transition-all hover:bg-gray-50 hover:shadow-xl"
                                            >
                                                Get Started Today
                                            </Link>
                                            <Link
                                                href={route('login')}
                                                className="rounded-xl border-2 border-white px-8 py-4 text-lg font-semibold text-white transition-all hover:bg-white hover:text-blue-600"
                                            >
                                                Sign In
                                            </Link>
                                        </>
                                    )}
                                    {auth.user && (
                                        <Link
                                            href={route('dashboard')}
                                            className="rounded-xl bg-white px-8 py-4 text-lg font-semibold text-blue-600 shadow-lg transition-all hover:bg-gray-50 hover:shadow-xl"
                                        >
                                            Go to Dashboard 📊
                                        </Link>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <footer className="mt-24 border-t border-gray-200 bg-white py-12 dark:border-gray-700 dark:bg-gray-900">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="flex flex-col items-center justify-between gap-4 sm:flex-row">
                            <div className="flex items-center space-x-3">
                                <div className="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold">
                                    📊
                                </div>
                                <span className="text-lg font-bold text-gray-900 dark:text-white">E-SAKIP</span>
                            </div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                Digital Performance Management for Government Institutions
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}