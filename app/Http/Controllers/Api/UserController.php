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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
