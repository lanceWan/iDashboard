<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service\Admin\PermissionService;
use App\Http\Requests\PermissionRequest;
class PermissionController extends Controller
{
    private $permission;

    function __construct(PermissionService $permission)
    {
        // 自定义权限中间件
        $this->middleware('check.permission:permission');
        $this->permission = $permission;
    }
    /**
     * 权限列表
     * @author 晚黎
     * @date   2016-10-29
     * @return [type]     [description]
     */
    public function index()
    {
        return view('admin.permission.list');
    }
    /**
     * datatables获取数据
     * @author 晚黎
     * @date   2016-10-29
     * @return [type]     [description]
     */
    public function ajaxIndex()
    {
        $responseData = $this->permission->ajaxIndex();
        return response()->json($responseData);
    }

    /**
     * 添加权限视图
     * @author 晚黎
     * @date   2016-11-01T16:47:26+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * 添加权限
     * @author 晚黎
     * @date   2016-11-02T10:30:30+0800
     * @param  PermissionRequest        $request [description]
     * @return [type]                            [description]
     */
    public function store(PermissionRequest $request)
    {
        $this->permission->storePermission($request->all());
        return redirect('admin/permission');
    }

    /**
     * 修改权限视图
     * @author 晚黎
     * @date   2016-11-02T11:42:41+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $permission = $this->permission->editView($id);
        return view('admin.permission.edit')->with(compact('permission'));
    }

    /**
     * 修改权限
     * @author 晚黎
     * @date   2016-11-02T11:58:45+0800
     * @param  PermissionRequest        $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(PermissionRequest $request, $id)
    {
        $this->permission->updatePermission($request->all(),$id);
        return redirect('admin/permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->permission->destroyPermission($id);
        return redirect('admin/permission');
    }
}
