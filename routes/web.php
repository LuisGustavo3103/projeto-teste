<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('users.index');
Route::post('/store', [RegisterController::class, 'store'])->name('users.store');

Route::post('/login', [LoginController::class, 'login'])->name('users.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('users.logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboards.index')->middleware('auth');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('posts.delete')->middleware('auth');
