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



if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

    Route::get('/', 'HomeController@home');
    Route::get('/contact', 'HomeController@contact');
    Route::get('/about', 'HomeController@about');
    Route::get('/program/details/{id}', 'HomeController@program');
    Route::get('/programs/cat/{id}', 'HomeController@by_category');
    Route::post('/programs/search', 'HomeController@search');
    Route::get('/programs', 'HomeController@programs');
    Route::get('/institues', 'HomeController@institues');
    Route::get('/institue/details/{id}', 'HomeController@institue');
    Route::post('/send/message', 'HomeController@save_message');
    Route::get('/user/make', 'HomeController@make_user');
    Route::get('/institue/make', 'HomeController@make_institue');
        Route::post('/send/message', 'ParentController@send_message');

Route::group(['middleware'=>'guest'],function(){

    Route::get('password/reset/{token}','ParentController@reset');
    Route::post('password/reset/{token}','ParentController@reset_final');
    Route::post('/parent/forget', 'ParentController@reset_request');
    Route::get('/forget/password', 'ParentController@forget_password');

    Route::get('spassword/reset/{token}','SubController@reset');
    Route::post('spassword/reset/{token}','SubController@reset_final');
    Route::post('/sub/forget', 'SubController@reset_request');
    Route::get('/sforget/password', 'SubController@forget_password');

    Route::get('apassword/reset/{token}','AdminController@reset');
    Route::post('apassword/reset/{token}','AdminController@reset_final');
    Route::post('/admin/forget', 'AdminController@reset_request');
    Route::get('/aforget/password', 'AdminController@forget_password');

    Route::get('sub/login','SubController@login');
    Route::get('admin/login','AdminController@login');
    Route::get('parent/login','ParentController@login');
    Route::post('/check/sub','SubController@check_login');
    Route::post('/check/admin','AdminController@check_login');
    Route::post('/check/parent','ParentController@check_login');
    Route::get('/sub/register', 'SubController@register');
    Route::post('/sub/doregister', 'SubController@do_register');
    Route::get('/admin/register', 'AdminController@register');
    Route::post('/admin/doregister', 'AdminController@do_register');
    Route::get('/parent/register', 'ParentController@register');
    Route::post('/parent/doregister', 'ParentController@do_register');
});


Route::group(['middleware'=>'admin:admin'],function(){
Route::any('/admin/logout','AdminController@logout');
Route::post('/aedit/institue','AdminController@edit_institue');
Route::post('/admin/edit','AdminController@edit_profile');
Route::get('/admin/profile','AdminController@profile');
Route::get('/add/institue','AdminController@add_institue');
Route::post('/save/institue','AdminController@save_institue');
Route::get('/admin/messages','AdminController@messages');
Route::get('/admin/sent','AdminController@sent');
Route::get('/admin/contact','AdminController@contact');
Route::post('/admin/preply','AdminController@reply_parent');
Route::post('/admin/sreply','AdminController@reply_sub');
});

Route::group(['middleware'=>'sub:sub'],function(){
Route::any('/sub/logout','SubController@logout');
Route::post('/institue/edit','SubController@edit_institue');
Route::post('/sub/edit','SubController@edit_profile');
Route::get('/sub/profile','SubController@profile');
Route::get('/sub/institue','SubController@institue');
Route::get('/sub/programs','SubController@programs');
Route::get('/add/program','SubController@add_program');
Route::post('/save/program','SubController@save_program');
Route::get('/sub/messages','SubController@messages');
Route::get('/sub/sent','SubController@sent');
Route::post('/sub/areply','SubController@reply_admin');
Route::post('/sub/preply','SubController@reply_parent');
Route::get('/sub/requests','SubController@bookings');
Route::get('/accept/request/{id}', 'SubController@accept_request');
Route::get('/refuse/request/{id}', 'SubController@refuse_request');
});


Route::group(['middleware'=>'parent:parent'],function(){

    Route::get('/parent/messages', 'ParentController@messages');
    Route::get('/history/programs', 'ParentController@bookings');
    Route::any('/parent/logout','ParentController@logout');
    Route::get('/book/program/{id}', 'ParentController@book');
    Route::get('/parent/profile', 'ParentController@profile');
    Route::post('/parent/edit', 'ParentController@edit_profile');
    Route::get('/parent/messages','ParentController@messages');
    Route::get('/parent/sent','ParentController@sent');
    Route::post('/reply/sub','ParentController@reply_sub');
    Route::post('/reply/admin','ParentController@reply_admin');
    Route::post('/comment/add', 'ParentController@add_comment');

});


