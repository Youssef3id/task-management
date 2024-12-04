<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/user/{user}/tasks', [AdminController::class, 'showUserTasks'])->name('admin.user.tasks');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
});

Route::post('/projects/{project}/complete', [ProjectController::class, 'markComplete'])->name('projects.complete');

use App\Http\Controllers\Auth\SocialAuthController;

Route::get('login/google', [SocialAuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('login/github', [SocialAuthController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [SocialAuthController::class, 'handleGithubCallback']);


Route::get('/admin/create-task', [AdminController::class, 'create'])->name('admin.create-task');
Route::post('/admin/store-task', [AdminController::class, 'store'])->name('admin.store-task');


require __DIR__ . '/auth.php';
