<?php
namespace App\Service\Admin;
use App\Repositories\Eloquent\RoleRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;
use App\Service\Admin\BaseService;
use Exception;
/**
* 角色service
*/
class RoleService extends BaseService
{

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

		$result = $this->role->getRoleList($start,$length,$search,$order);

		$roles = [];

		if ($result['roles']) {
			foreach ($result['roles'] as $v) {
				$v->actionButton = $v->getActionButtonAttribute(false);
				$roles[] = $v;
			}
		}

		return [
			'draw' => $draw,
			'recordsTotal' => $result['count'],
			'recordsFiltered' => $result['count'],
			'data' => $roles,
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
		try {
			$result = $this->role->createRole($formData);
			flash_info($result,trans('admin/alert.role.create_success'),trans('admin/alert.role.create_error'));
			return $result;
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
	}
	/**
	 * 根据ID获取权限数据
	 * @author 晚黎
	 * @date   2016-11-03T09:22:44+0800
	 * @param  [type]                   $id [权限id]
	 * @return [type]                       [查询出来的权限对象，查不到数据时跳转404]
	 */
	public function findRoleById($id)
	{
		$role =  $this->role->with(['permissions'])->find($id);
		if ($role) {
			return $role;
		}
		abort(404);
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
		// 防止用户恶意修改表单id，如果id不一致直接跳转500
		if ($attributes['id'] != $id) {
			abort(500,trans('admin/errors.user_error'));
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
			}
			flash_info($result,trans('admin/alert.role.edit_success'),trans('admin/alert.role.edit_error'));
			return $result;
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
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
		try {
			$result = $this->role->delete($id);
			flash_info($result,trans('admin/alert.role.destroy_success'),trans('admin/alert.role.destroy_error'));
			return $result;
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
		
	}
}