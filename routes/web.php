<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('index');

use App\Http\Controllers\CvController;
use App\Http\Controllers\JobDescriptionController;
use App\Http\Controllers\CvAnalysisController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CV Management
    Route::get('/cv-management', [CvController::class, 'index'])->name('client.cv-management');
    Route::get('/cv-templates', [CvController::class, 'templates'])->name('client.cv-templates');
    Route::post('/cv-management', [CvController::class, 'store'])->name('client.cv-management.store');
    Route::post('/cv-templates/select', [CvController::class, 'storeWithTemplate'])->name('client.cv-templates.select');
    Route::get('/cv-builder/{cv}', [CvController::class, 'builder'])->name('client.cv-builder');
    Route::patch('/cv-builder/{cv}', [CvController::class, 'saveBuilder'])->name('client.cv-builder.save');
    Route::delete('/cv-management/{cv}', [CvController::class, 'destroy'])->name('client.cv-management.destroy');
    Route::patch('/cv-management/{cv}', [CvController::class, 'update'])->name('client.cv-management.update');

    // Job Description Management
    Route::get('/jobs', [JobDescriptionController::class, 'index'])->name('client.jobs');
    Route::post('/jobs', [JobDescriptionController::class, 'store'])->name('client.jobs.store');
    Route::post('/jobs/{jd}/generate-questions', [JobDescriptionController::class, 'generateQuestions'])->name('client.jobs.generate-questions');
    Route::patch('/jobs/{jd}', [JobDescriptionController::class, 'update'])->name('client.jobs.update');
    Route::delete('/jobs/{jd}', [JobDescriptionController::class, 'destroy'])->name('client.jobs.destroy');

    // AI Analysis - CV vs JD
    Route::get('/ai-analysis', [CvAnalysisController::class, 'index'])->name('client.ai-analysis');
    Route::post('/ai-analysis/compare', [CvAnalysisController::class, 'compare'])->name('client.ai-analysis.compare');
    Route::post('/ai-analysis/analyze-cv', [CvAnalysisController::class, 'analyzeCv'])->name('client.ai-analysis.analyze-cv');

    Route::get('/roadmap', [CvAnalysisController::class, 'roadmap'])->name('client.roadmap');
    Route::get('/ai-analysis/roadmap/{jd}', [CvAnalysisController::class, 'getRoadmap'])->name('client.ai-analysis.get-roadmap');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);

});

require __DIR__.'/auth.php';
