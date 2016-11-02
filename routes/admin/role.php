<?php
$router->group(['prefix' => 'role'],function ($router)
{
	$router->get('ajaxIndex','RoleController@ajaxIndex')->name('role.ajaxIndex');
});
$router->resource('role','RoleController');