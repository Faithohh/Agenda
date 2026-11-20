<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'user_id',
        'nombre',
        'color',
        'descripcion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
