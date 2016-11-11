<?php
namespace App\Presenters\Admin;

class MenuPresenter
{
	public function menuNestable($menus)
	{
		if ($menus) {
			$item = '';
			foreach ($menus as $v) {
				$item.= $this->getNestableItem($v);
			}
			return $item;
		}
		return '暂无菜单';
	}

	/**
	 * 返回菜单HTML代码
	 * @author 晚黎
	 * @date   2016-11-04T11:05:21+0800
	 * @param  [type]                   $menu [description]
	 * @return [type]                         [description]
	 */
	protected function getNestableItem($menu)
	{
		if ($menu['child']) {
			return $this->getHandleList($menu['id'],$menu['name'],$menu['icon'],$menu['child']);
		}
		$labelInfo = $menu['pid'] == 0 ?  'label-info':'label-warning';
		return <<<Eof
				<li class="dd-item dd3-item" data-id="{$menu['id']}">
                    <div class="dd-handle dd3-handle">Drag</div>
                    <div class="dd3-content"><span class="label {$labelInfo}"><i class="{$menu['icon']}"></i></span> {$menu['name']} {$this->getActionButtons($menu['id'])}</div>
                </li>
Eof;
	}
	/**
	 * 判断是否有子集
	 * @author 晚黎
	 * @date   2016-11-04T11:05:28+0800
	 * @param  [type]                   $id    [description]
	 * @param  [type]                   $name  [description]
	 * @param  [type]                   $child [description]
	 * @return [type]                          [description]
	 */
	protected function getHandleList($id,$name,$icon,$child)
	{
		$handle = '';
		if ($child) {
			foreach ($child as $v) {
				$handle .= $this->getNestableItem($v);
			}
		}

		$html = <<<Eof
		<li class="dd-item dd3-item" data-id="{$id}">
            <div class="dd-handle dd3-handle">Drag</div>
            <div class="dd3-content">
            	<span class="label label-info"><i class="{$icon}"></i></span> {$name} {$this->getActionButtons($id)}
            </div>
            <ol class="dd-list">
                {$handle}
            </ol>
        </li>
Eof;
		return $html;
	}

	/**
	 * 菜单按钮
	 * @author 晚黎
	 * @date   2016-11-04T11:05:38+0800
	 * @param  [type]                   $id   [description]
	 * @param  boolean                  $bool [description]
	 * @return [type]                         [description]
	 */
	protected function getActionButtons($id)
	{
		$action = '<div class="pull-right">';
		if (auth()->user()->can(config('admin.permissions.menu.show'))) {
			$action .= '<a href="javascript:;" class="btn btn-xs tooltips showInfo" data-href="'.url('admin/menu',[$id]).'" data-toggle="tooltip" data-original-title="'.trans('admin/action.actionButton.show').'"  data-placement="top"><i class="fa fa-eye"></i></a>';
		}
		if (auth()->user()->can(config('admin.permissions.menu.edit'))) {
			$action .= '<a href="javascript:;" data-href="'.url('admin/menu/'.$id.'/edit').'" class="btn btn-xs tooltips editMenu" data-toggle="tooltip"data-original-title="'.trans('admin/action.actionButton.edit').'"  data-placement="top"><i class="fa fa-edit"></i></a>';
		}
		if (auth()->user()->can(config('admin.permissions.menu.destroy'))) {
			$action .= '<a href="javascript:;" class="btn btn-xs tooltips destroy_item" data-id="'.$id.'" data-original-title="'.trans('admin/action.actionButton.destroy').'"data-toggle="tooltip"  data-placement="top"><i class="fa fa-trash"></i><form action="'.url('admin/menu',[$id]).'" method="POST" style="display:none"><input type="hidden"name="_method" value="delete"><input type="hidden" name="_token" value="'.csrf_token().'"></form></a>';
		}
		$action .= '</div>';
		return $action;
	}
	/**
	 * 根据用户不同的权限显示不同的内容
	 * @author 晚黎
	 * @date   2016-11-04T13:40:11+0800
	 * @return [type]                   [description]
	 */
	public function canCreateMenu()
	{
		$canCreateMenu = auth()->user()->can(config('admin.permissions.menu.create'));

		$title = $canCreateMenu ?  trans('admin/menu.welcome'):trans('admin/menu.sorry');
		$desc = $canCreateMenu ? trans('admin/menu.description'):trans('admin/menu.description_sorry');
		$createButton = $canCreateMenu ? '<br><a href="javascript:;" class="btn btn-primary m-t create_menu">'.trans('admin/menu.action.create').'</a>':'';
		return <<<Eof
		<div class="middle-box text-center animated fadeInRightBig">
            <h3 class="font-bold">{$title}</h3>
            <div class="error-desc">
                {$desc}{$createButton}
            </div>
        </div>
Eof;
	}
	/**
	 * 添加修改菜单关系select
	 * @author 晚黎
	 * @date   2016-11-04T16:29:51+0800
	 * @param  [type]                   $menus [description]
	 * @param  string                   $pid   [description]
	 * @return [type]                          [description]
	 */
	public function topMenuList($menus,$pid = '')
	{
		$html = '<option value="0">'.trans('admin/menu.topMenu').'</option>';
		if ($menus) {
			foreach ($menus as $v) {
				$html .= '<option value="'.$v['id'].'" '.$this->checkMenu($v['id'],$pid).'>'.$v['name'].'</option>';
			}
		}
		return $html;
	}

	public function checkMenu($menuId,$pid)
	{
		if ($pid !== '') {
			if ($menuId == $pid) {
				return 'selected="selected"';
			}
			return '';
		}
		return '';
	}
	/**
	 * 获取菜单关系名称
	 * @author 晚黎
	 * @date   2016-11-04
	 * @param  [type]     $menus [所有菜单数据]
	 * @param  [type]     $pid   [菜单关系pid]
	 * @return [type]            [description]
	 */
	public function topMenuName($menus,$pid)
	{
		if ($pid == 0) {
			return '顶级菜单';
		}
		if ($menus) {
			foreach ($menus as $v) {
				if ($v['id'] == $pid) {
					return $v['name'];
				}
			}
		}
		return '';
	}
	/**
	 * 后台左侧菜单
	 * @author 晚黎
	 * @date   2016-11-06
	 * @param  [type]     $sidebarMenus [菜单数据]
	 * @return [type]                   [HTML]
	 */
	public function sidebarMenuList($sidebarMenus)
	{
		$html = '';
		if ($sidebarMenus) {
			foreach ($sidebarMenus as $menu) {
				if (!auth()->user()->can($menu['slug'])) {
					continue;
				}
				if ($menu['child']) {
					$active = active_class(if_uri_pattern(explode(',',$menu['active'])),'active');
					$url = url($menu['url']);
					$html .= <<<Eof
					<li class="{$active}">
			          	<a href="{$url}"><i class="{$menu['icon']}"></i> <span class="nav-label">{$menu['name']}</span> <span class="fa arrow"></span></a>
			          	<ul class="nav nav-second-level collapse">
			              	{$this->childMenu($menu['child'])}
			          	</ul>
			      	</li>
Eof;
				}else{
					$html .= '<li class="'.active_class(if_uri_pattern(explode(',',$menu['active'])),'active').'"><a href="'.url($menu['url']).'"><i class="'.$menu['icon'].'"></i> <span class="nav-label">'.$menu['name'].'</span></a></li>';
				}
			}
		}
		return $html;
	}
	/**
	 * 多级菜单显示
	 * @author 晚黎
	 * @date   2016-11-06
	 * @param  [type]     $childMenu [子菜单数据]
	 * @return [type]                [HTML]
	 */
	public function childMenu($childMenu)
	{
		$html = '';
		if ($childMenu) {
			foreach ($childMenu as $v) {
				$html .= '<li class="'.active_class(if_uri_pattern(explode(',',$v['active'])),'active').'"><a href="'.url($v['url']).'">'.$v['name'].'</a></li>';
			}
		}
		return $html;
	}
}