<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('users', [UserController::class, 'index']);
Route::get('posts', [PostController::class, 'index']);
