<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    protected $table = 'recordatorios';

    protected $fillable = [
        'user_id',
        'tarea_id',
        'evento_id',
        'titulo',
        'descripcion',
        'fecha_hora',
        'notificado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}

