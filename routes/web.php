<?php

/*Route Panel*/
Route::group(['prefix' => 'painel', 'middleware' => 'auth'], function() {
    //Routess Users
    Route::any('usuario/pesquisar', 'painel\UserController@search')->name('usuarios.search');
    Route::resource('usuarios', 'Painel\UserController');
    
    //Routes Categories
    Route::any('categorias/pesquisar', 'painel\CategoryController@search')->name('categorias.search');
    Route::resource('categorias', 'Painel\CategoryController');

    //Routes Posts
    Route::any('posts/pesquisar', 'painel\PostController@search')->name('posts.search');
    Route::resource('posts', 'Painel\PostController');
    
    //Route Profile User
    Route::get('perfil', 'Painel\UserController@showProfile')->name('profile');
    Route::post('perfil/{id}', 'Painel\UserController@updateProfile')->name('profile.update');
    
    Route::get('/', 'Painel\PainelController@index');
});
/*** End Route Panel*/ 


/******************************************************************
 * Rotas de Autenticação
 ******************************************************************/
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
/******************************************************************
 * Rotas de Autenticação
 ******************************************************************/


 /**Route Site*/
Route::get('/', 'Site\SiteController@index');
/**End Route Site*/