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


Auth::routes();


// --------- N O V E L -------
    Route::group(['prefix' => 'novels'],function (){
        Route::get('/', 'NovelController@index')->name('novels');
    });

    Route::group(['prefix' => 'novel'],function (){
        Route::get('/{url}', 'NovelController@perfil')->name('novel');
    });
// --------------------------------
// --------- G R U P O --------
    Route::group(['prefix' => 'grupos'],function (){
        Route::get('/', 'GrupoController@index')->name('grupos');
    });

    Route::group(['prefix' => 'grupo'],function (){
        Route::get('/{url}', 'GrupoController@perfil')->name('grupo');
    });
// --------------------------------
// --------- D A S H B O A R D---
    Route::group(['prefix' => 'dashboard','middleware' => ['auth','role:Admin']],function (){
        //Rota Base/Perfil
        Route::get('/', 'DashboardController@index')->name('dashboard');
        //Rotas Relacionadas a Novels
        Route::group(['prefix' => 'novel'],function (){
            Route::get('/adicionar/', 'NovelController@adicionarForm')->name('dashboard.novel.add');
            Route::post('/adicionar/', 'NovelController@store')->name('dashboard.novel.add');
            Route::get('/alterar/{id}', 'NovelController@alterarForm')->where('id', '[0-9]+')->name('dashboard.novel.alt');
            Route::post('/alterar/{id}', 'NovelController@store')->where('id', '[0-9]+')->name('dashboard.novel.alt');
            Route::post('/remover/{id}', 'NovelController@store')->where('id', '[0-9]+')->name('dashboard.novel.del');
        });
        
        Route::group(['prefix' => 'grupo'],function (){
            Route::get('/adicionar/', 'GrupoController@adicionarForm')->name('dashboard.grupo.add');
            Route::post('/adicionar/', 'GrupoController@store')->name('dashboard.grupo.add');
            Route::get('/alterar/{id}', 'GrupoController@alterarForm')->where('id', '[0-9]+')->name('dashboard.grupo.alt');
            Route::post('/alterar/{id}', 'GrupoController@store')->where('id', '[0-9]+')->name('dashboard.grupo.alt');
            Route::post('/remover/{id}', 'GrupoController@store')->where('id', '[0-9]+')->name('dashboard.grupo.del');
        });
        //Rotas Permitidas somente a Admins
        Route::group(['prefix' => 'admin','middleware' => ['auth','role:Admin']],function (){
            Route::get('/users', 'AdminController@users')->name('dashboard.admin.users');
        });
    });

    Route::get('/teste', 'AdminController@teste')->name('teste');
// --------------------------------
// --------- O U T R O S -------
    Route::group(['prefix' => 'extcn'],function (){
        Route::get('/{id}', 'ExtCnController@redirect')->where('id', '[0-9]+')->name('extcn');
    });
    Route::group(['prefix' => 'rating'],function (){
        Route::post('/novel/{id}', 'RatingController@novel')->where('id', '[0-9]+')->name('rating.novel');
        Route::get('/novel/{id}', 'RatingController@novelBack')->where('id', '[0-9]+')->name('rating.back');
        Route::post('/grupo/{id}', 'RatingController@grupo')->where('id', '[0-9]+')->name('rating.grupo');
        Route::get('/grupo/{id}', 'RatingController@grupoBack')->where('id', '[0-9]+')->name('rating.back');
    });
    Route::group(['prefix' => 'favorite'],function (){
        Route::GET('/novel/{id}', 'FavoriteController@novelS')->where('id', '[0-9]+')->name('favorite.parceiro.novel');
        Route::POST('/novel/{id}', 'FavoriteController@novelT')->where('id', '[0-9]+')->name('favorite.novel');
    });
// --------------------------------
// --------- D A T A T A B L E S ---
    Route::group(['prefix' => 'datatables'],function (){
        Route::get('/feed', 'DataTablesController@feed')->name('datatables.feed');
        Route::get('/novel/{id}', 'DataTablesController@novel')->where('id', '[0-9]+')->name('datatables.novel');
        Route::get('/grupo/{id}', 'DataTablesController@grupo')->where('id', '[0-9]+')->name('datatables.grupo');
        Route::get('/user', ['uses' => 'DataTablesController@user','middleware' => ['auth','role:Admin']])->name('datatables.user');
        
    });
    Route::group(['prefix' => 'api'],function (){
        Route::get('/feed', 'DataTablesController@feedApi')->name('datatables.feed.api');
    });
// --------------------------------
// --------- G E R A L ------------
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/alianca', 'AliancaController@index')->name('alianca');
    Route::get('/sobre', 'SobreController@index')->name('sobre');
    Route::get('/termos', 'TermosController@index')->name('termos');
    Route::get('/politica', 'PoliticaController@index')->name('politica');
    Route::get('/contato', 'ContatoController@index')->name('contato');
    Route::post('/contato', 'ContatoController@sendEmail')->name('contato.send');
// --------------------------------