<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrganizationController extends Controller
{
    /**
     * Display a listing of organizations.
     */
    public function index(Request $request)
    {
        $organizations = Organization::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            })
            ->when($request->type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->withCount(['users', 'strategicPlans', 'performanceReports'])
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('organizations/index', [
            'organizations' => $organizations,
            'filters' => $request->only(['search', 'type', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new organization.
     */
    public function create()
    {
        return Inertia::render('organizations/create');
    }

    /**
     * Store a newly created organization.
     */
    public function store(StoreOrganizationRequest $request)
    {
        $organization = Organization::create($request->validated());

        return redirect()->route('organizations.show', $organization)
            ->with('success', 'Organization created successfully.');
    }

    /**
     * Display the specified organization.
     */
    public function show(Organization $organization)
    {
        $organization->load([
            'strategicPlans.performanceIndicators',
            'performanceReports' => function ($query) {
                $query->latest()->limit(5);
            },
            'evaluations' => function ($query) {
                $query->latest()->limit(3);
            },
            'users' => function ($query) {
                $query->limit(10);
            }
        ]);

        return Inertia::render('organizations/show', [
            'organization' => $organization,
        ]);
    }

    /**
     * Show the form for editing the organization.
     */
    public function edit(Organization $organization)
    {
        return Inertia::render('organizations/edit', [
            'organization' => $organization,
        ]);
    }

    /**
     * Update the specified organization.
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $organization->update($request->validated());

        return redirect()->route('organizations.show', $organization)
            ->with('success', 'Organization updated successfully.');
    }

    /**
     * Remove the specified organization.
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return redirect()->route('organizations.index')
            ->with('success', 'Organization deleted successfully.');
    }
}