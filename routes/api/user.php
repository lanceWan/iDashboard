<?php
$router->group(['prefix' => 'user'],function ($router)
{
	$router->get('/{id}/reset','UserController@resetPassword')->name('user.reset');
});
$router->resource('user','UserController');