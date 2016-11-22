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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['namespace' => 'Api','middleware' => ['auth:api']], function ($router)
{
	// 菜单
	require(__DIR__ . '/api/menu.php');
	// 权限
	require(__DIR__ . '/api/permission.php');
	// 角色
	require(__DIR__ . '/api/role.php');
});
