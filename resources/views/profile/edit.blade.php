<x-app-layout>
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- Cabecera -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Configuración y Preferencias</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Administra tus categorías de colores, la apariencia del sistema y los datos de tu cuenta.
            </p>
        </div>

        <!-- 1. Gestor de Categorías -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">Categorías de la agenda</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Estas categorías aparecerán al crear tareas, eventos y en los gráficos del calendario.
                    </p>
                </div>

                <form method="POST" action="{{ route('categorias.predeterminadas') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 rounded-xl text-xs font-semibold bg-blue-600/15 text-blue-600 dark:text-blue-400 hover:bg-blue-600/25 transition">
                        + Cargar categorías base
                    </button>
                </form>
            </div>

            <!-- Formulario para agregar categoría -->
            <form method="POST" action="{{ route('categorias.store') }}" class="flex flex-col sm:flex-row gap-3">
                @csrf
                <input type="text" name="nombre" required placeholder="Ej. Universidad, Reuniones, Gimnasio..."
                    class="flex-1 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white text-sm">

                <div class="flex items-center gap-2">
                    <label for="colorCategoria" class="text-xs font-medium text-gray-600 dark:text-gray-400">Color:</label>
                    <input type="color" id="colorCategoria" name="color" value="#3b82f6"
                        class="h-10 w-14 rounded-xl border border-gray-300 dark:border-gray-700 bg-transparent cursor-pointer">
                </div>

                <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl transition">
                    Agregar categoría
                </button>
            </form>

            <!-- Listado de categorías existentes -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 pt-2">
                @forelse ($categorias as $categoria)
                    <div class="flex items-center justify-between p-3 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <span class="w-3.5 h-3.5 rounded-full shrink-0" @style(['background-color' => $categoria->color])></span>
                            <span class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate">{{ $categoria->nombre }}</span>
                        </div>

                        <form method="POST" action="{{ route('categorias.destroy', $categoria->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Eliminar categoría"
                                class="text-xs text-red-500 hover:text-red-400 font-semibold px-2 py-1 rounded-lg hover:bg-red-500/10 transition">
                                Eliminar
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full">
                        No tienes categorías registradas todavía. Crea una arriba o pulsa <strong>"+ Cargar categorías base"</strong>.
                    </p>
                @endforelse
            </div>
        </div>

        <!-- 2. Apariencia rápida -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">Apariencia de la interfaz</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Elige entre tema claro u oscuro. Tu preferencia se guarda automáticamente en este navegador.
                </p>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" onclick="localStorage.setItem('theme', 'light'); document.documentElement.classList.remove('dark');"
                    class="px-4 py-2 rounded-xl text-xs font-semibold border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    Modo Claro
                </button>
                <button type="button" onclick="localStorage.setItem('theme', 'dark'); document.documentElement.classList.add('dark');"
                    class="px-4 py-2 rounded-xl text-xs font-semibold bg-[#0A1A3C] text-white hover:bg-blue-900 transition">
                    Modo Oscuro
                </button>
            </div>
        </div>

        <!-- 3. Información del Perfil -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- 4. Actualizar Contraseña -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- 5. Eliminar Cuenta -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</x-app-layout>