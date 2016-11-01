<?php
namespace App\Models;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ActionButtonAttributeTrait;
use GeniusTS\Roles\Models\Permission as Model;
class Permission extends Model implements Transformable
{
    use TransformableTrait,ActionButtonAttributeTrait;

    private $action = 'permission';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

}
