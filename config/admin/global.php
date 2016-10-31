<?php
return [
	// 自定义登录字段
	'username' => 'name',
	// 分页
	'list' => [
		'start'=> 0,
		'length' => 10,
	],
	/**
	 * 全局状态
	 * active 	正常
	 * ban 		禁用
	 * addit 	待审核
	 * trash	回收站
	 * destory 	彻底删除
	 */
	'status' => [
		'active' => 1,
		'ban' => 2,
		'audit' => 3,
		'trash' => 99,
		'destory' => -1
	],
	'permission' => [
		// 控制是否显示查看按钮
		'show' => false,
	],
];