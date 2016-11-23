<?php
namespace App\Models;
use GeniusTS\Roles\Models\Permission as Model;
use App\Traits\ActionButtonAttributeTrait;
class Permission extends Model
{
  use ActionButtonAttributeTrait;

  private $action = 'permission';

  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
  }

}
