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

Route::get('/', 'HomeController@index')->name('index'); // questa rotta punta alla home page da utenti non loggati
Route::get('/contatti', 'HomeController@contatti')->name('contatti');

Auth::routes(['register' => false]); // Auth::routes() genera tutte le rotte x l'autenticazione(forgot password, login, logout.......)
// ['register' => false] disabilita la registrazione al sito


Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function(){

    Route::get('/', 'HomeController@index')->name('index') ; // ->middleware sta in mezzo fra Auth::routes() e Route::get per verificare che l'utente sia loggato o autenticato

    // questo viene fatto per gli utenti loggati, puo' sembrare uguale alla prima route ma non lo e' perche' si trova nel ->group(function(){}
    Route::resource('/posts', 'PostController'); 
}); // questo viene fatto perche' avremo una index sia pubblica che da utenti loggati
