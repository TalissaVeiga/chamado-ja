<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoricoStatus extends Model
{
    protected $table = 'historico_status';

    public $timestamps = false;

    protected $fillable = [
        'chamado_id',
        'usuario_id',
        'status',
        'status_anterior',
        'status_novo',
        'alterado_em',
    ];

    public function chamado(): BelongsTo
    {
        return $this->belongsTo(Chamado::class, 'chamado_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}