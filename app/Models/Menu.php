<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonAttributeTrait;
class Menu extends Model
{
	use ActionButtonAttributeTrait;

	private $action = 'menu';

    protected $fillable = ['pid','name','icon','slug','url','active','description','sort'];

    public function setSortAttribute($value)
    {
    	if ($value && is_numeric($value)) {
	        $this->attributes['sort'] = intval($value);
    	}else{
    		$this->attributes['sort'] = 0;
    	}
    }
}
