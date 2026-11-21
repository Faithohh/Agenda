<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('categoria')
            ->where('user_id', Auth::id())
            ->orderBy('fecha_inicio', 'asc')
            ->get();

        $categorias = Categoria::where('user_id', Auth::id())
            ->orderBy('nombre', 'asc')
            ->get();

        return view('modulos.eventos', compact('eventos', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'lugar' => 'nullable|string|max:200',
            'categoria_id' => 'nullable|exists:categorias,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'repeticion' => 'required|in:ninguna,diaria,semanal,mensual,anual',
            'fecha_fin_repeticion' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        Evento::create([
            'user_id' => Auth::id(),
            'categoria_id' => $request->categoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'lugar' => $request->lugar,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'todo_el_dia' => $request->has('todo_el_dia') ? 1 : 0,
            'repeticion' => $request->repeticion,
            'fecha_fin_repeticion' => $request->fecha_fin_repeticion,
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento registrado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $evento = Evento::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'lugar' => 'nullable|string|max:200',
            'categoria_id' => 'nullable|exists:categorias,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'repeticion' => 'required|in:ninguna,diaria,semanal,mensual,anual',
            'fecha_fin_repeticion' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $evento->update([
            'categoria_id' => $request->categoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'lugar' => $request->lugar,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'todo_el_dia' => $request->has('todo_el_dia') ? 1 : 0,
            'repeticion' => $request->repeticion,
            'fecha_fin_repeticion' => $request->fecha_fin_repeticion,
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $evento = Evento::where('user_id', Auth::id())->findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
}