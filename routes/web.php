<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'posts');
Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class)
    ->only(['store', 'update', 'destroy'])
    ->middleware('auth');

Route::post('subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
Route::delete('subscriptions', [SubscriptionController::class, 'destroy'])->name('subscriptions.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
