<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MouvementEntreeController;
use App\Http\Controllers\MouvementSortieController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//pour l'abriviation en utilise la route 
//Route::apiRessource('articles',ArticleController::class);     

//Routes de controller Article API
//Route pour afficher toutes les articles
Route::get('/articles',[ArticleController::class,'index']);
//Route pour ajouter un article 
Route::post('/articles',[ArticleController::class,'store']);
//afficher un article
Route::get('/articles/{id}',[ArticleController::class,'show']);
//modifier un article
Route::put('/articles/{id}',[ArticleController::class,'update']);
//supprimer article
Route::delete('/articles/{id}',[ArticleController::class,'destroy']);




//Routes de controller MouvementEntree API 
//afficher tous les entrees
Route::get('/entrees',[MouvementEntreeController::class,'index']);
//ajouter entres
Route::post('/entrees',[MouvementEntreeController::class,'store']);
//afficher une entree
Route::get('/entrees/{id}',[MouvementEntreeController::class,'show']);
//supprimer entree
Route::delete('/entrees/{id}',[MouvementEntreeController::class,'destroy']);



//Routes de controller MouvementSortie API
//Route pour get toute les sorties
Route::get('/sorties',[MouvementSortieController::class,'index']);
//Route pour ajouter une sortie
Route::post('/sorties',[MouvementSortieController::class,'store']);
//Route pour afficher toutes les sorties
Route::get('/sorties/{id}',[MouvementSortieController::class,'show']);
//Route pour supprimer une sortie speciphique 
Route::delete('/sorties/{id}',[MouvementSortieController::class,'destroy']);