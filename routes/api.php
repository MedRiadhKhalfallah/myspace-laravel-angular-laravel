<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\ResetPasswordController;
use \App\Http\Controllers\ChangePasswordController;
//use \App\Http\Controllers\UserController;
use \App\Http\Controllers\user\UserController;
use \App\Http\Controllers\user\UserSearchController;
use \App\Http\Controllers\UserRoleController;
use \App\Http\Controllers\marque\MarqueController;
use \App\Http\Controllers\marque\MarqueSearchController;
use \App\Http\Controllers\profile\ProfileController;
use \App\Http\Controllers\modele\ModeleController;
use \App\Http\Controllers\modele\ModeleSearchController;
use \App\Http\Controllers\role\RoleController;
use \App\Http\Controllers\role\RoleSearchController;
use \App\Http\Controllers\MailVerificationController;
use \App\Http\Controllers\societe\SocieteController;
use \App\Http\Controllers\societe\SocieteSearchController;
use \App\Http\Controllers\produit\ProduitController;
use \App\Http\Controllers\produit\ProduitSearchController;
use \App\Http\Controllers\historique\HistoriqueSearchController;
use \App\Http\Controllers\etat\EtatController;
use \App\Http\Controllers\typeActivite\TypeActiviteController;
use \App\Http\Controllers\reclamation\ReclamationController;
use \App\Http\Controllers\gouvernorat\GouvernoratConroller;
use \App\Http\Controllers\gouvernorat\GouvernoratSearchController;
use \App\Http\Controllers\delegation\DelegationConroller;
use \App\Http\Controllers\delegation\DelegationSearchController;
use \App\Http\Controllers\localite\LocaliteConroller;
use \App\Http\Controllers\roue\RoueController;
use \App\Http\Controllers\roueElement\RoueElementController;
use \App\Http\Controllers\category\CategoryController;
use \App\Http\Controllers\sousCategory\SousCategoryController;
use \App\Http\Controllers\newProduit\NewProduitController;
use \App\Http\Controllers\category\CategorySearchController;
use \App\Http\Controllers\sousCategory\SousCategorySearchController;
use \App\Http\Controllers\newProduit\NewProduitSearchController;

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
    Route::post('profile/verificationMail', [MailVerificationController::class, 'verificationMail']);
    Route::get('produits/reference/{reference}', [ProduitController::class, 'getProduitByReference']);
    Route::post('societeTopSearch', [SocieteSearchController::class, 'societeTopSearch']);
    Route::post('societeMapSearch', [SocieteSearchController::class, 'societeMapSearch']);
    Route::get('societes/{societe}', [SocieteController::class, 'show']);
    Route::resource('newProduitSearch', NewProduitSearchController::class);

});
Route::group([

    'middleware' => ['auth.jwt', 'active_user'],
],
    function ($router) {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
        Route::get('getUsers', [UserController::class, 'getData'])->middleware('role:admin');
        Route::get('getUsersRoles', [UserRoleController::class, 'getData'])->middleware('role:admin');
//    Route::resource('users', UserController::class)->middleware('role:admin|utilisateur');
        Route::resource('marques', MarqueController::class);
        Route::resource('modeles', ModeleController::class);
        Route::resource('modeleSearch', ModeleSearchController::class)->middleware('role:admin');
        Route::resource('marqueSearch', MarqueSearchController::class)->middleware('role:admin');
        Route::resource('profile', ProfileController::class);
        Route::resource('roles', RoleController::class)->middleware('role:admin');
        Route::resource('roleSearch', RoleSearchController::class)->middleware('role:admin');
        Route::put('profile/{id}/roles', [ProfileController::class, 'updateRoles'])->middleware('role:admin');
        Route::put('profile/password/{id}', [ProfileController::class, 'updatePassword']);
        Route::patch('profile/profile-image/{id}', [ProfileController::class, 'updateProfileImage']);
        Route::patch('profile/coverture-image/{id}', [ProfileController::class, 'updateCovertureImage']);
        Route::post('profile/sendMailVerificationLink', [MailVerificationController::class, 'sendEmailVerification']);
        Route::resource('users', UserController::class)->middleware('role:admin');
        Route::resource('userSearch', UserSearchController::class)->middleware('role:admin');
//societe route
        Route::get('societe/current', [SocieteController::class, 'getCurrentSociete']);
        Route::resource('societes', SocieteController::class)->except('show');
        Route::resource('societeSearch', SocieteSearchController::class)->middleware('role:admin');
        Route::patch('societes/societe-image/{id}', [SocieteController::class, 'updateSocieteImage']);
        Route::patch('societes/societe-coverture-image/{id}', [SocieteController::class, 'updateCovertureImage']);
// produit route
        Route::resource('produits', ProduitController::class);
        Route::resource('produitSearch', ProduitSearchController::class);
        Route::get('produitsByEtat', [ProduitSearchController::class, 'getProduitsByEtat']);
// historique route
        Route::resource('historiqueSearch', HistoriqueSearchController::class);
// etat route
        Route::resource('etats', EtatController::class);
// type activité route
        Route::resource('typeActivites', TypeActiviteController::class);
// reclamation route
        Route::resource('reclamations', ReclamationController::class);
// gouvernorat route
        Route::resource('gouvernorats', GouvernoratConroller::class);
        Route::resource('gouvernoratSearch', GouvernoratSearchController::class);
// delegation route
        Route::resource('delegations', DelegationConroller::class);
        Route::resource('delegationSearch', DelegationSearchController::class);
// Localites route
        Route::resource('localites', LocaliteConroller::class);
// roue route
        Route::resource('roues', RoueController::class);
// roueElement route
        Route::resource('roueElements', RoueElementController::class);
// category route

        Route::resource('categories', CategoryController::class);
        Route::resource('categorySearch', CategorySearchController::class);

// sous category route
        Route::resource('sousCategories', SousCategoryController::class);
        Route::resource('sousCategorySearch', SousCategorySearchController::class);

// new produit route
        Route::resource('newProduits', NewProduitController::class);

    });
