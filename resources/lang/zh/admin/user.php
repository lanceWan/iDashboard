<?php
return [
	'title' 	=> '用户管理',
	'desc' 		=> '用户列表',
	'create' 	=> '添加用户',
	'edit' 		=> '修改用户',
	'info' 		=> '用户信息',
	'permission'=> '权限',
	'role'		=> '角色',
	'module'	=> '模块',
	'model' 	=> [
		'id' 			=> 'ID',
		'name' 			=> '用户名',
		'username' 		=> '账号',
		'password' 		=> '密码',
		'email' 		=> '邮箱',
        'created_at' 	=> '创建时间',
        'updated_at' 	=> '修改时间',
	],
	'action' => [
		'create' => '<i class="fa fa-user"></i> 添加用户',
	],
	'other_permission'	=> '<strong>注意！</strong> 当某个角色的用户需要额外权限时添加。',
	'role_info'			=> '查看角色权限',
];