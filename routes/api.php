<?php

use App\Http\Controllers\ShortenerController;
use Illuminate\Support\Facades\Route;

Route::get('/encode', [ShortenerController::class, 'encode']);
Route::get('/decode', [ShortenerController::class, 'decode']);
