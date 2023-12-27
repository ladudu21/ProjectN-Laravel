<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Comment
    Route::post('post/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    //Like
    Route::post('post/{post}/likes', [LikeController::class, 'store'])->name('likes.store');

    //Notifications
    Route::get('notifications', [HomepageController::class, 'showNotifications'])->name('notifications.show');
});

require __DIR__.'/auth.php';

Route::get('post/{post:slug}', [HomepageController::class, 'showPost'])->name('post.show');

Route::prefix('writer')->middleware(['role:writer'])->name('writer.')->group(function () {
    Route::get('/dashboard', function () {
        return view('writer.dashboard');
    })->name('dashboard');

    Route::resource('posts', WriterController::class)->except([
        'store', 'update', 'destroy'
    ]);
});
