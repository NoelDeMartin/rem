<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::resource('applications', ApplicationController::class);
