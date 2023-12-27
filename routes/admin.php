<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
*/
Route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class)->except([
        'store', 'update', 'destroy'
    ]);

    Route::resource('notifications', NotificationController::class);

    //Function Route
    Route::post('/get-user-by-roles', [UserController::class, 'getUsersByRole'])->name('get_users_by_role');
});

Route::resource('posts', PostController::class)->only([
    'store', 'update', 'destroy'
])->middleware(['role:admin|writer']);


