<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', ['uses' => 'HomeController@home', 'as' => 'home']);


/*
 * Authenticated group
 */
Route::group(array('before' => 'auth'), function(){
    /*
     * CSRF protection group
     */
    Route::group(array('before' => 'csrf'), function() {
        /* Change password (POST) */
        Route::post('/account/change-password', array('as' => 'account-change-password-post', 'uses' => 'AccountController@postChangePassword'));

        // Create, edit and delete SCHEME (POST)
        Route::post('/admin/schemes/create', array('as' => 'admin-schemes-create-post', 'uses' => 'SchemeController@postCreate'));
        Route::post('/admin/schemes/edit', array('as' => 'admin-schemes-edit-post', 'uses' => 'SchemeController@postEdit'));
        Route::post('/admin/schemes/delete', array('as' => 'admin-schemes-delete-post', 'uses' => 'SchemeController@postDelete'));

        // Create, edit and delete ROLE (POST)
        Route::post('/admin/roles/create', array('as' => 'admin-roles-create-post', 'uses' => 'RoleController@postCreate'));
        Route::post('/admin/roles/edit', array('as' => 'admin-roles-edit-post', 'uses' => 'RoleController@postEdit'));
        Route::post('/admin/roles/delete', array('as' => 'admin-roles-delete-post', 'uses' => 'RoleController@postDelete'));

        // Create, edit and delete USER (POST)
        Route::post('/admin/users/create', array('as' => 'admin-users-create-post', 'uses' => 'UserController@postCreate'));
        Route::post('/admin/users/edit', array('as' => 'admin-users-edit-post', 'uses' => 'UserController@postEdit'));
        Route::post('/admin/users/delete', array('as' => 'admin-users-delete-post', 'uses' => 'UserController@postDelete'));

        //
        Route::post('/user/uploads/upload', array('as' => 'user-uploads-upload', 'uses' => 'UploadController@upload'));

    });

    /* Change password (GET) */
    Route::get('/account/change-password', array('as' => 'account-change-password', 'uses' => 'AccountController@getChangePassword'));
    /* Sign out (GET) */
    Route::get('/account/sign-out', array('as' => 'account-sign-out', 'uses' => 'AccountController@getSignOut'));

    /* USER */
    // List UPLOAD (GET)
    Route::get('/user/uploads/list', array('as' => 'user-uploads-list', 'uses' => 'UploadController@getList'));
    Route::get('/user/download-file-count', array('as' => 'user-download-file-count', 'uses' => 'UploadController@downloadFileCount'));
    Route::get('/user/download-file', array('as' => 'user-download-file', 'uses' => 'UploadController@downloadFile'));
    Route::post('/user/get-output', array('as' => 'user-get-output', 'uses' => 'UploadController@getOutput'));

    /* ADMIN */
    // List, create, edit, delete ROLE (GET)
    Route::get('/admin/roles/list', array('as' => 'admin-roles-list', 'uses' => 'RoleController@getList'));
    Route::get('/admin/roles/create', array('as' => 'admin-roles-create', 'uses' => 'RoleController@getCreate'));
    Route::get('/admin/roles/edit/{role_id}', array('as' => 'admin-roles-edit', 'uses' => 'RoleController@getEdit'));
    Route::get('/admin/roles/delete/{role_id}', array('as' => 'admin-roles-delete', 'uses' => 'RoleController@getDelete'));

    // List, create, edit, delete USER (GET)
    Route::get('/admin/users/list', array('as' => 'admin-users-list', 'uses' => 'UserController@getList'));
    Route::get('/admin/users/create', array('as' => 'admin-users-create', 'uses' => 'UserController@getCreate'));
    Route::get('/admin/users/edit/{user_id}', array('as' => 'admin-users-edit', 'uses' => 'UserController@getEdit'));
    Route::get('/admin/users/delete/{user_id}', array('as' => 'admin-users-delete', 'uses' => 'UserController@getDelete'));

    // AJAX REQUESTS
    // --user roles--
    Route::get('/admin/get-resources', array('as' => 'admin-get-resources', 'uses' => 'AjaxController@getResources'));
    Route::get('/admin/get-schemes', array('as' => 'admin-get-schemes', 'uses' => 'AjaxController@getSchemes'));
    Route::get('/user/uploads/check-output', array('as' => 'user-uploads-check-output', 'uses' => 'UploadController@checkOutput'));

});

/* Unauthenticated group */
Route::group(array('before' => 'guest'), function() {

    /* CSRF protection group */
    Route::group(array('before' => 'csrf'), function() {
        /* Sign in (POST) */
        Route::post('/account/sign-in', array('as' => 'account-sign-in-post', 'uses' => 'AccountController@postSignIn'));
        /* Forgot password (POST) */
        Route::post('/account/forgot-password', array('as' => 'account-forgot-password-post', 'uses' => 'AccountController@postForgotPassword'));
    });

    /* Sign in (GET) */
    Route::get('/account/sign-in', array('as' => 'account-sign-in', 'uses' => 'AccountController@getSignIn'));
    /* Forgot password (GET) */
    Route::get('/account/forgot-password', array('as' => 'account-forgot-password', 'uses' => 'AccountController@getForgotPassword'));
    Route::get('/account/recover/{code}', array('as' => 'account-recover', 'uses' => 'AccountController@getRecover'));

    Route::get('/about', ['uses' => 'HomeController@about', 'as' => 'about']);
    Route::get('/contact', ['uses' => 'HomeController@contact', 'as' => 'contact']);

});

