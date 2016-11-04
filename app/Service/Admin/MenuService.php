<?php
namespace App\Service\Admin;
use App\Repositories\Eloquent\MenuRepositoryEloquent;
use Exception;
/**
* 菜单service
*/
class MenuService
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
			// TODO 错误信息发送邮件
			dd($e);
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
		abort(404);
	}


	// public function editMenu($id)
	// {
	// 	$menu = $this->model->find($id)->toArray();
	// 	if ($menu) {
	// 		$menu['update'] = url('admin/menu/'.$id);
 //    		$menu['msg'] = '加载成功';
 //    		$menu['status'] = true;
	// 		return $menu;
	// 	}
	// 	return ['status' => false,'msg' => '加载失败'];
	// }
	// /**
	//  * 修改菜单
	//  * @author 晚黎
	//  * @date   2016-08-19
	//  * @param  [type]     $request [description]
	//  * @return [type]              [description]
	//  */
	// public function updateMenu($request)
 //    {
 //        $menu = $this->model->find($request->id);
	// 	if ($menu) {
			
	// 		$isUpdate = $menu->update($request->all());
	// 		if ($isUpdate) {
	// 			$this->sortMenuSetCache();
	// 			flash('修改菜单成功', 'success');
	// 			return true;
	// 		}
	// 		flash('修改菜单失败', 'error');
	// 		return false;
	// 	}
	// 	abort(404,'菜单数据找不到');
 //    }
 //    /**
 //     * 删除菜单
 //     * @author 晚黎
 //     * @date   2016-08-22T07:25:20+0800
 //     * @param  [type]                   $id [description]
 //     * @return [type]                       [description]
 //     */
 //    public function destroyMenu($id){
 //    	$isDelete = $this->model->destroy($id);
 //    	if ($isDelete) {
 //    		// 更新缓存数据
 //    		$this->sortMenuSetCache();
 //    		flash('删除菜单成功', 'success');
	// 		return true;
 //    	}
 //    	flash('删除菜单失败', 'error');
	// 	return false;
 //    }
}