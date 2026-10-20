<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    protected $table = 'chamados';

    public $timestamps = false;

    protected $fillable = [
        'solicitante_id',
        'categoria_id',
        'titulo',
        'descricao',
        'prioridade',
        'status',
    ];

    public function solicitante()
    {
        return $this->belongsTo(Usuario::class, 'solicitante_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'chamado_id');
    }

    public function historicoStatus()
    {
        return $this->hasMany(HistoricoStatus::class, 'chamado_id');
    }
}
