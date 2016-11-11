<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.permission:system');
    }
	/**
	 * 控制台
	 * @author 晚黎
	 * @date   2016-10-29
	 * @return [type]     [description]
	 */
    public function index()
    {
    	return view('admin.dashboard.index');
    }
    /**
     * datatable国际化
     * @author 晚黎
     * @date   2016-10-29
     * @return [type]     [description]
     */
    public function dataTableI18n()
    {
    	return response()->json(trans('pagination.i18n'));
    }
}
