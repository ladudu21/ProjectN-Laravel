<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\AuthorizationController;
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
Route::get('login', [AdminController::class, 'loginForm'])->name('login_form');
Route::post('login', [AdminController::class, 'login'])->name('login');
Route::post('logout', [AdminController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::name('users.')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('usr_index');
        Route::get('admins', [AdminUserController::class, 'index'])->name('ad_index');
        Route::get('users/create', [AdminUserController::class, 'create'])->middleware(['permission:add user'])->name('create');
        Route::post('users', [AdminUserController::class, 'store'])->name('store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware(['permission:edit user'])->name('edit');
        Route::get('admins/{user}/edit', [AdminUserController::class, 'edit'])->middleware(['permission:edit user'])->name('ad_edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('update');
        Route::put('admins/{user}', [AdminUserController::class, 'update'])->name('ad_update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware(['permission:delete user'])->name('destroy');
    });

    Route::name('authorizations.')->group(function () {
        Route::get('permission-to-role', [AuthorizationController::class, 'assignPermissonForm'])->name('assign_permission_form');
        Route::post('permission-to-role', [AuthorizationController::class, 'assignPermisson'])->name('assign_permission');
        Route::get('role-to-user', [AuthorizationController::class, 'assignRoleForm'])->name('assign_role_form');
        Route::post('role-to-user', [AuthorizationController::class, 'assignRole'])->name('assign_role');
    });

    Route::name('categories.')->group(function () {
        Route::get('categories', [CategoryController::class, 'index'])->name('index');
        Route::get('categories/create', [CategoryController::class, 'create'])->middleware(['permission:add category'])->name('create');
        Route::post('categories', [CategoryController::class, 'store'])->name('store');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->middleware(['permission:edit category'])->name('edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware(['permission:delete category'])->name('destroy');
    });

    Route::name('posts.')->group(function () {
        Route::get('posts', [PostController::class, 'index'])->name('index');
        Route::get('posts/create', [PostController::class, 'create'])->middleware(['permission:add post'])->name('create');
        Route::post('posts', [PostController::class, 'store'])->name('store');

        Route::middleware('post-access')->group(function () {
            Route::get('posts/{post}/edit', [PostController::class, 'edit'])->middleware(['permission:edit post'])->name('edit');
            Route::put('posts/{post}', [PostController::class, 'update'])->name('update');
            Route::delete('posts/{post}', [PostController::class, 'destroy'])->middleware(['permission:delete post'])->name('destroy');
        });
    });

    Route::name('notifications.')->group(function () {
        Route::get('notifications', [NotificationController::class, 'index'])->name('index');
        Route::get('notifications/create', [NotificationController::class, 'create'])->middleware(['permission:add noti'])->name('create');
        Route::post('notifications', [NotificationController::class, 'store'])->name('store');
        Route::get('notifications/{notification}/edit', [NotificationController::class, 'edit'])->middleware(['permission:edit noti'])->name('edit');
        Route::put('notifications/{notification}', [NotificationController::class, 'update'])->name('update');
        Route::post('notifications/{notification}', [NotificationController::class, 'destroy'])->name('destroy');
    });

    //Function Route
    Route::post('/get-user-by-roles', [UserController::class, 'getUsersByRole'])->name('get_users_by_role');
    Route::post('/get-all-permissions', [AuthorizationController::class, 'getAllPermissions'])->name('get_all_permissions');
});

