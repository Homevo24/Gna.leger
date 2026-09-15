<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Experience;
use App\Models\JobApplication;
use App\Models\Project;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $projectsTotal = Project::count();
        $projectsPublished = Project::where('status', 'published')->count();
        $experiencesTotal = Experience::count();
        $articlesPublished = Article::whereNotNull('published_at')->count();

        $jobApplicationsByStatus = JobApplication::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $jobApplicationsTotal = $jobApplicationsByStatus->sum();

        $allZero = $projectsTotal === 0
            && $experiencesTotal === 0
            && $articlesPublished === 0
            && $jobApplicationsTotal === 0;

        return view('admin.dashboard', [
            'projectsTotal' => $projectsTotal,
            'projectsPublished' => $projectsPublished,
            'experiencesTotal' => $experiencesTotal,
            'articlesPublished' => $articlesPublished,
            'jobApplicationsByStatus' => $jobApplicationsByStatus,
            'jobApplicationsTotal' => $jobApplicationsTotal,
            'statusLabels' => JobApplication::STATUSES,
            'allZero' => $allZero,
        ]);
    }
}
