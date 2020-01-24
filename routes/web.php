<?php

/*
Route Panel

*/
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