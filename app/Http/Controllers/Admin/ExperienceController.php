<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::orderBy('start_date', 'desc')->paginate(15);

        return view('admin.experiences.index', [
            'experiences' => $experiences,
        ]);
    }

    public function create(): View
    {
        return view('admin.experiences.create', [
            'experience' => new Experience(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateExperience($request);

        Experience::create($validated);

        return redirect()
            ->route('admin.experiences.index')
            ->with('status', 'Expérience créée avec succès.');
    }

    public function show(Experience $experience): RedirectResponse
    {
        return redirect()->route('admin.experiences.edit', $experience);
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', [
            'experience' => $experience,
        ]);
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $this->validateExperience($request);

        $experience->update($validated);

        return redirect()
            ->route('admin.experiences.index')
            ->with('status', 'Expérience mise à jour avec succès.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()
            ->route('admin.experiences.index')
            ->with('status', 'Expérience supprimée.');
    }

    protected function validateExperience(Request $request): array
    {
        return $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['required', 'string'],
        ]);
    }
}
