<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Feed extends Model
{
    protected $fillable = [
        'id', 'titulo', 'url','descricao','arco','volume','capitulo','parte','novel_id','grupo_id','published_at','created_at','published','release'
    ];
    protected $appends = ['published','release'];
    protected $dates = [
        'published_at',
        'created_at',
        'updated_ad',
    ];

    public $relationships = array('grupo','novel');
    
    public function grupo()
    {
        return $this->belongsTo('App\Grupo','grupo_id');
    }
    public function novel()
    {
        return $this->belongsTo('App\Novel','novel_id');
    }

    public function getPublishedAttribute()
    {
        if(Carbon::today() >= $this->published_at->subDay()){
            return $this->published_at->diffForHumans();
        }else{
            return $this->published_at->format('d/m/Y H:i:s');
        }
    }


    public function getReleaseAttribute()
    {
        return ($this->arco != null ? 'Arco'.$this->arco : '').
        ($this->volume != null ? 'v'.$this->volume : '').
        (($this->capitulo != null and $this->capitulo != 'Prologo') ? 'c'.$this->capitulo : '').
        ($this->capitulo == 'Prologo' ? 'Prólogo' : '').
        ($this->parte != null ? ' parte '.$this->parte : '');
    }


    
}
