<?php
namespace App\Repositories\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Contracts\UserRepository;
use App\User;
/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * 查询角色并分页
     * @author 晚黎
     * @date   2016-11-03T12:56:28+0800
     * @param  [type]                   $start  [起始数目]
     * @param  [type]                   $length [读取条数]
     * @param  [type]                   $search [搜索数组数据]
     * @param  [type]                   $order  [排序数组数据]
     * @return [type]                           [查询结果集，包含查询的数量及查询的结果对象]
     */
    public function getUserList($start,$length,$search,$order)
    {
        $user = $this->model;
        if ($search['value']) {
            if($search['regex'] == 'true'){
                $user = $user->where('name', 'like', "%{$search['value']}%")->orWhere('username','like', "%{$search['value']}%");
            }else{
                $user = $user->where('name', $search['value'])->orWhere('username', $search['value']);
            }
        }

        $count = $user->count();
        
        $user = $user->orderBy($order['name'], $order['dir']);

        $users = $user->offset($start)->limit($length)->get();

        return compact('count','users');
    }

    // public function createRole($formData)
    // {
    //     $role = $this->model;
    //     if ($role->fill($formData)->save()) {
    //         // 更新角色权限关系
    //         if (isset($formData['permission'])) {
    //             $role->permissions()->sync($formData['permission']);
    //         }
    //         return true;
    //     }
    //     return false;
    // }
    
}
