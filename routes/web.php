<?php

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

Route::get('/ebe58-login', 'Controller@ebe58Login')->name('login');
Route::get('/ebe58-register', 'Controller@ebe58Register');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/partners', 'Controller@partnerDisplay');
Route::get('/contact', 'Controller@contact')->name('contact');
Route::get('/faq', 'Controller@faq');
Route::get('/presentation', 'Controller@aboutUs');
Route::get('/mentions-legales', 'Controller@legal');
Route::get('/profil', 'Controller@areaProfil');
Route::get('/section', 'Controller@section');
Route::get('/actualités', 'Controller@newsDisplay');
Route::get('/actualité', 'Controller@newsUnique');
Route::get('/crédits', 'Controller@credits');
Route::get('/qui-sommes-nous', 'Controller@qui');
Route::get('/mentions', 'Controller@mentions');
Route::get('/oubli', 'Controller@forgotPassword');
Route::get('/oubli/{link}', 'Controller@changePassword');

Route::post('/updateProfil', 'Controller@infosUpdate');
Route::post('/changePsw', 'Controller@updatePsw');
Route::post('/lostPsw', 'Controller@lostPsw');
Route::post('/lostpassword', 'Controller@lostpassword');
Route::post('/lostPsw', 'Controller@lostPsw');
Route::post('/contact/envoi', 'Controller@sendMessage');
Route::post('/verification-email', 'Controller@existEmail');
Route::post('/oubli', 'Controller@forgotPassword');
Route::post('/oubli/{link}', 'Controller@changePassword');
Route::post('/changep', 'Controller@changeThePassword');

Route::post('/ajaxChangePsw', 'Controller@ajaxUpdatePsw');

Route::group(['middleware' => ['checkRank']], function () {
  Route::get('/administration', 'Controller@backoffice');
  Route::get('/texts', 'Controller@dispTexts');
  Route::get('/partner-modify', 'Controller@partner');
  Route::get('/activités', 'Controller@activityDisplay');
  Route::get('/activités-création', 'Controller@activityCreation');
  Route::get('/activités/modify', 'Controller@activityModify');
  Route::get('/partenaires/modify', 'Controller@partnerModify');
  Route::get('/updateproduct', 'Controller@updateProduct');
  Route::get('/addproduct', 'Controller@addproduct')->name('addproduct');
  Route::get('/productlist/product/modify', 'Controller@updateProduct');
  Route::get('/modifySocial', 'Controller@modifySocial');
  Route::get('/social', 'Controller@social');
  Route::get('/modifyNews', 'Controller@newsModify');
  Route::get('/news-create', 'Controller@newsAdd');
  Route::get('/admin', 'Controller@admin');
  Route::get('/modifyAdmin', 'Controller@modifyAdmin');
  Route::get('/modificationTextes', 'Controller@modifyText');

  Route::post('/adminDelete', 'Controller@adminDelete');
  Route::post('/adminModify', 'Controller@adminUpdate');
  Route::post('/partenaires/create', 'Controller@partnerCreate');
  Route::post('/socialModify', 'Controller@socialUpdate');
  Route::post('/addSocial', 'Controller@addSocial');
  Route::post('/socialDelete', 'Controller@socialDelete');
  Route::post('/activités/modify/send', 'Controller@sendActivityModify');
  Route::post('/activités/modify/delete', 'Controller@deleteActivity');
  Route::post('/partenaires/modify/send', 'Controller@modifyPartner');
  Route::post('/partenaires/modify/delete', 'Controller@deletePartner');
  Route::post('/activités/createSection', 'Controller@createSection');
  Route::post('/addproduct/send', 'Controller@sendProduct');
  Route::post('/productlist/product/modify/send', 'Controller@updateInfos');
  Route::post('/productlist/product/modify/delete', 'Controller@deleteProduct');
  Route::post('/updateNews', 'Controller@newsUpdate');
  Route::post('/addNews', 'Controller@newsCreate');
  Route::post('/newsDelete', 'Controller@newsDelete');
  Route::post('/deleteTextes', 'Controller@deleteText');
  Route::post('/createTextes', 'Controller@textCreate');
});
