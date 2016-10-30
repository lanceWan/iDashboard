<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class PermissionController extends Controller
{
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
        $draw = request('draw',1);
        $permissions = [];
        for ($i=0; $i < 10; $i++) { 
            $permissions[$i]['id'] = 'zhang'.rand(1,10);
            $permissions[$i]['name'] = 'li'.rand(1,10);
            $permissions[$i]['slug'] = 'wang'.rand(1,10);
            $permissions[$i]['description'] = 'zhao'.rand(1,10);
            $permissions[$i]['created_at'] = rand(1,10);
            $permissions[$i]['updated_at'] = rand(1,10);
        }
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => 10,
            'recordsFiltered' => 10,
            'data' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
