<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service\Admin\RoleService;
use App\Http\Requests\RoleRequest;
class RoleController extends Controller
{
    private $role;

    function __construct(RoleService $role)
    {
        // 自定义权限中间件
        $this->middleware('check.permission:role');
        $this->role = $role;
    }

    /**
     * 角色列表
     * @author 晚黎
     * @date   2016-11-02T17:01:40+0800
     * @return [type]                   [description]
     */
    public function index()
    {
        return view('admin.role.list');
    }
    /**
     * datatables获取数据
     * @author 晚黎
     * @date   2016-11-02T17:01:59+0800
     * @return [type]                   [description]
     */
    public function ajaxIndex()
    {
        $responseData = $this->role->ajaxIndex();
        return response()->json($responseData);
    }

    /**
     * 创建角色视图
     * @author 晚黎
     * @date   2016-11-02T17:02:16+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $permissions = $this->role->getAllPermissionList();
        return view('admin.role.create')->with(compact('permissions'));
    }

    /**
     * 添加角色
     * @author 晚黎
     * @date   2016-11-03
     * @param  RoleRequest $request [description]
     * @return [type]               [description]
     */
    public function store(RoleRequest $request)
    {
        $this->role->storeRole($request->all());
        return redirect('admin/role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->role->findRoleById($id);
        return view('admin.role.show')->with(compact('role'));
    }

    /**
     * 修改角色
     * @author 晚黎
     * @date   2016-11-03T09:21:49+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $permissions = $this->role->getAllPermissionList();
        $role = $this->role->findRoleById($id);
        return view('admin.role.edit')->with(compact('role','permissions'));
    }

    /**
     * 修改角色
     * @author 晚黎
     * @date   2016-11-03T09:52:58+0800
     * @param  RoleRequest              $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(RoleRequest $request, $id)
    {
        $this->role->updateRole($request->all(),$id);
        return redirect('admin/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->role->destroyRole($id);
        return redirect('admin/role');
    }
}
