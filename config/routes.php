<?php

use App\Controllers\AdminController;
use App\Controllers\AuthenticationsController;
use App\Controllers\ProblemsController;
use App\Controllers\ProfileController;
use App\Controllers\ReinforceProblemsController;
use App\Controllers\SchedulingController;
use App\Controllers\BarberController;
use Core\Router\Route;

// Authentication
Route::get('/login', [AuthenticationsController::class, 'new'])->name('users.login');
Route::post('/login', [AuthenticationsController::class, 'authenticate'])->name('users.authenticate');

Route::middleware('auth')->group(function () {
    Route::get('/', [ProblemsController::class, 'index'])->name('root');

    Route::get('/user', [ProblemsController::class, 'index'])->name('root');

    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Barber
    Route::get('/barber/new', [BarberController::class, 'new'])->name('barber.new');
    Route::post('/barber', [BarberController::class, 'create'])->name('barber.create');
    Route::get('/barber/edit', [BarberController::class, 'edit'])->name('barber.edit');
    Route::put('/barber/{id}', [BarberController::class, 'update'])->name('barber.update');
    Route::get('/barber/show', [BarberController::class, 'show'])->name('barber.show');

    // Scheduling
    Route::post('/scheduling', [SchedulingController::class, 'create'])->name('scheduling.create');

    // Create
    Route::get('/problems/new', [ProblemsController::class, 'new'])->name('problems.new');
    Route::post('/problems', [ProblemsController::class, 'create'])->name('problems.create');

    // Retrieve
    Route::get('/problems', [ProblemsController::class, 'index'])->name('problems.index');
    Route::get('/problems/page/{page}', [ProblemsController::class, 'index'])->name('problems.paginate');
    Route::get('/problems/{id}', [ProblemsController::class, 'show'])->name('problems.show');

    // Update
    Route::get('/problems/{id}/edit', [ProblemsController::class, 'edit'])->name('problems.edit');
    Route::put('/problems/{id}', [ProblemsController::class, 'update'])->name('problems.update');

    // Delete
    Route::delete('/problems/{id}', [ProblemsController::class, 'destroy'])->name('problems.destroy');

    // Logout
    Route::get('/logout', [AuthenticationsController::class, 'destroy'])->name('users.logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::get('/profile/new', [ProfileController::class, 'new'])->name('profile.new');
    Route::post('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');


    // Reinforce Problems
    Route::get('/reinforce/problems', [ReinforceProblemsController::class, 'index'])
        ->name('reinforce.problems');
    Route::get('/reinforce/problems/page/{page}', [ReinforceProblemsController::class, 'index'])
        ->name('reinforce.problems.paginate');

    Route::get('/reinforce/problems/supported', [ReinforceProblemsController::class, 'supported'])
        ->name('reinforce.problems.supported');

    Route::post('/reinforce/problems/{id}', [ReinforceProblemsController::class, 'support'])
        ->name('reinforce.problems.create');
    Route::post(
        '/reinforce/problems/{id}/stopped-supporting',
        [ReinforceProblemsController::class, 'stoppedSupporting']
    )->name('reinforce.problems.stopped-supporting');
});