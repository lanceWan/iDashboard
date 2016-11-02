<?php
namespace App\Models;
use App\Traits\ActionButtonAttributeTrait;
use GeniusTS\Roles\Models\Role as Model;
class Role extends Model
{
    use ActionButtonAttributeTrait;

    private $action = 'role';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function setLevelAttribute($value)
    {
    	if ($value && is_numeric($value)) {
	        $this->attributes['level'] = intval($value);
    	}else{
    		$this->attributes['level'] = 1;
    	}
    }

}
