<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GeniusTS\Roles\Traits\HasRoleAndPermission;
use GeniusTS\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
class User extends Authenticatable implements HasRoleAndPermissionContract
{
    use Notifiable,HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
