<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Larapacks\Authorization\Traits\UserRolesTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use UserRolesTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function favorito(){
        return $this->belongsToMany('App\Novel','favoritos', 'user_id','novel_id');
    }
}
