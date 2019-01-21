<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    public $relationships = array('linguagem','feed','genero','tag','clique','nota');

    
    public function linguagem()
    {
        return $this->belongsTo('App\Linguagem','linguagem_id');
    }
    public function tipo()
    {
        return $this->belongsTo('App\Tipo','tipo_id');
    }
    public function permission(){
        return $this->belongsToMany('App\User','permission_novel', 'novel_id','user_id');
    }
    public function feed(){
        return $this->hasMany('App\Feed');
    }
    public function clique(){
        return $this->hasMany('App\NClique');
    }
    public function genero(){
        return $this->belongsToMany('App\Genero','n_generos', 'novel_id','genero_id');
    }
    public function tag(){
        return $this->belongsToMany('App\Tag','n_tags', 'novel_id','tag_id');
    }
    public function nota(){
        return $this->hasMany('App\NNota');
    }
    public function avgRating(){
        return $this->nota()
        ->selectRaw('avg(nota) as aggregate, novel_id')
        ->groupBy('novel_id');
    }
    public function getAvgRatingAttribute(){
        if ( ! array_key_exists('avgRating', $this->relations)) {
        $this->load('avgRating');
        }
        $relation = $this->getRelation('avgRating')->first();
        return ($relation) ? $relation->aggregate : null;
    }
}
