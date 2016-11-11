<?php
namespace App\Service\Admin;
use App\Repositories\Eloquent\MenuRepositoryEloquent;
use App\Service\Admin\BaseService;
use Exception,DB;
/**
* 菜单service
*/
class MenuService extends BaseService
{
	private $menu;

	public function __construct(MenuRepositoryEloquent $menu)
	{
		$this->menu = $menu;
	}

	/**
	 * 递归菜单数据
	 * @author 晚黎
	 * @date   2016-11-04T10:43:11+0800
	 * @param  [type]                   $menus [数据库或缓存中查询出来的数据]
	 * @param  integer                  $pid   [菜单关系id]
	 * @return [type]                          [description]
	 */
	public function sortMenu($menus,$pid=0)
	{
		$arr = [];
		if (empty($menus)) {
			return '';
		}
		foreach ($menus as $key => $v) {
			if ($v['pid'] == $pid) {
				$arr[$key] = $v;
				$arr[$key]['child'] = self::sortMenu($menus,$v['id']);
			}
		}
		return $arr;
	}
	/**
	 * 排序子菜单并缓存
	 * @author 晚黎
	 * @date   2016-11-04T10:44:11+0800
	 * @return [type]                   [Array]
	 */
	public function sortMenuSetCache()
	{
		$menus = $this->menu->allMenus();
		if ($menus) {
			$menuList = $this->sortMenu($menus);
			foreach ($menuList as $key => &$v) {
				if ($v['child']) {
					$sort = array_column($v['child'], 'sort');
					array_multisort($sort,SORT_DESC,$v['child']);
				}
			}
			// 缓存菜单数据
			cache()->forever(config('admin.global.cache.menuList'),$menuList);
			return $menuList;
			
		}
		return '';
	}
	/**
	 * 获取菜单数据
	 * @author 晚黎
	 * @date   2016-11-04T10:45:38+0800
	 * @return [type]                   [description]
	 */
	public function getMenuList()
	{
		// 判断数据是否缓存
		if (cache()->has(config('admin.global.cache.menuList'))) {
			return cache()->get(config('admin.global.cache.menuList'));
		}
		return $this->sortMenuSetCache();
	}
	/**
	 * 添加菜单
	 * @author 晚黎
	 * @date   2016-11-04T15:10:32+0800
	 * @param  [type]                   $attributes [表单数据]
	 * @return [type]                               [Boolean]
	 */
	public function storeMenu($attributes)
	{
		try {
			$result = $this->menu->create($attributes);
			if ($result) {
				// 更新缓存
				$this->sortMenuSetCache();
			}
			return [
				'status' => $result,
				'message' => $result ? trans('admin/alert.menu.create_success'):trans('admin/alert.menu.create_error'),
			];
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
	}
	/**
	 * 根据菜单ID查找数据
	 * @author 晚黎
	 * @date   2016-11-04T16:25:59+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function findMenuById($id)
	{
		$menu = $this->menu->find($id);
		if ($menu){
			return $menu;
		}
		// TODO替换正查找不到数据错误页面
		abort(404);
	}
	/**
	 * 修改菜单数据
	 * @author 晚黎
	 * @date   2016-11-04
	 * @param  [type]     $attributes [表单数据]
	 * @param  [type]     $id         [resource路由id]
	 * @return [type]                 [Array]
	 */
	public function updateMenu($attributes,$id)
	{
		// 防止用户恶意修改表单id，如果id不一致直接跳转500
		if ($attributes['id'] != $id) {
			return [
				'status' => false,
				'message' => trans('admin/errors.user_error'),
			];
		}
		try {
			$isUpdate = $this->menu->update($attributes,$id);
			if ($isUpdate) {
				// 更新缓存
				$this->sortMenuSetCache();
			}
			return [
				'status' => $isUpdate,
				'message' => $isUpdate ? trans('admin/alert.menu.edit_success'):trans('admin/alert.menu.edit_error'),
			];
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
		

	}
	/**
	 * 删除菜单
	 * @author 晚黎
	 * @date   2016-11-04
	 * @param  [type]     $id [菜单ID]
	 * @return [type]         [description]
	 */
	public function destroyMenu($id)
	{
		try {
			$isDestroy = $this->menu->delete($id);
			if ($isDestroy) {
				// 更新缓存
				$this->sortMenuSetCache();
			}
			flash_info($isDestroy,trans('admin/alert.menu.destroy_success'),trans('admin/alert.menu.destroy_error'));
			return $isDestroy;
		} catch (Exception $e) {
			// 错误信息发送邮件
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
	}

	public function orderable($nestableData)
	{
		try {
			$dataArray = json_decode($nestableData,true);
			$menus = array_values($this->getMenuList());
			$menuCount = count($dataArray);
			$bool = false;
			DB::beginTransaction();
			foreach ($dataArray as $k => $v) {
				$sort = $menuCount - $k;
				if (!isset($menus[$k])) {
					$this->menu->update(['sort' => $sort,'pid' => 0],$v['id']);
					$bool = true;
				}else{
					if (isset($menus[$k]['id']) && $v['id'] != $menus[$k]['id']) {
						$this->menu->update(['sort' => $sort,'pid' => 0],$v['id']);
						$bool = true;
					}
				}
				if (isset($v['children']) && !empty($v['children'])) {
					$childCount = count($v['children']);
					foreach ($v['children'] as $key => $child) {
						$chidlSort = $childCount - $key;
						if (!isset($menus[$k]['child'][$key])) {
							foreach ($v['children'] as $index => $val) {
								$reIndex = $childCount - $index;
								$this->menu->update(['pid' => $v['id'],'sort' => $reIndex],$val['id']);
							}
							$bool = true;
						}else{
							if (isset($menus[$k]['child'][$key]) && ($child['id'] != $menus[$k]['child'][$key]['id'])) {
								$this->menu->update(['pid' => $v['id'],'sort' => $chidlSort],$child['id']);
								$bool = true;
							}
						}
					}
				}
			}
			DB::commit();
			if ($bool) {
				// 更新缓存
				$this->sortMenuSetCache();
			}
			return [
				'status' => $bool,
				'message' => $bool ? trans('admin/alert.menu.order_success'):trans('admin/alert.menu.order_error')
			];
		} catch (Exception $e) {
			// 错误信息发送邮件
			DB::rollBack();
			$this->sendSystemErrorMail(env('MAIL_SYSTEMERROR',''),$e);
			return false;
		}
	}
}