<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GNota extends Model
{
    //Nota [IN] Grupo
    protected $table = 'g_notas';
    protected $fillable = ['user_id', 'grupo_id', 'nota'];
}
