<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\MachineController;





Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

/*
Route::post('/ajout', [MachineController::class,'store']);
Route::get('/machines', [MachineController::class,'index']);
Route::delete('/delete/{id}', [MachineController::class,'destroy']);
Route::put('/update/{id}', [MachineController::class,'update']);  */
