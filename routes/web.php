<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\ArticlesContactController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ParcoursProjetsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

// Site public
Route::get('/', [ProfilController::class, 'index'])->name('profil');
Route::get('/parcours-projets', [ParcoursProjetsController::class, 'index'])->name('parcours-projets');
Route::get('/parcours-projets/{project:slug}', [ParcoursProjetsController::class, 'show'])->name('projects.show');
Route::get('/articles-contact', [ArticlesContactController::class, 'index'])->name('articles-contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('job-applications', JobApplicationController::class);
});

require __DIR__.'/auth.php';
