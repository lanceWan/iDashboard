<?php
namespace App\Repositories\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PermissionRepository;
use GeniusTS\Roles\Models\Permission;
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

    public function getPermissionList($start,$length,$search,$order)
    {
        $permission = $this->model;
        if ($search['value']) {
            if($search['regex']){
                $permission = $permission->where('name', 'like', "%{$search['value']}%")->orWhere('slug','like', "%{$search['value']}%");
            }else{
                $permission = $permission->where('name', $search['value'])->orWhere('slug', $search['value']);
            }
        }

        $count = $permission->count();
        
        $permission = $permission->orderBy($order['name'], $order['dir']);

        $permissions = $permission->offset($start)->limit($length)->get()->toArray();

        return compact('count','permissions');
    }

}
