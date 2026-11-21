<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    public function index()
    {
        $usuarioId = Auth::id();

        $tareas = Tarea::with('categoria')
            ->where('user_id', $usuarioId)
            ->whereNotNull('fecha_vencimiento')
            ->get()
            ->map(function ($tarea) {
                return [
                    'id' => $tarea->id,
                    'tipo' => 'tarea',
                    'titulo' => $tarea->titulo,
                    'descripcion' => $tarea->descripcion,
                    'fecha' => \Carbon\Carbon::parse($tarea->fecha_vencimiento)->format('Y-m-d'),
                    'hora' => null,
                    'estado' => $tarea->estado,
                    'prioridad' => $tarea->prioridad,
                    'categoria' => $tarea->categoria?->nombre,
                    'color' => $tarea->categoria?->color ?? '#2563eb',
                ];
            });

        $eventos = Evento::with('categoria')
            ->where('user_id', $usuarioId)
            ->get()
            ->map(function ($evento) {
                return [
                    'id' => $evento->id,
                    'tipo' => 'evento',
                    'titulo' => $evento->titulo,
                    'descripcion' => $evento->descripcion,
                    'lugar' => $evento->lugar,
                    'fecha' => \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d'),
                    'hora' => $evento->todo_el_dia ? 'Todo el día' : \Carbon\Carbon::parse($evento->fecha_inicio)->format('H:i'),
                    'categoria' => $evento->categoria?->nombre,
                    'color' => $evento->categoria?->color ?? '#7c3aed',
                ];
            });

        $itemsCalendario = $tareas->concat($eventos)->values();

        return view('modulos.calendario', compact('itemsCalendario'));
    }
}