<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;


Route::get('/u/{code}', [UrlController::class, 'redirect'])->where('code', '[A-Za-z0-9]+');