<?php

use App\Http\Controllers\ProfileController;
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
    return view('dashboard');
})->name('index');

use App\Http\Controllers\CvController;
use App\Http\Controllers\JobDescriptionController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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
    Route::patch('/jobs/{jd}', [JobDescriptionController::class, 'update'])->name('client.jobs.update');
    Route::delete('/jobs/{jd}', [JobDescriptionController::class, 'destroy'])->name('client.jobs.destroy');

    Route::get('/ai-analysis', function () {
        return view('client.ai-analysis');
    })->name('client.ai-analysis');

    Route::get('/roadmap', function () {
        return view('client.roadmap');
    })->name('client.roadmap');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\JobDescriptionController as AdminJobDescriptionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('jobs', AdminJobDescriptionController::class)->parameters(['jobs' => 'job:id']);
});

require __DIR__.'/auth.php';
