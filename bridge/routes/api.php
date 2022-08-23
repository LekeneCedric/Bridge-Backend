<?php

use App\Http\Controllers\annonceController;
use App\Http\Controllers\associationController;
use App\Http\Controllers\besoinController;
use App\Http\Controllers\demandeController;
use App\Http\Controllers\donateurController;
use App\Http\Controllers\messageController;
use App\Http\Controllers\mouvementController;
use App\Http\Controllers\recuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/* Donateur */
Route::get('/donateurs',[donateurController::class,'index']);

Route::get('/donateurs/{id}',[donateurController::class,'show']);

Route::post('/donateurs',[donateurController::class,'store']);

Route::put('/donateurs/{id}',[donateurController::class,'update']);

Route::delete('/donateurs/{id}',[donateurController::class,'destroy']);

/* messsage */

Route::get('/messages',[messageController::class,'index']);

Route::get('/messages/{id}',[messageController::class,'show']);

Route::post('/messages',[messageController::class,'store']);

Route::put('/messages/{id}',[messageController::class,'update']);

Route::delete('/messages/{id}',[messageController::class,'destroy']);

/* annonce */

Route::get('/annonces',[annonceController::class,'index']);

Route::get('/annonces/{id}',[annonceController::class,'show']);

Route::post('/annonces/{id}',[annonceController::class,'store']);

Route::put('/annonces/{id}',[annonceController::class,'update']);

Route::delete('/annonces/{id}',[annonceController::class,'destroy']);

/* demande */

Route::get('/demandes',[demandeController::class,'index']);

Route::get('/demandes/{id}',[demandeController::class,'show']);

Route::post('/demandes',[demandeController::class,'store']);

Route::put('/demandes/{id}',[demandeController::class,'store']);

Route::delete('/demandes/{id}',[demandeController::class,'destroy']);

/* besoin */

Route::get('/besoins',[besoinController ::class,'index']);

Route::get('/besoins/{id}',[besoinController::class,'show']);

Route::post('/besoins',[besoinController::class,'store']);

Route::put('/besoins/{id}',[besoinController::class,'store']);

Route::delete('/besoins/{id}',[besoinController::class,'destroy']);

/* mouvement */

Route::get('/mouvements',[mouvementController ::class,'index']);

Route::get('/mouvements/{id}',[mouvementController::class,'show']);

Route::post('/mouvements',[mouvementController::class,'store']);

Route::put('/mouvements/{id}',[mouvementController::class,'store']);

Route::delete('/mouvements/{id}',[mouvementController::class,'destroy']);

/* associations */

Route::get('/associations',[associationController ::class,'index']);

Route::get('/associations/{id}',[associationController::class,'show']);

Route::post('/associations',[associationController::class,'store']);

Route::put('/associations/{id}',[associationController::class,'store']);

Route::delete('/associations/{id}',[associationController::class,'destroy']);

/* recus */

Route::get('/recus',[recuController ::class,'index']);

Route::get('/recus/{id}',[recuController::class,'show']);

Route::post('/recus',[recuController::class,'store']);

Route::put('/recus/{id}',[recuController::class,'store']);

Route::delete('/recus/{id}',[recuController::class,'destroy']);

/* dons */

Route::get('/dons',[donController ::class,'index']);

Route::get('/dons/{id}',[donController::class,'show']);

Route::post('/dons',[donController::class,'store']);

Route::put('/dons/{id}',[donController::class,'store']);

Route::delete('/dons/{id}',[donController::class,'destroy']);














Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
