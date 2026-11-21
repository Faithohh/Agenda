<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Evento;
use App\Models\Recordatorio;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $usuario = Auth::id();

        $tareasPendientes = Tarea::where('user_id', $usuario)
            ->whereIn('estado', ['pendiente', 'en_progreso'])
            ->count();

        $tareasCompletadas = Tarea::where('user_id', $usuario)
            ->where('estado', 'completada')
            ->count();

        $eventosProximos = Evento::where('user_id', $usuario)
            ->where('fecha_inicio', '>=', now()->startOfDay())
            ->count();

        $recordatoriosPendientes = Recordatorio::where('user_id', $usuario)
            ->where('notificado', false)
            ->count();

        $proximasTareas = Tarea::where('user_id', $usuario)
            ->whereIn('estado', ['pendiente', 'en_progreso'])
            ->where(function ($query) {
                $query->whereDate('fecha_vencimiento', '>=', today())
                      ->orWhereNull('fecha_vencimiento');
            })
            ->orderBy('fecha_vencimiento', 'asc')
            ->take(5)
            ->get();

        $proximosEventos = Evento::where('user_id', $usuario)
            ->where('fecha_inicio', '>=', now()->startOfDay())
            ->orderBy('fecha_inicio', 'asc')
            ->take(5)
            ->get();

        $proximasActividades = $proximasTareas->map(function ($tarea) {
            $tarea->tipo_actividad = 'Tarea';
            $tarea->fecha_actividad = $tarea->fecha_vencimiento ?? $tarea->created_at;

            return $tarea;
        })->concat($proximosEventos->map(function ($evento) {
            $evento->tipo_actividad = 'Evento';
            $evento->fecha_actividad = $evento->fecha_inicio;

            return $evento;
        }))->sortBy('fecha_actividad')->take(10);

        return view('dashboard', compact(
            'tareasPendientes',
            'tareasCompletadas',
            'eventosProximos',
            'recordatoriosPendientes',
            'proximasActividades'
        ));
    }
}