<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render(component: 'Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['role:superadmin']], routes: function () { 
        Route::get('/users', function () {
            $users = User::all();
            return Inertia::render('Users', [
                'users' => $users
            ]);
        })->name('users');

        Route::get('/users/create', function () {
            return Inertia::render(component: 'UsersCreate');
        })->name('users.create');

        Route::post('/users/create', [UserController::class, 'store'])->name('users.create.submit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/users/{id}/edit', function ($id) {
            $user = User::findOrFail($id);
            return Inertia::render('UsersEdit', [
                'user' => $user
            ]);
        })->name('users.edit');
    });
});

require __DIR__.'/auth.php';
