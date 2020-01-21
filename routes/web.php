<?php

/*
Route Panel
*/
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