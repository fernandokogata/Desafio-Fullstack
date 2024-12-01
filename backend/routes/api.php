<?php

use App\Infrastructure\Http\Controllers\Nivel\CreateNivelController;
use App\Infrastructure\Http\Controllers\Nivel\DeleteNivelController;
use App\Infrastructure\Http\Controllers\Nivel\FindAllNiveisController;
use App\Infrastructure\Http\Controllers\Nivel\UpdateNivelController;
use Illuminate\Support\Facades\Route;

Route::post('niveis', [CreateNivelController::class, 'create']);
Route::get('niveis', [FindAllNiveisController::class, 'findAll']);
Route::put('niveis', [UpdateNivelController::class, 'update']);
Route::patch('niveis', [UpdateNivelController::class, 'update']);
Route::delete('niveis/{id}', [DeleteNivelController::class, 'delete']);
