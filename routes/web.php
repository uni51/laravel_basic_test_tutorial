<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostManageController;
use App\Http\Middleware\IpLimit;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return 'ログイン画面';
})->name('login');

Route::get('users', [UserController::class, 'index']);
Route::get('posts', [PostController::class, 'index']);
Route::middleware('auth')->group(function () {
    // 認証が必要なページ
    Route::get('members', [MemberController::class, 'index']);
    Route::get('members/posts', [PostManageController::class, 'index'])->name('posts.index');
    Route::post('members/posts', [PostManageController::class, 'store'])->name('posts.store');
    Route::get('members/posts/{post}/edit', [PostManageController::class, 'edit'])->name('posts.edit');
    Route::put('members/posts/{post}', [PostManageController::class, 'update'])->name('posts.update');
    Route::delete('members/posts/{post}', [PostManageController::class, 'destroy'])
        ->name('posts.destroy')
        ->middleware(IpLimit::class);
});
