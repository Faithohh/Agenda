<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categoriasBase = [
            ['nombre' => 'Trabajo', 'color' => '#2563eb'],
            ['nombre' => 'Estudio', 'color' => '#7c3aed'],
            ['nombre' => 'Personal', 'color' => '#10b981'],
            ['nombre' => 'Salud', 'color' => '#ef4444'],
            ['nombre' => 'Hogar', 'color' => '#f59e0b'],
        ];

        $usuarios = User::all();

        foreach ($usuarios as $usuario) {
            foreach ($categoriasBase as $cat) {
                Categoria::firstOrCreate(
                    [
                        'user_id' => $usuario->id,
                        'nombre' => $cat['nombre'],
                    ],
                    [
                        'color' => $cat['color'],
                    ]
                );
            }
        }
    }
}