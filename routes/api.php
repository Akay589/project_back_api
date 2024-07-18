<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DeviController;
use App\Http\Controllers\api\FonctionController;
use App\Http\Controllers\api\MaterielController;
use App\Http\Controllers\api\OuvrierController;
use App\Http\Controllers\api\UniteController;
use App\Http\Controllers\api\UserController;



/** Authentication */
    Route::post('/login', [AuthController::class,'login']);
    Route::post('/register', [AuthController::class,'register']);


    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });

/** END Authentication */


/** CRUD User */
    Route::post('/add_user', [UserController::class,'store']);
    Route::get('/list_users', [UserController::class,'show']);
    Route::get('/edit_user/{Login}', [UserController::class,'index']);
    Route::put('/update_user/{Login}', [UserController::class,'update']);
    Route::delete('/delete_user/{Login}', [UserController::class,'destroy']);

/** END CRUD User */

/** CRUD Fonction */
    Route::post('/add_fonction', [FonctionController::class,'store']);
    Route::get('/list_fonctions', [FonctionController::class,'show']);
    Route::get('/edit_fonction/{CodeF}', [FonctionController::class,'index']);
    Route::put('/update_fonction/{CodeF}', [FonctionController::class,'update']);
    Route::delete('/delete_fonction/{CodeF}', [FonctionController::class,'destroy']);

/** END CRUD Fonction */

/** CRUD Ouvrier */
    Route::post('/add_ouvrier', [OuvrierController::class,'store']);
    Route::get('/list_ouvrier', [OuvrierController::class,'show']);
    Route::get('/edit_ouvrier/{CodeO}', [OuvrierController::class,'index']);
    Route::put('/update_ouvrier/{CodeO}', [OuvrierController::class,'update']);
    Route::delete('/delete_ouvrier/{CodeO}', [OuvrierController::class,'destroy']);

/** END CRUD Ouvrier */


/** CRUD Unite */
    Route::post('/add_unite', [UniteController::class,'store']);
    Route::get('/list_unite', [UniteController::class,'show']);
    Route::get('/edit_unite/{CodeUnit}', [UniteController::class,'index']);
    Route::put('/update_unite/{CodeUnit}', [UniteController::class,'update']);
    Route::delete('/delete_unite/{CodeUnit}', [UniteController::class,'destroy']);

/** END CRUD Unite */


/** CRUD Materiel */
    Route::post('/add_materiel', [MaterielController::class,'store']);
    Route::get('/list_materiel', [MaterielController::class,'show']);
    Route::get('/edit_materiel/{CodeM}', [MaterielController::class,'index']);
    Route::put('/update_materiel/{CodeM}', [MaterielController::class,'update']);
    Route::delete('/delete_materiel/{CodeM}', [MaterielController::class,'destroy']);

/** END CRUD Materiel */


/** CRUD Devi */
    Route::post('/add_devis', [DeviController::class,'store']);
    Route::get('/list_devis', [DeviController::class,'show']);
    Route::get('/edit_devis/{NumD}', [DeviController::class,'index']);
    Route::put('/update_devis/{NumD}', [DeviController::class,'update']);
    Route::delete('/delete_devis/{NumD}', [DeviController::class,'destroy']);

/** END CRUD devi */

