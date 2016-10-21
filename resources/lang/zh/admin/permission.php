<?php
return [
	'title' => '权限管理',
	'desc' => '权限列表',
	'model' => [
		'name' => '权限',
        'description' => '描述',
        'created_at' => '创建时间',
        'updated_at' => '修改时间',
	],
	'action' => [
		'create' => '<i class="fa fa-plus"></i> 添加权限',
	],
	'tools' => [
		'title' => 'Trigger Tools',
		'copy' => '<i class="fa fa-print"></i> Print',
		'print' => '<i class="fa fa-clone"></i> Copy',
		'pdf' => '<i class="fa fa-file-pdf-o"></i> PDF',
		'excel' => '<i class="fa fa-file-excel-o"></i> Excel',
		'csv' => '<i class="fa fa-cloud-upload"></i> CSV',
	]
];