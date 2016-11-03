<?php
$router->group(['prefix' => 'user'],function ($router)
{
	$router->get('ajaxIndex','UserController@ajaxIndex')->name('user.ajaxIndex');
	$router->get('/{id}/reset','UserController@resetPassword')->name('user.reset');
});
$router->resource('user','UserController');