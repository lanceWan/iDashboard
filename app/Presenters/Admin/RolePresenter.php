<?php
namespace App\Presenters\Admin;

class RolePresenter
{
	/**
	 * 修改角色界面，角色权限列表
	 * @author 晚黎
	 * @date   2016-11-03T09:36:36+0800
	 * @param  [type]                   $permissions     [所有权限]
	 * @param  [type]                   $rolePermissions [该角色已有的权限]
	 * @return [type]                                    [html]
	 */
	public function permissionList($permissions,$rolePermissions=[])
	{
		$html = '';
		if ($permissions) {
			foreach ($permissions as $key => $permission) {
				$html .= "<tr><td>".$key."</td><td>";
				if (is_array($permission)) {
					foreach ($permission as $k => $v) {
						$html .= <<<Eof
						<div class="col-md-4">
	                     	<div class="i-checks">
	                        	<label> <input type="checkbox" name="permission[]" {$this->checkPermisison($v['id'],$rolePermissions)} value="{$v['id']}"> <i></i> {$v['name']} </label>
	                      	</div>
                      	</div>
Eof;
					}
				}
				$html .= '</td></tr>';
			}
		}
		return $html;
	}
	/**
	 * 添加角色出现错误时，获取已经填写的权限
	 * @author 晚黎
	 * @date   2016-11-03T09:42:15+0800
	 * @param  [type]                   $permissionId   [权限ID]
	 * @param  [type]                   $rolePermissions[修改角色时所有权限ID数组]
	 * @return [type]                                   [string]
	 */
	private function checkPermisison($permissionId,$rolePermissions = [])
	{
		$permissions = old('permission');
		if ($permissions) {
			return in_array($permissionId,$permissions) ? 'checked="checked"':'';
		}
		if ($rolePermissions) {
			if ($rolePermissions) {
				if ($permissions) {
					if (in_array($permissionId,$rolePermissions) && in_array($permissionId,$permissions)) {
						return 'checked="checked"';
					}
				}else{
					return in_array($permissionId,$rolePermissions) ? 'checked="checked"':'';
				}
				return '';
			}
			return '';
		}
		return '';
	}

	/**
	 * 查看用户角色权限时展示的table
	 * @author 晚黎
	 * @date   2016-11-03T10:58:56+0800
	 * @param  [type]                   $rolePermissions [description]
	 * @return [type]                                    [description]
	 */
	public function showRolePermissions($rolePermissions)
	{
		$html = '';
		if (!$rolePermissions->isEmpty()) {
			// 将角色权限分组
			$permissionArray = [];
			foreach ($rolePermissions as $v) {
				array_set($permissionArray, $v->slug, ['id' => $v->id,'name' => $v->name]);
			}
			if ($permissionArray) {
				foreach ($permissionArray as $key => $permission) {
					$html .= "<tr><td>".$key."</td><td>";
					if (is_array($permission)) {
						foreach ($permission as $k => $v) {
							$html .= <<<Eof
							<div class="col-md-4">
	                        	<label> {$v['name']} </label>
	                      	</div>
Eof;
						}
					}
					$html .= '</td></tr>';
				}
			}
		}
		return $html;
	}
}