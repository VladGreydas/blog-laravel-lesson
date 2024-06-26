<?php

use App\Http\Controllers\Admin as Admin;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'posts');
Route::get('locale', [App\Http\Controllers\LocaleController::class, 'setLocale'])->name('locale');

Route::resource('posts', PostController::class)->middleware('locale');
Route::resource('comments', CommentController::class)
    ->only(['store', 'update', 'destroy'])
    ->middleware('auth');

Route::group(['prefix' => 'subscriptions', 'as' => 'subscriptions.'], function () {
    Route::post('/', [SubscriptionController::class, 'store'])->name('store');
    Route::delete('/', [SubscriptionController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth'], 'as' => 'admin.'], function () {
    Route::get('/', [Admin\AdminController::class, 'index'])->name('index');
    Route::resource('tags', Admin\TagController::class)->except('show');
    Route::resource('categories', Admin\CategoryController::class)->except('show');
    Route::resource('users', Admin\UserController::class)->except(['show', 'store', 'create']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
