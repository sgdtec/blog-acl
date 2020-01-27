<?php

/*
Route Panel

*/

//Routess Users
Route::any('/painel/usuario/pesquisar', 'painel\UserController@search')->name('usuarios.search');
Route::resource('/painel/usuarios', 'Painel\UserController');


Route::get('/painel', 'Painel\PainelController@index');
/**
 * End Route Panel
 */ 

/**
 * Route Site
 */
Route::get('/', 'Site\SiteController@index');
/**
 * End Route Site
 */