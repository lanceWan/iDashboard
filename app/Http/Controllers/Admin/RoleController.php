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
        $permissions = $this->role->createView();
        dd($permissions);
        return view('admin.role.create')->with(compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        //
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
