<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ClientController@home');
Route::get('/shop', 'ClientController@shop');
Route::get('/panier', 'ClientController@panier');
Route::get('/paiement', 'ClientController@paiement');
Route::get('/client_login', 'ClientController@client_login');
Route::get('/signup', 'ClientController@signup');
Route::get('/select_par_cat/{name}','ClientController@select_par_cat');
Route::get('/ajouter_au_panier/{id}','ClientController@ajouter_au_panier');
Route::post('modifier_qty/{id}','ClientController@modifier_panier');
Route::get('/retirer_produit/{id}', 'ClientController@retirer_produit');
Route::post('/payer','ClientController@payer');

Route::post('/creer_compte', 'ClientController@creer_compte');
Route::post('/acceder_compte', 'ClientController@acceder_compte');
Route::get('/logout', 'ClientController@logout');

Route::get('/voir_pdf/{id}','PdfController@voir_pdf');


Route::get('/admin', 'AdminController@dashboard');
Route::get('/commandes', 'AdminController@commandes');

Route::get('/ajoutercategorie', 'CategoryController@ajoutercategorie');
Route::post('/sauvercategorie', 'CategoryController@sauvercategorie');
Route::get('/categories', 'CategoryController@categories');
Route::get('/edit_category/{id}', 'CategoryController@editcategorie');
Route::post('modifiercategorie', 'CategoryController@modifiercategorie');
Route::get('/supprimercategorie/{id}', 'CategoryController@supprimercategorie');

Route::get('/ajouterproduit', 'ProductController@ajouterproduit');
Route::post('/sauverproduit', 'ProductController@sauverproduit');
Route::get('/produits', 'ProductController@produits');
Route::get('/editproduit/{id}', 'ProductController@editproduit');
Route::post('modifierproduit', 'ProductController@modifierproduit');
Route::get('deleteproduct/{id}', 'ProductController@deleteproduct');
Route::get('/activeproduit/{id}', 'ProductController@activeproduit');
Route::get('/desactiveproduit/{id}', 'ProductController@desactiveproduit');

Route::get('ajouterslider', 'SliderController@ajouterslider');
Route::post('sauverslider', 'SliderController@sauverslider');
Route::get('/sliders', 'SliderController@sliders');
Route::get('/editslider/{id}', 'SliderController@editslider');
Route::post('modifierslider', 'SliderController@modifierslider');
Route::get('/deleteslider/{id}', 'SliderController@deleteslider');
Route::get('/desactiverslider/{id}', 'SliderController@desactiverslider');
Route::get('/activerslider/{id}', 'SliderController@activerslider');

Auth::routes();

Route::get('/admin', 'HomeController@index');
