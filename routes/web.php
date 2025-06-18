<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonajesController;

Route::get('/', [App\Http\Controllers\PersonajesController::class, 'fetchApi']);

Route::get('/api-personajes', [PersonajesController::class, 'fetchApi'])->name('personajes.api');
Route::post('/save-personajes', [PersonajesController::class, 'storeToDatabase'])->name('personajes.save');
Route::get('/personajes-db', [PersonajesController::class, 'showFromDatabase'])->name('personajes.db');
Route::post('/personajes/update/{id}', [PersonajesController::class, 'update'])->name('personajes.update');



