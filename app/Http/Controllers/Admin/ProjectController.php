<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.projects.index', [
            'projects' => $projects,
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.create', [
            'project' => new Project(),
            'skills' => Skill::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProject($request);

        $project = new Project($validated);

        if ($request->hasFile('image')) {
            $project->image_path = $request->file('image')->store('projects', 'public');
        }

        $project->save();
        $project->skills()->sync($validated['skills'] ?? []);

        return redirect()
            ->route('admin.projects.index')
            ->with('status', 'Projet créé avec succès.');
    }

    public function show(Project $project): RedirectResponse
    {
        return redirect()->route('admin.projects.edit', $project);
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', [
            'project' => $project,
            'skills' => Skill::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $this->validateProject($request);

        if ($request->hasFile('image')) {
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);
        $project->skills()->sync($validated['skills'] ?? []);

        return redirect()
            ->route('admin.projects.index')
            ->with('status', 'Projet mis à jour avec succès.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('status', 'Projet supprimé.');
    }

    protected function validateProject(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'repo_url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['exists:skills,id'],
        ]);

        $validated['featured'] = $request->boolean('featured');

        return $validated;
    }
}
