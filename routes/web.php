<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::resource('applications', ApplicationController::class);
