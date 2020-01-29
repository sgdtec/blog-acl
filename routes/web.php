<?php

/*Route Panel*/
Route::group(['prefix' => 'painel'], function() {
    //Routess Users
    Route::any('usuario/pesquisar', 'painel\UserController@search')->name('usuarios.search');
    Route::resource('usuarios', 'Painel\UserController');
    
    //Routes Categories
    Route::any('categorias/pesquisar', 'painel\CategoryController@search')->name('categorias.search');
    Route::resource('categorias', 'Painel\CategoryController');
    Route::get('/', 'Painel\PainelController@index');
});
/*** End Route Panel*/ 


/**Route Site*/
Route::get('/', 'Site\SiteController@index');
/**End Route Site*/