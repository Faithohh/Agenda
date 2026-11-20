<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuraciones';

    protected $fillable = [
        'user_id',
        'tema',
        'formato_hora',
        'formato_fecha',
        'notificaciones_activas'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
