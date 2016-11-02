<?php
namespace App\Presenters\Admin;

class RolePresenter
{
	public function permissionList($permissions)
	{
		$html = '';
		if ($permissions) {
			foreach ($permissions as $permission) {
				foreach ($permission as $k => $v) {
					$html .= '<tr><td class="text-center" style="vertical-align: middle;"> {{$k}} </td><td>';
				}
			}
		}
	}
}