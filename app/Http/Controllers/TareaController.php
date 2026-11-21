<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::where('user_id', Auth::id())
            ->orderBy('fecha_vencimiento', 'asc')
            ->get();

        $categorias = Categoria::where('user_id', Auth::id())
            ->orderBy('nombre', 'asc')
            ->get();

        return view('modulos.tareas', compact('tareas', 'categorias'));
    }

    public function create()
    {
        return redirect()->route('tareas.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'nullable|exists:categorias,id',
            'prioridad' => 'required|in:baja,media,alta',
            'fecha_inicio' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'repeticion' => 'required|in:ninguna,diaria,semanal,mensual,anual',
            'fecha_fin_repeticion' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        Tarea::create([
            'user_id' => Auth::id(),
            'categoria_id' => $request->categoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'prioridad' => $request->prioridad,
            'estado' => $request->estado,
            'repeticion' => $request->repeticion,
            'fecha_fin_repeticion' => $request->fecha_fin_repeticion,
        ]);

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea registrada correctamente.');
    }

    public function edit($id)
    {
        return redirect()->route('tareas.index');
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::where('user_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'nullable|exists:categorias,id',
            'prioridad' => 'required|in:baja,media,alta',
            'fecha_inicio' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:pendiente,en_progreso,completada',
            'repeticion' => 'required|in:ninguna,diaria,semanal,mensual,anual',
            'fecha_fin_repeticion' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $tarea->update([
            'categoria_id' => $request->categoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'prioridad' => $request->prioridad,
            'estado' => $request->estado,
            'repeticion' => $request->repeticion,
            'fecha_fin_repeticion' => $request->fecha_fin_repeticion,
        ]);

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea actualizada correctamente.');
    }

    public function completar($id)
    {
        $tarea = Tarea::where('user_id', Auth::id())
            ->findOrFail($id);

        $tarea->update([
            'estado' => 'completada',
        ]);

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea completada correctamente.');
    }

    public function destroy($id)
    {
        $tarea = Tarea::where('user_id', Auth::id())
            ->findOrFail($id);

        $tarea->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada correctamente.');
    }
}