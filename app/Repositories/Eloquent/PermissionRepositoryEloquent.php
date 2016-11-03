<?php
namespace App\Repositories\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PermissionRepository;
use App\Models\Permission;
/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }
    /**
     * 查询权限并分页
     * @author 晚黎
     * @date   2016-11-02T15:17:24+0800
     * @param  [type]                   $start  [起始数目]
     * @param  [type]                   $length [读取条数]
     * @param  [type]                   $search [搜索数组数据]
     * @param  [type]                   $order  [排序数组数据]
     * @return [type]                           [查询结果集，包含查询的数量及查询的结果对象]
     */
    public function getPermissionList($start,$length,$search,$order)
    {
        $permission = $this->model;
        if ($search['value']) {
            if($search['regex'] == 'true'){
                $permission = $permission->where('name', 'like', "%{$search['value']}%")->orWhere('slug','like', "%{$search['value']}%");
            }else{
                $permission = $permission->where('name', $search['value'])->orWhere('slug', $search['value']);
            }
        }

        $count = $permission->count();
        
        $permission = $permission->orderBy($order['name'], $order['dir']);

        $permissions = $permission->offset($start)->limit($length)->get();

        return compact('count','permissions');
    }
    /**
     * 获取所有的权限并按照功能分组
     * @author 晚黎
     * @date   2016-11-03T13:20:18+0800
     * @return [type]                   [description]
     */
    public function groupPermissionList()
    {
        $permissions = $this->model->all();
        $array = [];
        if ($permissions) {
            foreach ($permissions as $v) {
                array_set($array, $v->slug, ['id' => $v->id,'name' => $v->name]);
            }
        }
        return $array;
    }

}
