<?php
namespace App\Service\Api;
use App\Repositories\Eloquent\RoleRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;
use App\Traits\ServiceTrait;
use Exception;
/**
* 角色service
*/
class RoleService
{
	use ServiceTrait;
	
	private $role;
	private $permission;

	function __construct(RoleRepositoryEloquent $role,PermissionRepositoryEloquent $permission)
	{
		$this->role =  $role;
		$this->permission =  $permission;
	}
	/**
	 * datatables获取数据
	 * @author 晚黎
	 * @date   2016-11-02T10:31:46+0800
	 * @return [type]                   [description]
	 */
	public function ajaxIndex()
	{
		// 当前页数
		$current = request('current', 1);
		// 每页显示数目
		$length = request('size', config('admin.golbal.list.length'));
		// 开始条数
		$start = ($current - 1) * $length;
		

		$result = $this->role->getRoleListForVue($start,$length);
		return [
			'total' => $result['count'],
			'data' => $result['roles'],
		];
	}
	/**
	 * 添加角色视图页面数据
	 * @author 晚黎
	 * @date   2016-11-02T17:25:53+0800
	 * @return [type]                   [description]
	 */
	public function getAllPermissionList()
	{
		return $this->permission->groupPermissionList();
	}
	/**
	 * 添加权限
	 * @author 晚黎
	 * @date   2016-11-03
	 * @param  [type]     $formData [表单中所有的数据]
	 * @return [type]               [true or false]
	 */
	public function storeRole($formData)
	{
		$responseData = [
			'status' => false,
			'msg' => trans('admin/alert.role.create_error')
		];
		try {
			$result = $this->role->createRole($formData);
			if ($result) {
				$responseData['status'] = true;
				$responseData['msg'] = trans('admin/alert.role.create_success');
			}
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
		}
		return $responseData;
	}
	/**
	 * 根据ID获取权限数据
	 * @author 晚黎
	 * @date   2016-11-03T09:22:44+0800
	 * @param  [type]                   $id [权限id]
	 * @return [type]                       [查询出来的权限对象，查不到数据时跳转404]
	 */
	public function findRoleById($id,$bool = false)
	{
		$responseData = [
			'status' => false,
			'msg' => '数据错误',
			'role' => [],
			'permissions' => []
		];
		$role =  $this->role->with(['permissions'])->find($id);
		if ($role) {
			$role = $role->toArray();
			if ($bool) {
				if ($role['permissions']) {
					$permissions = [];
					foreach ($role['permissions'] as $v) {
						array_set($permissions, $v['slug'], ['name' => $v['name']]);
					}
					$role['permissions'] = $permissions;
				}
				$responseData['status'] = true;
				$responseData['msg'] = '获取成功';
				$responseData['role'] = $role;
			}else{
				if ($role['permissions']) {
					$ids = [];
					foreach ($role['permissions'] as $v) {
						$ids[] = strval($v['id']);
					}

					$role['permission'] = $ids;
					unset($role['permissions']);
				}
				$responseData['status'] = true;
				$responseData['msg'] = '获取成功';
				$responseData['permissions'] = $this->getAllPermissionList();
				$responseData['role'] = $role;
			}
		}
		return $responseData;
	}
	/**
	 * 修改权限
	 * @author 晚黎
	 * @date   2016-11-03T09:54:21+0800
	 * @param  [type]                   $attributes [表单数据]
	 * @param  [type]                   $id         [resource路由传递过来的id]
	 * @return [type]                               [Boolean]
	 */
	public function updateRole($attributes,$id)
	{
		$responseData = [
			'status' => false,
			'msg' => trans('admin/alert.role.edit_error')
		];
		// 防止用户恶意修改表单id，如果id不一致直接跳转500
		if ($attributes['id'] != $id) {
			return $responseData;
		}
		try {
			$result = $this->role->update($attributes,$id);
			if ($result) {
				// 更新角色权限关系
				if (isset($attributes['permission'])) {
					$result->permissions()->sync($attributes['permission']);
				}else{
					$result->permissions()->sync([]);
				}
				$responseData['status'] = true;
				$responseData['msg'] = trans('admin/alert.role.edit_success');
			}
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
		}
		return $responseData;
	}
	/**
	 * 角色暂不做状态管理，直接删除
	 * @author 晚黎
	 * @date   2016-11-03T10:01:36+0800
	 * @param  [type]                   $id [权限id]
	 * @return [type]                       [Boolean]
	 */
	public function destroyRole($id)
	{
		$responseData = [
			'status' => false,
			'msg' => trans('admin/alert.role.destroy_error')
		];
		try {
			$result = $this->role->delete($id);
			if ($result) {
				$responseData['status'] = true;
				$responseData['msg'] = trans('admin/alert.role.destroy_success');
			}
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
		}
		return $responseData;
	}
}