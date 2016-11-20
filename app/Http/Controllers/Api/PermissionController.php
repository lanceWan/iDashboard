<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\PermissionService;
class PermissionController extends Controller
{
	private $permission;

  public function __construct(PermissionService $permission)
  {
  	$this->permission = $permission;
  }

  public function index()
  {
  	$responseData = $this->permission->ajaxIndex();
  	return response()->json($responseData);
  }
}
