<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    protected $table = 'usuarios';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'telefone',
    ];

    public function chamados()
    {
        return $this->hasMany(Chamado::class, 'solicitante_id');
    }

    public function historicoStatus()
    {
        return $this->hasMany(HistoricoStatus::class, 'usuario_id');
    }
}
