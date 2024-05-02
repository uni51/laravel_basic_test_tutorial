<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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
});
