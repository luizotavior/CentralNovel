<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NNota extends Model
{
    //Nota [IN] Novel
    protected $table = 'n_notas';
    protected $fillable = ['user_id', 'novel_id', 'nota'];
}
