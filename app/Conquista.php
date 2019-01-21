<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conquista extends Model
{
    public function grupo(){
        return $this->belongsToMany('App\Grupo','g_conquistas', 'conquista_id','grupo_id');
    }
    public function novel(){
        return $this->belongsToMany('App\Novel','n_conquistas', 'conquista_id','novel_id');
    }
    public function user(){
        return $this->belongsToMany('App\User','u_conquistas', 'conquista_id','user_id');
    }
}
