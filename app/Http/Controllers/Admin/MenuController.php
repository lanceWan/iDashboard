<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Admin\MenuService;
use App\Http\Requests\MenuRequest;
class MenuController extends Controller
{
    private $menu;

    public function __construct(MenuService $menu)
    {
        // 自定义权限中间件
        $this->middleware('check.permission:menu');
        $this->menu = $menu;
    }

    /**
     * 菜单列表
     * @author 晚黎
     * @date   2016-11-04T09:17:47+0800
     * @return [type]                   [description]
     */
    public function index()
    {
        $menus = $this->menu->getMenuList();
        return view('admin.menu.list')->with(compact('menus'));
    }

    /**
     * 添加菜单视图
     * @author 晚黎
     * @date   2016-11-04T09:53:36+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $menus = $this->menu->getMenuList();
        return view('admin.menu.create')->with(compact('menus'));
    }

    /**
     * 添加菜单
     * @author 晚黎
     * @date   2016-11-04T15:08:20+0800
     * @param  MenuRequest              $request [description]
     * @return [type]                            [description]
     */
    public function store(MenuRequest $request)
    {
        $responseData = $this->menu->storeMenu($request->all());
        return response()->json($responseData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 修改菜单视图
     * @author 晚黎
     * @date   2016-11-04T16:26:53+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $menu = $this->menu->findMenuById($id);
        $menus = $this->menu->getMenuList();
        return view('admin.menu.edit')->with(compact('menu','menus'));
    }

    /**
     * 修改菜单数据
     * @author 晚黎
     * @date   2016-11-04T17:57:32+0800
     * @param  MenuRequest              $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(MenuRequest $request, $id)
    {
        return [
            'massage' => 'jfhggfghjfh',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
