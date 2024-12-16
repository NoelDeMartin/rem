<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationModelController;
use App\Http\Controllers\JsonLDContextController;
use Illuminate\Support\Facades\Route;

Route::get('context.jsonld', JsonLDContextController::class)->name('jsonld.context');
Route::get('/applications/{application}.jsonld', [ApplicationController::class, 'profile'])->name('jsonld.applications.profile');
Route::get('/applications/{application}/access-description-set.jsonld', [ApplicationController::class, 'accessDescriptionSet'])->name('jsonld.applications.access-description-set');
Route::get('/applications/{application}/access-need-group.jsonld', [ApplicationController::class, 'accessNeedGroup'])->name('jsonld.applications.access-need-group');
Route::get('/applications/{application}/class-descriptions/{model}.jsonld', [ApplicationModelController::class, 'classDescription'])->name('jsonld.applications.models.class-description');
Route::get('/applications/{application}/access-needs/{model}.jsonld', [ApplicationModelController::class, 'accessNeed'])->name('jsonld.applications.models.access-need');
