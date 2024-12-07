<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Controllers\Auth\SocialAuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
});
Route::post('/projects/{project}/complete', [ProjectController::class, 'markComplete'])->name('projects.complete');




// Route::get('admin/user/{user}/tasks', [AdminController::class, 'showUserTasks'])->name('admin.user-tasks');

// Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin/create-task', [AdminController::class, 'create'])->name('admin.create-task');
// Route::post('/admin/user/tasks', [AdminController::class, 'store'])->name('admin.store-task');
// Route::middleware([CheckAdminRole::class])->get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// Route::get('/admin/search-users', [AdminController::class, 'searchUsers']); // Handle user search

// route::get("admin/tasks/{task}/edit", [AdminController::class, 'edit'])->name('admin.edit-task');
// Route::put('admin/tasks/{task}', [AdminController::class, 'update'])->name('projects.update');
// Route::delete('admin/tasks/{task}', [AdminController::class, 'destroy'])->name('projects.delete');



Route::middleware([CheckAdminRole::class])->group(function () {
    // Admin Routes
    Route::get('admin/user/{user}/tasks', [AdminController::class, 'showUserTasks'])->name('admin.user-tasks');
    Route::get('/admin/create-task', [AdminController::class, 'create'])->name('admin.create-task');
    Route::post('/admin/user/tasks', [AdminController::class, 'store'])->name('admin.store-task');
    Route::get('admin/tasks/{task}/edit', [AdminController::class, 'edit'])->name('admin.edit-task');
    Route::put('admin/tasks/{task}', [AdminController::class, 'update'])->name('admin.update-task');
    Route::delete('admin/tasks/{task}', [AdminController::class, 'destroy'])->name('admin.delete-task');
    Route::get('/admin/search-users', [AdminController::class, 'searchUsers'])->name('admin.search-users');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

//  Oauth login
Route::get('login/google', [SocialAuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('login/github', [SocialAuthController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [SocialAuthController::class, 'handleGithubCallback']);

require __DIR__ . '/auth.php';
