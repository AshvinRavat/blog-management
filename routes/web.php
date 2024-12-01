<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::get('', 'index')->name('home')->middleware('auth');
    Route::get('login', 'login')->name('login')->middleware('guest');
    Route::post('authenticate', 'authenticate')->name('authenticate')->middleware('guest');
    Route::post('logout', 'logout')->name('logout')->middleware('auth');
});


Route::middleware('auth')->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('post', 'index')->name('post.index');
        Route::get('post/create', 'create')->name('post.create');
        Route::post('post/store', 'store')->name('post.store');
        Route::get('post/edit/{post}', 'edit')->name('post.edit');
        Route::post('post/update/{post}', 'update')->name('post.update');
        Route::post('post/delete/{post}', 'delete')->name('post.delete');
    });
});