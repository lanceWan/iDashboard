<?php
$router->group(['prefix' => 'menu'],function ($router)
{
	// $router->get('orderable','MenuController@orderable')->name('menu.orderable');
	$router->get('sidebar','MenuController@sidebarMenu')->name('menu.orderable');
});
$router->resource('menu','MenuController');