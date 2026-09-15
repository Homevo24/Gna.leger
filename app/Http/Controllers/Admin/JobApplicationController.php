<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $jobApplications = JobApplication::when(
            $status && array_key_exists($status, JobApplication::STATUSES),
            fn ($query) => $query->where('status', $status)
        )
            ->orderBy('applied_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.job-applications.index', [
            'jobApplications' => $jobApplications,
            'statusLabels' => JobApplication::STATUSES,
            'activeStatus' => $status,
        ]);
    }

    public function create(): View
    {
        return view('admin.job-applications.create', [
            'jobApplication' => new JobApplication(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateJobApplication($request);

        JobApplication::create($validated);

        return redirect()
            ->route('admin.job-applications.index')
            ->with('status', 'Candidature créée avec succès.');
    }

    public function show(JobApplication $jobApplication): RedirectResponse
    {
        return redirect()->route('admin.job-applications.edit', $jobApplication);
    }

    public function edit(JobApplication $jobApplication): View
    {
        return view('admin.job-applications.edit', [
            'jobApplication' => $jobApplication,
        ]);
    }

    public function update(Request $request, JobApplication $jobApplication): RedirectResponse
    {
        $validated = $this->validateJobApplication($request);

        $jobApplication->update($validated);

        return redirect()
            ->route('admin.job-applications.index')
            ->with('status', 'Candidature mise à jour avec succès.');
    }

    public function destroy(JobApplication $jobApplication): RedirectResponse
    {
        $jobApplication->delete();

        return redirect()
            ->route('admin.job-applications.index')
            ->with('status', 'Candidature supprimée.');
    }

    protected function validateJobApplication(Request $request): array
    {
        return $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:' . implode(',', array_keys(JobApplication::STATUSES))],
            'applied_at' => ['required', 'date'],
            'salary_range' => ['nullable', 'string', 'max:255'],
            'offer_url' => ['nullable', 'url', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);
    }
}
