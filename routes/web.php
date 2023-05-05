<?php

use App\Http\Controllers\DeleteTemporaryImageController;
use App\Http\Controllers\StorePostController;
use App\Http\Controllers\UploadTemporaryImageController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);
Route::post('/upload', UploadTemporaryImageController::class);
Route::post('/delete', DeleteTemporaryImageController::class);
Route::post('/', StorePostController::class);

