<?php
namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Service\Admin\MenuService;
class MenuComposer
{
    
    protected $menu;

    
    public function __construct(MenuService $menu)
    {
        $this->menu = $menu;
    }

    
    public function compose(View $view)
    {
        $view->with('sidebarMenu', $this->menu->getMenuList());
    }
}