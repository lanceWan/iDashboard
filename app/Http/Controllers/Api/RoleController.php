<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Service\Api\RoleService;
class RoleController extends Controller
{
    private $role;

    public function __construct(RoleService $role)
    {
        $this->role = $role;
    }

    /**
     * 角色列表数据
     * @author 晚黎
     * @date   2016-11-22T11:21:33+0800
     * @return [type]                   [description]
     */
    public function index()
    {
        $responseData = $this->role->ajaxIndex();
        return response()->json($responseData);
    }

    /**
     * 角色视图获取所有权限
     * @author 晚黎
     * @date   2016-11-22T15:33:35+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $responseData = $this->role->getAllPermissionList();
        return response()->json($responseData);
    }

    /**
     * 添加角色
     * @author 晚黎
     * @date   2016-11-22T16:52:27+0800
     * @param  RoleRequest              $request [description]
     * @return [type]                            [description]
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
