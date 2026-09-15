<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        $skills = Skill::orderBy('name')->paginate(15);

        return view('admin.skills.index', [
            'skills' => $skills,
        ]);
    }

    public function create(): View
    {
        return view('admin.skills.create', [
            'skill' => new Skill(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSkill($request);

        Skill::create($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('status', 'Compétence créée avec succès.');
    }

    public function show(Skill $skill): RedirectResponse
    {
        return redirect()->route('admin.skills.edit', $skill);
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.edit', [
            'skill' => $skill,
        ]);
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $this->validateSkill($request);

        $skill->update($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('status', 'Compétence mise à jour avec succès.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('status', 'Compétence supprimée.');
    }

    protected function validateSkill(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:frontend,backend,devops,outils'],
            'icon' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
