<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Project;
use Illuminate\View\View;

class ParcoursProjetsController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::orderBy('start_date', 'desc')->get();

        $projects = Project::where('status', 'published')
            ->with('skills')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('parcours-projets.index', [
            'experiences' => $experiences,
            'projects' => $projects,
        ]);
    }

    public function show(Project $project): View
    {
        $project->load('skills');

        return view('parcours-projets.show', [
            'project' => $project,
        ]);
    }
}
