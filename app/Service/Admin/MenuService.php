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
}