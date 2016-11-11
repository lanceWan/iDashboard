<?php
namespace App\Http\Middleware;
use Closure;
use Route;
class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$model)
    {
        if ($model == config('admin.permissions.system.login')) {
            $this->check($request,$model);
        }
        $routeName = Route::currentRouteName();
        $permission = '';
        switch ($routeName) {
            case $model.'.index':
            case $model.'.ajaxIndex':
            case $model.'.dash':
                $permission = config('admin.permissions.'.$model.'.list','');
                break;
            case $model.'.create':
            case $model.'.store':
                $permission = config('admin.permissions.'.$model.'.create','');
                break;
            case $model.'.edit':
            case $model.'.update':
                $permission = config('admin.permissions.'.$model.'.edit','');
                break;
            
            default:
                $permission = config('admin.permissions.'.$model,'');
                break;
        }
        $this->check($request,$permission);
        return $next($request);
    }

    private function check($request,$permission)
    {
        if (!$request->user()->can($permission)) {
            abort(500,trans('admin/errors.permissions'));
        }
    }
}
