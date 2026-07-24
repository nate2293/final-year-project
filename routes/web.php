<?php

use App\Http\Controllers\ActivityController;
// use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\OpportunityController;
// use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;


// ======= Authenticated app routes =======
Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::middleware('auth')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('home');

        Route::get('/calendar/events', [CalendarController::class, 'events'])
            ->name('calendar.events');
    });
    Route::view('/about', 'about')->name('about');
    Route::view('/contact', 'contact')->name('contact');

    Route::get('/help', [HelpController::class, 'index'])->name('help');


    // This single line creates all standard crud routes for your controller.
    Route::resource('activities', ActivityController::class);
    Route::get('/opportunities', [OpportunityController::class, 'index'])
        ->name('opportunities.index');
    Route::get('/opportunities/{opportunity}', [OpportunityController::class, 'show'])
        ->name('opportunities.show');
    // Create URL that points to the controller method called downloadPdf()
    Route::get('/activities/pdf/download', [ActivityController::class, 'downloadPdf'])
        ->name('activities.pdf');

    Route::get('/applications', [ApplicationController::class, 'index'])
        ->name('applications.index');

    Route::get('/applications/{activity}', [ApplicationController::class, 'show'])
        ->name('applications.show');

    // Route::get('/applications/{activity}/edit', [ApplicationController::class, 'edit'])
    //     ->name('applications.edit');
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
