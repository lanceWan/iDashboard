<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionButtonAttributeTrait;
class Menu extends Model
{
	use ActionButtonAttributeTrait;

	private $action = 'menu';

    protected $fillable = ['pid','name','language','icon','slug','url','active','description','sort'];
}
