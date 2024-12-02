<?php

use App\Infrastructure\Http\Controllers\Desenvolvedor\CreateDesenvolvedorController;
use App\Infrastructure\Http\Controllers\Desenvolvedor\DeleteDesenvolvedorController;
use App\Infrastructure\Http\Controllers\Desenvolvedor\FindDesenvolvedoresController;
use App\Infrastructure\Http\Controllers\Desenvolvedor\UpdateDesenvolvedorController;
use App\Infrastructure\Http\Controllers\Nivel\CreateNivelController;
use App\Infrastructure\Http\Controllers\Nivel\DeleteNivelController;
use App\Infrastructure\Http\Controllers\Nivel\FindNiveisController;
use App\Infrastructure\Http\Controllers\Nivel\UpdateNivelController;
use Illuminate\Support\Facades\Route;

Route::post('niveis', [CreateNivelController::class, 'create']);
Route::get('niveis', [FindNiveisController::class, 'find']);
Route::put('niveis', [UpdateNivelController::class, 'update']);
Route::patch('niveis', [UpdateNivelController::class, 'update']);
Route::delete('niveis/{id}', [DeleteNivelController::class, 'delete']);
Route::post('desenvolvedores', [CreateDesenvolvedorController::class, 'create']);
Route::get('desenvolvedores', [FindDesenvolvedoresController::class, 'find']);
Route::put('desenvolvedores', [UpdateDesenvolvedorController::class, 'update']);
Route::patch('desenvolvedores', [UpdateDesenvolvedorController::class, 'update']);
Route::delete('desenvolvedores/{id}', [DeleteDesenvolvedorController::class, 'delete']);
