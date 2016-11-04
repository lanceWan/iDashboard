<?php
namespace App\Repositories\Eloquent;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Contracts\MenuRepository;
use App\Models\Menu;
/**
 * 菜单仓库
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    public function allMenus()
    {
    	return $this->model->orderBy('sort','desc')->get()->toArray();
    }

    public function createMenu($attributes)
    {
        $model = new $this->model;
        return $model->fill($attributes)->save();
    }
}
