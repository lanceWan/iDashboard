<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\PermissionService;
use App\Http\Requests\PermissionRequest;
class PermissionController extends Controller
{
	private $permission;

  public function __construct(PermissionService $permission)
  {
  	$this->permission = $permission;
  }
  /**
   * 首页列表数据
   * @author 晚黎
   * @date   2016-11-21T11:33:35+0800
   * @return [type]                   [description]
   */
  public function index()
  {
  	$responseData = $this->permission->ajaxIndex();
  	return response()->json($responseData);
  }

  /**
   * 添加权限
   * @author 晚黎
   * @date   2016-11-21T11:36:09+0800
   * @param  PermissionRequest        $request [description]
   * @return [type]                            [description]
   */
  public function store(PermissionRequest $request)
  {
    $responseData = $this->permission->storePermission($request->all());
    return response()->json($responseData);
  }
  /**
   * 修改权限获取权限数据
   * @author 晚黎
   * @date   2016-11-21
   * @param  [type]
   * @return [type]
   */
  public function edit($id)
  {
    $responseData = $this->permission->editView($id);
    return response()->json($responseData);
  }
  /**
   * @author 晚黎
   * @date   2016-11-21
   * @param  修改权限
   * @param  [type]
   * @return [type]
   */
  public function update(PermissionRequest $request,$id)
  {
  	$responseData = $this->permission->updatePermission($request->all(),$id);
  	return response()->json($responseData);
  }

  public function destroy($id)
  {
    $responseData = $this->permission->destroyPermission($id);
    return response()->json($responseData);
  }
}
