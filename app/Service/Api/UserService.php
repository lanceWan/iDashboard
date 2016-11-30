<?php
namespace App\Service\Api;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\Eloquent\RoleRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;
use App\Traits\ServiceTrait;
use Exception;
/**
* 角色service
*/
class UserService
{
	use ServiceTrait;
	
	private $user;
	private $role;
	private $permission;

	function __construct(UserRepositoryEloquent $user,RoleRepositoryEloquent $role,PermissionRepositoryEloquent $permission)
	{
		$this->user =  $user;
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

		$result = $this->user->getUserListForVue($start,$length);

		return [
			'total' => $result['count'],
			'data' => $result['users'],
		];
	}
	/**
	 * 创建用户视图数据
	 * @author 晚黎
	 * @date   2016-11-03T13:29:53+0800
	 * @return [type]                   [description]
	 */
	public function createView()
	{
		$permissions = $this->getAllPermissionList();
		$roles = $this->getAllRoles();
		return compact('permissions','roles');
	}
	/**
	 * 获取所有权限并分组
	 * @author 晚黎
	 * @date   2016-11-03T13:30:13+0800
	 * @return [type]                   [description]
	 */
	public function getAllPermissionList()
	{
		return $this->permission->groupPermissionList();
	}
	/**
	 * 获取所有的角色
	 * @author 晚黎
	 * @date   2016-11-03T13:23:46+0800
	 * @return [type]                   [description]
	 */
	public function getAllRoles()
	{
		return $this->role->all(['id','name']);
	}
	/**
	 * 添加用户
	 * @author 晚黎
	 * @date   2016-11-03T15:16:00+0800
	 * @param  [type]                   $formData [表单中所有的数据]
	 * @return [type]                             [Boolean]
	 */
	public function storeUser($formData)
	{
		$responseData = [
			'status' => false,
			'msg' => trans('admin/alert.user.create_error')
		];
		try {
			$result = $this->user->create($formData);
			if ($result) {
				// 角色与用户关系
				if ($formData['role']) {
					$result->roles()->sync($formData['role']);
				}
				// 权限与用户关系
				if ($formData['permission']) {
					$result->userPermissions()->sync($formData['permission']);
				}
			}
			if ($result) {
				$responseData['status'] = true;
				$responseData['msg'] = trans('admin/alert.user.create_success');
			}
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
		}
		return $responseData;
	}
	/**
	 * 编辑用户视图所需数据
	 * @author 晚黎
	 * @date   2016-11-03T15:52:46+0800
	 * @param  [type]                   $id [用户ID]
	 * @return [type]                       [description]
	 */
	public function editView($id)
	{
		$responseData = [
			'status' => false,
			'msg' => '获取用户失败'
		];
		$user = $this->findUserById($id);
		if ($user) {
			$responseData['status'] = true;
			$responseData['msg'] = '获取成功';
			$responseData['user'] = $user;
			$responseData['permissions'] = $this->getAllPermissionList();
			$responseData['roles'] = $this->getAllRoles();
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
	public function findUserById($id)
	{
		$role =  $this->user->with(['userPermissions','roles'])->find($id);
		if ($role) {
			return $role;
		}
		abort(404);
	}
	/**
	 * 修改用户
	 * @author 晚黎
	 * @date   2016-11-03T16:12:05+0800
	 * @param  [type]                   $attributes [表单数据]
	 * @param  [type]                   $id         [resource路由传递过来的id]
	 * @return [type]                               [Boolean]
	 */
	public function updateUser($attributes,$id)
	{
		// 防止用户恶意修改表单id，如果id不一致直接跳转500
		if ($attributes['id'] != $id) {
			abort(500,trans('admin/errors.user_error'));
		}
		try {
			$result = $this->user->update($attributes,$id);
			if ($result) {
				// 更新用户角色关系
				if (isset($attributes['role'])) {
					$result->roles()->sync($attributes['role']);
				}else{
					$result->roles()->sync([]);
				}
				// 更新用户权限关系
				if (isset($attributes['permission'])) {
					$result->userPermissions()->sync($attributes['permission']);
				}else{
					$result->userPermissions()->sync([]);
				}
			}
			flash_info($result,trans('admin/alert.user.edit_success'),trans('admin/alert.user.edit_error'));
			return $result;
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
	}
	/**
	 * 用户暂不做状态管理，直接删除
	 * @author 晚黎
	 * @date   2016-11-03T16:33:12+0800
	 * @param  [type]                   $id [用户ID]
	 * @return [type]                       [Boolean]
	 */
	public function destroyUser($id)
	{
		try {
			$result = $this->user->delete($id);
			flash_info($result,trans('admin/alert.user.destroy_success'),trans('admin/alert.user.destroy_error'));
			return $result;
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
		
	}
	/**
	 * 重置用户密码
	 * @author 晚黎
	 * @date   2016-11-03T17:30:09+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function resetUserPassword($id)
	{
		$responseData = [
			'status'=> false,
			'msg' 	=> trans('admin/alert.user.reset_error'),
		];
		$result = $this->user->update(['password' => config('admin.global.reset')],$id);
		if ($result) {
			$responseData['status'] = true;
			$responseData['msg'] 	= trans('admin/alert.user.reset_success');
		}
		return $responseData;
	}
}