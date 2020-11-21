<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\ResetPasswordController;
use \App\Http\Controllers\ChangePasswordController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\UserRoleController;
use \App\Http\Controllers\marque\MarqueController;
use \App\Http\Controllers\marque\MarqueSearchController;
use \App\Http\Controllers\profile\ProfileController;
use \App\Http\Controllers\modele\ModeleController;
use \App\Http\Controllers\modele\ModeleSearchController;
use \App\Http\Controllers\categorie\CategorieController;
use \App\Http\Controllers\sousCategorie\SousCategorieController;
use \App\Http\Controllers\produit\ProduitSearchController;
use \App\Http\Controllers\produit\ProduitController;

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

Route::group([

    'middleware' => 'api',
], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('sendPasswordResetLink', [ResetPasswordController::class, 'sendEmailResset']);
    Route::post('resetPassword', [ChangePasswordController::class, 'process']);

});
Route::group([

    'middleware' => 'auth.jwt',
], function ($router) {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::get('getUsers', [UserController::class, 'getData'])->middleware('role:admin');
    Route::get('getUsersRoles', [UserRoleController::class, 'getData'])->middleware('role:admin');
    Route::resource('users', UserController::class)->middleware('role:admin|utilisateur');
    Route::resource('marques', MarqueController::class)->middleware('role:admin');
    Route::resource('modeles', ModeleController::class)->middleware('role:admin');
    Route::resource('modeleSearch', ModeleSearchController::class)->middleware('role:admin');
    Route::resource('marqueSearch', MarqueSearchController::class)->middleware('role:admin');
    Route::resource('produits', ProduitController::class);
    Route::resource('produitSearch', ProduitSearchController::class);
    Route::resource('images',ImageController::class);

    Route::resource('profile', ProfileController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('sousCategories', SousCategorieController::class);

    Route::put('profile/password/{id}', [ProfileController::class, 'updatePassword']);
    Route::patch('profile/profile-image/{id}', [ProfileController::class, 'updateProfileImage']);
    Route::patch('profile/coverture-image/{id}', [ProfileController::class, 'updateCovertureImage']);


});
