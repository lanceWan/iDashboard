<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\UserService;
use App\Http\Requests\UserRequest;
class UserController extends Controller
{
    protected $service;

    function __construct(UserService $user)
    {
        $this->user = $user;
    }
    

    /**
     * 用户列表首页
     * @author 晚黎
     * @date   2016-11-24T10:06:47+0800
     * @return [type]                   [description]
     */
    public function index()
    {
        $responseData = $this->user->ajaxIndex();
        return response()->json($responseData);
    }

    /**
     * 创建用户视图
     * @author 晚黎
     * @date   2016-11-30T14:54:28+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $responseData = $this->user->createView();
        return response()->json($responseData);
    }

    /**
     * 添加用户
     * @author 晚黎
     * @date   2016-11-26
     * @param  UserRequest $request [description]
     * @return [type]               [description]
     */
    public function store(UserRequest $request)
    {
        $responseData = $this->user->storeUser($request->all());
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
        $responseData = $this->user->showUser($id);
        return response()->json($responseData);
    }

    /**
     * 修改用户视图数据
     * @author 晚黎
     * @date   2016-11-30
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function edit($id)
    {
        $responseData = $this->user->editView($id);
        return response()->json($responseData);
    }

    /**
     * 修改用户
     * @author 晚黎
     * @date   2016-11-30T14:54:48+0800
     * @param  Request                  $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(UserRequest $request, $id)
    {
        $responseData = $this->user->updateUser($request->all(),$id);
        return response()->json($responseData); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $responseData = $this->user->destroyUser($id);
        return response()->json($responseData); 
    }
    /**
     * 修改密码
     * @author 晚黎
     * @date   2016-11-30T15:59:47+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function resetPassword($id)
    {
        $responseData = $this->user->resetUserPassword($id);
        return response()->json($responseData); 
    }
}
