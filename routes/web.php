<?php

use App\Http\Controllers\HelpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnalyticsController;
use Illuminate\Support\Facades\Route;


// ======= Authenticated app routes =======
Route::middleware('auth')->group(function () {

    Route::view('/', 'welcome')->name('home');
    Route::view('/about', 'about')->name('about');
    Route::view('/contact', 'contact')->name('contact');

    Route::get('/help', [HelpController::class, 'index'])->name('help');

    // Analytics dashboard
    Route::get('/analytics', [AnalyticsController::class, 'index'])
        ->name('analytics.index');

    // Applications (MUST be inside auth)
    // Route::get('/applications', [ApplicationController::class, 'index'])
    //     ->name('applications.index');

    // Route::get('/applications/create', [ApplicationController::class, 'create'])
    //     ->name('applications.create');

    // Route::post('/applications', [ApplicationController::class, 'store'])
    //     ->name('applications.store');

    // PDF export
    Route::get('/applications/report/download', [ActivityController::class, 'downloadReport'])
        ->name('applications.report.download');

    Route::resource('applications', ActivityController::class)->except(['show']);




    // // Engagement Log (Applications)
    // Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    // Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    // Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    // Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    // Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
    // Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
});


// ======= User Management routes =======
Route::prefix('/users')->name('users.')->middleware(['auth'])->group(function () {

    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [UserController::class, 'update'])->name('update');

    Route::get('/mirror/stop', [UserController::class, 'stop'])->name('mirror.stop');
    Route::get('/mirror/{id}', [UserController::class, 'start'])->name('mirror.start');
});


// ======= Guest routes =======
Route::middleware('guest')->group(function () {
    //
});

// Auth scaffolding
require __DIR__ . '/auth.php';
