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
}
