<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'user_id',
        'categoria_id',
        'titulo',
        'descripcion',
        'lugar',
        'fecha_inicio',
        'fecha_fin',
        'todo_el_dia',
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
