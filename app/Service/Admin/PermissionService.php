<?php
namespace App\Service\Admin;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;
/**
* 权限service
*/
class PermissionService
{
	private $permission;

	private $action = 'permission';

	function __construct(PermissionRepositoryEloquent $permission)
	{
		$this->permission =  $permission;
	}
	
	public function ajaxIndex()
	{
		// datatables请求次数
		$draw = request('draw', 1);
		// 开始条数
		$start = request('start', config('admin.golbal.list.start'));
		// 每页显示数目
		$length = request('length', config('admin.golbal.list.length'));
		// datatables是否启用模糊搜索
		$search['regex'] = request('search.regex', false);
		// 搜索框中的值
		$search['value'] = request('search.value', '');
		// 排序
		$order['name'] = request('columns.' .request('order.0.column',0) . '.name');
		$order['dir'] = request('order.0.dir','asc');

		$result = $this->permission->getPermissionList($start,$length,$search,$order);

		$permissions = [];

		if ($result['permissions']) {
			foreach ($result['permissions'] as $v) {
				$v['actionButton'] = '<a href="#" class="btn btn-xs btn-outline btn-info tooltips" data-toggle="tooltip" data-original-title="top....."  data-placement="top"><i class="fa fa-search"></i></a>';
				$permissions[] = $v;
			}
		}

		return [
			'draw' => $draw,
			'recordsTotal' => $result['count'],
			'recordsFiltered' => $result['count'],
			'data' => $permissions,
		];
	}
}