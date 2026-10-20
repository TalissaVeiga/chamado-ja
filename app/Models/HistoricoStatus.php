<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoStatus extends Model
{
    protected $table = 'historico_status';

    public $timestamps = false;

    protected $fillable = [
        'chamado_id',
        'usuario_id',
        'status',
        'alterado_em',
    ];

    public function chamado()
    {
        return $this->belongsTo(Chamado::class, 'chamado_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
