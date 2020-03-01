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
    
    //Routes Comments
    Route::any('comentarios/pesquisar', 'painel\CommentController@search')->name('comments.search');
    Route::get('comentarios', 'Painel\CommentController@index')->name('comments');
    Route::get('comentario/{id}/respostas', 'Painel\CommentController@answers');
    Route::post('comentatio/{id}/answer', 'Painel\CommentController@answerComment')->name('answer.comment');
    Route::post('comentatio/{id}/destroy', 'Painel\CommentController@destroy')->name('destroy.comment');
    Route::get('comentatio/{id}/resposta/{idAnswer}/delete', 'Painel\CommentController@destroyAnswer')->name('destroy.answer');

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
Route::any('/buscar', 'Site\SiteController@search')->name('search.blog');
Route::post('/comment-post', 'Site\SiteController@commentPost')->name('comment');
Route::get('/tutorial/{url}', 'Site\SiteController@post')->name('post');
Route::get('/categoria/{url}', 'Site\SiteController@category');
Route::get('empresa', 'Site\SiteController@company')->name('company');
Route::get('contato', 'Site\SiteController@contact')->name('contact');
Route::post('contact', 'Site\SiteController@sendContact')->name('contact');
Route::get('/', 'Site\SiteController@index');
/**End Route Site*/