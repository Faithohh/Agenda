<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';

    protected $fillable = [
        'user_id',
        'categoria_id',
        'titulo',
        'descripcion',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'fecha_inicio',
        'fecha_fin',
        'activo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
