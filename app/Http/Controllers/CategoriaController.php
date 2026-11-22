<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'color' => 'required|string|max:20',
        ]);

        Categoria::create([
            'user_id' => Auth::id(),
            'nombre' => $request->nombre,
            'color' => $request->color,
        ]);

        return redirect()->route('profile.edit')->with('status', 'categoria-creada');
    }

    public function destroy($id)
    {
        $categoria = Categoria::where('user_id', Auth::id())->findOrFail($id);
        $categoria->delete();

        return redirect()->route('profile.edit')->with('status', 'categoria-eliminada');
    }

    public function predeterminadas()
    {
        $base = [
            ['nombre' => 'Estudio', 'color' => '#3b82f6'],
            ['nombre' => 'Trabajo', 'color' => '#8b5cf6'],
            ['nombre' => 'Personal', 'color' => '#10b981'],
            ['nombre' => 'Salud', 'color' => '#ef4444'],
            ['nombre' => 'Finanzas', 'color' => '#f59e0b'],
        ];

        foreach ($base as $item) {
            Categoria::firstOrCreate(
                ['user_id' => Auth::id(), 'nombre' => $item['nombre']],
                ['color' => $item['color']]
            );
        }

        return redirect()->route('profile.edit')->with('status', 'categorias-base');
    }
}