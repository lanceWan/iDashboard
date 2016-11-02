<?php
$router->group(['prefix' => 'permission'],function ($router)
{
	$router->get('ajaxIndex','PermissionController@ajaxIndex')->name('permission.ajaxIndex');
});
$router->resource('permission','PermissionController',['except' => ['show']]);