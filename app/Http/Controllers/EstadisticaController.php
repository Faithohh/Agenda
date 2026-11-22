<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Evento;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class EstadisticaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $tareas = Tarea::where('user_id', $userId)->get();
        $eventos = Evento::where('user_id', $userId)->get();
        $categorias = Categoria::where('user_id', $userId)->get()->keyBy('id');

        $datosTareas = $tareas->map(function ($t) use ($categorias) {
            $cat = $t->categoria_id ? ($categorias[$t->categoria_id] ?? null) : null;
            return [
                'id' => $t->id,
                'titulo' => $t->titulo,
                'estado' => $t->estado,
                'prioridad' => $t->prioridad,
                'categoria' => $cat ? $cat->nombre : 'Sin categoría',
                'color' => $cat ? $cat->color : '#64748b',
            ];
        });

        $datosEventos = $eventos->map(function ($e) use ($categorias) {
            $cat = $e->categoria_id ? ($categorias[$e->categoria_id] ?? null) : null;
            return [
                'id' => $e->id,
                'titulo' => $e->titulo,
                'repeticion' => $e->repeticion,
                'todo_el_dia' => (bool) $e->todo_el_dia,
                'categoria' => $cat ? $cat->nombre : 'Sin categoría',
                'color' => $cat ? $cat->color : '#64748b',
            ];
        });

        return view('modulos.estadisticas', compact('datosTareas', 'datosEventos'));
    }
}