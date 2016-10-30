<?php
$router->group(['prefix' => 'permission'],function ($router)
{
	$router->get('ajaxIndex','PermissionController@ajaxIndex');
});
$router->resource('permission','PermissionController');