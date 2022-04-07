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

	Route::get('/', 'HomeController@home');
	Route::get('/contact', 'HomeController@contact');
	Route::get('/about', 'HomeController@about');
	Route::get('/recipe/details/{id}', 'UserController@recipe');
	Route::get('/recipes/cat/{id}', 'UserController@by_category');
	Route::post('/recipes/search', 'UserController@search');
	Route::get('/user/recipes', 'UserController@recipes');
	Route::post('/send/message', 'UserController@save_message');
	Route::post('/user/subscribe', 'UserController@subscribe');
	//Route::get('/user/make', 'HomeController@make_user');
	//Route::get('/admin/make', 'HomeController@make_admin');
	Route::post('/review/add', 'UserController@add_review');
	Route::get('/user/profile/{id}', 'UserController@user_profile');
	Route::group(['middleware'=>'user:user'],function(){
	Route::any('/user/logout','UserController@logout');
	Route::get('/user/profile', 'UserController@profile');
	Route::get('/recipe/add', 'UserController@add_recipe');
	Route::get('/user/wishlist', 'UserController@my_wishlist');
	Route::get('/wishlist/add/{id}', 'UserController@add_wishlist');
	Route::post('/recipe/save', 'UserController@request_recipe');
	Route::post('/profile/edit', 'UserController@edit_profile');
	Route::get('/history/recipes', 'UserController@history_recipes');

});

Route::group(['middleware'=>'guest'],function(){
	Route::get('password/reset/{token}','UserController@reset');
	Route::post('password/reset/{token}','UserController@reset_final');
	Route::get('apassword/reset/{token}','AdminController@reset');
	Route::post('apassword/reset/{token}','AdminController@reset_final');
	Route::post('/user/forget', 'UserController@reset_request');
	Route::get('/forget/password', 'UserController@forget_password');
	Route::post('/admin/forget', 'AdminController@reset_request');
	Route::get('/aforget/password', 'AdminController@forget_password');
	Route::post('/check/admin','AdminController@check_login');	
	Route::post('/check/user','UserController@check_login');	
	Route::get('/admin/login', 'AdminController@login');
	Route::get('/user/login', 'UserController@login');
	Route::get('/user/register', 'UserController@register');
	Route::post('/user/doregister', 'UserController@do_register');
	Route::get('/admin/register', 'AdminController@register');
	Route::post('/admin/doregister', 'AdminController@do_register');
});

Route::group(['middleware'=>'admin:admin'],function(){

	Route::get('/admin/messages', 'AdminController@messages');
	Route::get('/admin/requests', 'AdminController@requests');
	Route::any('/admin/logout','AdminController@logout');
	Route::get('/accept/request/{id}', 'AdminController@accept_request');
	Route::get('/refuse/request/{id}', 'AdminController@refuse_request');
	Route::get('/admin/profile/{id}', 'AdminController@profile');
	Route::post('/admin/edit', 'AdminController@edit_profile');
	Route::get('/category/add', 'AdminController@add_category');
	Route::post('/category/save', 'AdminController@save_category');
});
