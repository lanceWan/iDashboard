<?php
// $router->group(['prefix' => 'menu'],function ($router)
// {
// 	$router->get('ajaxIndex','MenuController@ajaxIndex')->name('menu.ajaxIndex');
// });
$router->resource('menu','MenuController',['except' => ['show']]);