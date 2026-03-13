<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Symfony\Component\HttpFoundation\JsonResponse;


Route::post('/register', [AuthController::class, 'register']);

Route::post('/login',    [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function () {

   
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']); 

  
    Route::get('/me',[ProfileController::class, 'me']);
    Route::put('/me',[ProfileController::class, 'update']);
    Route::put('/me/password',[ProfileController::class, 'updatePassword']);

    Route::delete('/me', [ProfileController::class, 'delete']);
   
});