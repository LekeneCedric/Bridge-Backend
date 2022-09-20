<?php

use App\Http\Controllers\annonceController;
use App\Http\Controllers\appartenirController;
use App\Http\Controllers\associationController;
use App\Http\Controllers\authController;
use App\Http\Controllers\besoinController;
use App\Http\Controllers\demandeController;
use App\Http\Controllers\donateurController;
use App\Http\Controllers\donController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\mediascontroller;
use App\Http\Controllers\messageController;
use App\Http\Controllers\mouvementController;
use App\Http\Controllers\participerController;
use App\Http\Controllers\recuController;
use App\Http\Controllers\reserverController;
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

/*---------------------------------------------PROTECTED ROUTES ----------------------------------------------------------------*/
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/login');
    Route::post('/auth/logout',[authController::class,'logout']);
    Route::put('/donateurs/{id}',[donateurController::class,'update']);
    Route::delete('/donateurs/{id}',[donateurController::class,'destroy']);

    Route::get('/mesMessages/{id}',[messagesController::class,'showMyMessages']);
    Route::get('/messages',[messageController::class,'index']);
    Route::get('/messages/{id}',[messageController::class,'show']);
    Route::get('/messages',[messageController::class,'index']);
    Route::get('/interessesDon/{id_don}',[messageController::class,'interesses']);
    Route::get('/salonsDiscussionsDon/{myid}',[messageController::class,'getDiscussionsDon']);
    Route::get('/salonsDiscussionsDemande/{myid}',[messageController::class,'getDiscussionsDemandes']);
    Route::get('/conversationDon/{id_donateur}-{id_reicv}-{id_don}',[messageController::class,'getConversationDon']);
    Route::get('/conversationDemande/{id_donateur}-{id_reicv}-{id_demande}',[messageController::class,'getConversationDemande']);
    
    Route::post('/messages',[messageController::class,'store']);
    Route::put('/messages/{id}',[messageController::class,'update']);
    Route::delete('/messages/{id}',[messageController::class,'destroy']);
    Route::get('/lastMessage/{id_donateur}-{id_receiver}-{id_don}',[messageController::class,'getLastMessage']);
    
    Route::post('/annonces',[annonceController::class,'store']);
    Route::put('/annonces/{id}',[annonceController::class,'update']);
    Route::delete('/annonces/{id}',[annonceController::class,'destroy']);
    
    Route::post('/demandes',[demandeController::class,'store']);
    Route::put('/demandes/{id}',[demandeController::class,'update']);
    Route::delete('/demandes/{id}',[demandeController::class,'destroy']);
    
    
    Route::post('/besoins',[besoinController::class,'store']);
    Route::put('/besoins/{id}',[besoinController::class,'update']);
    Route::delete('/besoins/{id}',[besoinController::class,'destroy']);

    Route::post('/mouvements',[mouvementController::class,'store']);
    Route::put('/mouvements/{id}',[mouvementController::class,'update']);
    Route::delete('/mouvements/{id}',[mouvementController::class,'destroy']);


    Route::post('/associations',[associationController::class,'store']);
    Route::put('/associations/{id}',[associationController::class,'update']);
    Route::delete('/associations/{id}',[associationController::class,'destroy']);


    Route::post('/recus',[recuController::class,'store']);
    Route::put('/recus/{id}',[recuController::class,'update']);
    Route::delete('/recus/{id}',[recuController::class,'destroy']);

    
    Route::post('/dons',[donController::class,'store']);
    Route::put('/dons/{id}',[donController::class,'update']);
    Route::delete('/dons/{id}',[donController::class,'destroy']);
    Route::get('/isreserv/{id_don}-{idUser}',[donController::class,'isreservForMe']);
    Route::post('/annulerReservation',[donController::class,'annulerReservation']);
    Route::post('/receptionnerDon',[donController::class,'receptionnerDon']);

    Route::post('/appartenances',[appartenirController::class,'store']);
    Route::delete('/appartenances/{id}',[appartenirController::class,'destroy']);

    Route::post('/participations',[participerController::class,'store']);
    Route::delete('/participations/{id}',[participerController::class,'destroy']);
    
    Route::get('/reservations',[reserverController ::class,'index']);
  
});
/*---------------------------------------------PUBLIC ROUTES ----------------------------------------------------------------*/

Route::post('/reserverDon',[donController::class,'reserver']);
Route::get('/nbreservations/{id_don}',[donController::class,'nbreservations']);
Route::post('/test',[donController::class,'test']);
/*Authentication*/
Route::get('/validate-token', function () {
    return ['data' => 'Token is valid'];
})->middleware('auth:sanctum');
Route::post('/auth/register',[authController::class,'register']);
Route::post('/auth/login',[authController::class,'login']);

/* Donateur */
Route::get('/donateurs',[donateurController::class,'index']);
Route::get('/donateurs/{id}',[donateurController::class,'show']);
Route::get('/donateursassociation/{id}',[donateurController::class,'showdonateursAssociation']);
Route::get('/donateursmouvement/{id_mouvement}',[donateurController::class,'showdonateurMouvements']);
/* messsage */


/* annonce */

Route::get('/annonces',[annonceController::class,'index']);
Route::get('/annonces/{id}',[annonceController::class,'show']);
Route::get('/annoncesassociation/{id}',[annonceController::class,'showAnnoncesAssociation']);
/* demande */

Route::get('/demandes',[demandeController::class,'index']);
Route::get('/demandes/{id}',[demandeController::class,'show']);
Route::get('/demandesdonateur/{id_donateur}',[demandeController::class,'showDemandesDonateur']);
Route::get('/demandesCategory/{name_category}',[demandeController::class,'showDemandesCategory']);
/* besoin */

Route::get('/besoins',[besoinController ::class,'index']);
Route::get('/besoins/{id}',[besoinController::class,'show']);
Route::get('/besoinsnonresolus',[besoinController::class,'besoins_non_resolus']);  
Route::get('/besoinsresolus',[besoinController::class,'besoins_resolus']);  
Route::get('/besoinsassociation/{id_association}',[besoinController::class,'besoins_association']);  
Route::get('/besoinsnonresolusassociation/{id_association}',[besoinController::class,'besoins_non_resolu_association']);  
Route::get('/besoinsresolusassociation/{id_association}',[besoinController::class,'besoins_resolu_association']);  

/* mouvement */

Route::get('/mouvements',[mouvementController ::class,'index']);
Route::get('/mouvements/{id}',[mouvementController::class,'show']);
Route::get('/mouvementsassociation/{id}',[mouvementController::class,'mouvementsassociation']);

/* associations */

Route::get('/associations',[associationController ::class,'index']);
Route::get('/associations/{id}',[associationController::class,'show']);

/* recus */

Route::get('/recus',[recuController ::class,'index']);
Route::get('/recus/{id}',[recuController::class,'show']);
Route::get('/recusdonateur/{id}',[recuController::class,'getrecusdonateur']);
Route::get('/recusassociation/{id}',[recuController::class,'getrecusassociation']);
Route::get('/recusdonateurassociation/{id_association}/{id_donateur}',[recuController::class,'getrecusdonateurassociation']);

/* dons */

Route::get('/dons',[donController ::class,'index']);
Route::get('/dons/{id}',[donController::class,'show']);
Route::get('/mesdons/{id_donateur}',[donController::class,'getmesdons']);
Route::get('/donsSimilaires/{id}/{category}',[donController::class,'getDonSimilaire']);
Route::get('/donsfiltreByCategory/{category}',[donController::class,'getDonFiltreByCategory']);
Route::get('/donsfiltreByEtat/{etat}',[donController::class,'getDonFiltreByEtat']);
Route::get('/donsfiltreByCategoryAndEtat/{category}/{etat}',[donController::class,'getDonWithCategoryAndEtat']);

Route::get('/appartenances',[appartenirController ::class,'index']);
Route::get('/appartenances/{id}',[appartenirController ::class,'show']);
Route::get('/isMemberAssociation/{id_donateur}/{id_association}',[appartenirController ::class,'isMemberAssociation']);
Route::post('/addAssociationMember/{id_member}/{id_association}',[appartenirController ::class,'addAssociationMember']);
Route::post('/rejectAssociationMember/{id_member}/{id_association}',[appartenirController ::class,'rejectAssociationMember']);
Route::get('/non_association_member_list/{id_association}',[appartenirController ::class,'non_association_member_list']);
Route::get('/association_member_list/{id_association}',[appartenirController ::class,'association_member_list']);

Route::get('/appartenances',[appartenirController ::class,'index']);
Route::get('/appartenances/{id}',[appartenirController ::class,'show']);

Route::get('/medias',[mediascontroller ::class,'index']);
Route::get('/medias/{id}',[mediascontroller ::class,'show']);
Route::get('/medias/donateur/{id}',[mediascontroller ::class,'showDonateurMedia']);
Route::get('/medias/annonce/{id}',[mediascontroller ::class,'showAnnonceMediaMedia']);
Route::get('/medias/association/{id}',[mediascontroller ::class,'showAssociationMedia']);
Route::get('/medias/don/{id}',[mediascontroller ::class,'showDonMedia']);
Route::get('/medias/mouvement/{id}',[mediascontoller::class,'showMouvementMedia']);
Route::post('/medias',[mediascontroller ::class,'store']);
Route::delete('/medias/{id}',[mediascontroller ::class,'destroy']);