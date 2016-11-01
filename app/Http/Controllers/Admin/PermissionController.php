<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Service\Admin\PermissionService;
class PermissionController extends Controller
{
    private $permission;

    function __construct(PermissionService $permission)
    {
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
    public function update(Request $request, $id)
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
