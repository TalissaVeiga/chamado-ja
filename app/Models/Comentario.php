<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';

    public $timestamps = false;

    protected $fillable = [
        'chamado_id',
        'comentario',
    ];

    public function chamado()
    {
        return $this->belongsTo(Chamado::class, 'chamado_id');
    }
}
