<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ReplySupportController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SupportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
*Auth
*/
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

/*
*Reset password
*/
Route::post('/forgot-password', [ResetPasswordController::class, 'resetPasswordLink']);
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);

Route::middleware(['auth:sanctum'])->group(function() {

    Route::prefix('/courses')->group(function() {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('{id}', [CourseController::class, 'show']);
        //retornando um modulo de um curso especifico
        Route::get('/{id}/modules', [ModuleController::class, 'index']);
    });
    
    Route::prefix('/modules')->group(function() {
        //retornando todos as licoes de um determinado modulo
        Route::get('/{id}/lessons', [LessonController::class, 'index']);
    });
    
    Route::prefix('/lessons')->group(function() {
        //retornando uma licao especifica
        Route::get('/{id}', [LessonController::class, 'show']);

        //inserindo uma visualização para uma aula
        Route::post('/viewed', [LessonController::class, 'viewed']);
    });
    
    Route::prefix('/supports')->group(function() {
        //retornando todos os suportes do usuario autenticado
        Route::get('/', [SupportController::class, 'index']);
        //pegando somente o suporte do usuario autenticado
        Route::get('/mysupports', [SupportController::class, 'mySupports']);
        //criar um suporte do usuario autenticado
        Route::post('/', [SupportController::class, 'store']);
        //criar uma resposta para um suporte especifico
        Route::post('/replies', [ReplySupportController::class, 'createReplies']);
    });

});




