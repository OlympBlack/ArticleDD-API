<?php

use App\Http\Controllers\api\PostController;
use Illuminate\Support\Facades\Route;

//Afficher tous les posts disponibles
Route::get('posts', [PostController::class, 'index']);

//Créer un nouvel post
Route::post('posts/create', [PostController::class, 'store']);

//Mettre à jour un post
Route::put('posts/edit/{id}', [PostController::class, 'update']);
