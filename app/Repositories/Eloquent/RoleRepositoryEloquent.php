<?php
namespace App\Repositories\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\RoleRepository;
use App\Models\Role;
/**
 * 角色仓库
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * 查询角色并分页
     * @author 晚黎
     * @date   2016-11-02T15:17:24+0800
     * @param  [type]                   $start  [起始数目]
     * @param  [type]                   $length [读取条数]
     * @param  [type]                   $search [搜索数组数据]
     * @param  [type]                   $order  [排序数组数据]
     * @return [type]                           [查询结果集，包含查询的数量及查询的结果对象]
     */
    public function getRoleList($start,$length,$search,$order)
    {
        $role = $this->model;
        if ($search['value']) {
            if($search['regex'] == 'true'){
                $role = $role->where('name', 'like', "%{$search['value']}%")->orWhere('slug','like', "%{$search['value']}%");
            }else{
                $role = $role->where('name', $search['value'])->orWhere('slug', $search['value']);
            }
        }

        $count = $role->count();
        
        $role = $role->orderBy($order['name'], $order['dir']);

        $roles = $role->offset($start)->limit($length)->get();

        return compact('count','roles');
    }

    public function createRole($formData)
    {
        $role = $this->model;
        if ($role->fill($formData)->save()) {
            // 更新角色权限关系
            if (isset($formData['permission'])) {
                $role->permissions()->sync($formData['permission']);
            }
            return true;
        }
        return false;
    }
}
