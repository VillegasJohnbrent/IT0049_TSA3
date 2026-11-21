<?php
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
Route::get('/', [DashboardController::class, 'index'])->name('welcome');
Route::get('/tasks', [DashboardController::class, 'tasks'])->name('tasks');
Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
Route::get('/about', [DashboardController::class, 'about'])->name('about');
