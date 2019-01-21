<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    public $relationships = array('nota');
    
    public function nota(){
        return $this->hasMany('App\GNota');
    }
    public function permission(){
        return $this->belongsToMany('App\User','permission_grupo', 'grupo_id','user_id');
    }
    public function clique(){
        return $this->hasMany('App\GClique');
    }
    public function feeds(){
        return $this->hasMany('App\Feed');
    }

    public function avgRating(){
        return $this->nota()
        ->selectRaw('avg(nota) as aggregate, grupo_id')
        ->groupBy('grupo_id');
    }
    public function getAvgRatingAttribute(){
        if ( ! array_key_exists('avgRating', $this->relations)) {
        $this->load('avgRating');
        }
        $relation = $this->getRelation('avgRating')->first();
        return ($relation) ? $relation->aggregate : null;
    }
}
