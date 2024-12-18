<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Auth.
Route::get('login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Applications.
Route::resource('applications', ApplicationController::class)->middleware('auth');
