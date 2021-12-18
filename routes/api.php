<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//Routes Protected with Middleware
//Super Admin Middleware level
Route::group(['prefix' => 'v1', 'middleware' => 'superAdminAuthMiddleware'], function () {

	//Get All Services
	Route::get('/admin/services/get/all', ['uses' => 'ServiceController@adminGetAllServices']);

	//Create New Service
	Route::post('/admin/create/service', ['uses' => 'ServiceController@adminCreateService']);

});


//Routes Protected with Middleware
//Admin Middleware Level
Route::group(['prefix' => 'v1', 'middleware' => 'normalAdminAuthMiddleware'], function () {

	//Get All Services
	Route::get('/user/services/get/all', ['uses' => 'ServiceController@userGetAllServices']);

	//Get All Gateways
	Route::get('/user/gateway/get/all', ['uses' => 'GatewayController@userGatewayGetAll']);

	//Create New Gateway
	Route::post('/user/gateway/create', ['uses' => 'GatewayController@userCreateGateway']);

});

//Routes Protected with Middleware
//Normal Middleware Level
Route::group(['prefix' => 'v1', 'middleware' => 'userAuthMiddleware'], function () {

	//Logout API
	Route::post('/auth/logout', ['uses' => 'Controller@accountLogout']);

});

//Unprotected Routes
Route::group(['prefix' => 'v1'], function () {

	//Get Gateway Stanzas
	Route::get('/get/confs/stanzas', ['uses' => 'GatewayController@getConfsStanzas']);

	//Auth Login
	Route::post('/auth/login', ['uses' => 'Controller@accountLogin']);

	//Auth Register
    Route::post('/auth/register', ['uses' => 'Controller@createNewAccount']);

});