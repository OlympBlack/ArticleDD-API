<?php

use App\Http\Controllers\api\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('check.api.key')->group(function () {

    Route::get('posts', [PostController::class, 'index']);
    Route::post('posts/create', [PostController::class, 'store']);
    Route::put('posts/edit/{id}', [PostController::class, 'update']);
    Route::delete('post/{id}', [PostController::class, 'delete']);

});
