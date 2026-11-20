<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    protected $fillable = [
        'user_id',
        'categoria_id',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_vencimiento',
        'prioridad',
        'estado',
        'repeticion',
        'fecha_fin_repeticion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function recordatorios()
    {
        return $this->hasMany(Recordatorio::class);
    }
}
