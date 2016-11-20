<?php
$router->group(['prefix' => 'permission'],function ($router)
{
	// $router->get('sidebar','MenuController@sidebarMenu');
});
$router->resource('permission','PermissionController');