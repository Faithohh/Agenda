
<x-app-layout>
    <div
        class="space-y-6"
        x-data="{
            modalNuevaTarea: {{ $errors->any() ? 'true' : 'false' }},
            modalEditarTarea: false,
            tareaEditar: {},

            abrirEditar(tarea) {
                this.tareaEditar = tarea;
                this.modalEditarTarea = true;
            }
        }"
        @keydown.escape.window="modalNuevaTarea = false; modalEditarTarea = false">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Mis tareas
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Organiza y administra tus actividades pendientes.
                </p>
            </div>

            <button
                type="button"
                @click="modalNuevaTarea = true"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Nueva tarea
            </button>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

            <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                <h2 class="font-semibold text-gray-800 dark:text-white">
                    Todas mis tareas
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ $tareas->count() }} tareas registradas
                </p>
            </div>

            @if ($tareas->isEmpty())

            <div class="flex flex-col items-center justify-center text-center py-12 px-6">

                <div class="w-12 h-12 rounded-md bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-6 shrink-0">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M9 5h6m-7 4h8m-9 4h10m-9 4h8M5 3h14a2 2 0 0 1 2 2V5a2 2 0 0 1 2 2Z" />
                    </svg>
                </div>

                <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                    Aún no tienes tareas
                </h3>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 max-w-xs leading-relaxed">
                    Cuando registres tus tareas, aparecerán aquí para que puedas organizarlas.
                </p>

            </div>

            @else

            <div class="p-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="buscarTarea" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Buscar tarea
                        </label>

                        <input
                            type="text"
                            id="buscarTarea"
                            placeholder="Escribe el título..."
                            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                    </div>

                    <div>
                        <label for="filtrarEstado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Filtrar por estado
                        </label>

                        <select
                            id="filtrarEstado"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">

                            <option value="todos">Todos los estados</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="en_progreso">En progreso</option>
                            <option value="completada">Completada</option>
                        </select>
                    </div>

                    <div>
                        <label for="filtrarPrioridad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Filtrar por prioridad
                        </label>

                        <select
                            id="filtrarPrioridad"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">

                            <option value="todas">Todas las prioridades</option>
                            <option value="baja">Baja</option>
                            <option value="media">Media</option>
                            <option value="alta">Alta</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p id="contadorTareas" class="text-sm text-gray-500 dark:text-gray-400">
                        Mostrando {{ $tareas->count() }} de {{ $tareas->count() }} tareas
                    </p>

                    <button
                        type="button"
                        id="limpiarFiltros"
                        class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                        Limpiar filtros
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-300">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Tarea</th>
                            <th class="px-6 py-4 font-semibold">Vencimiento</th>
                            <th class="px-6 py-4 font-semibold">Prioridad</th>
                            <th class="px-6 py-4 font-semibold">Estado</th>
                            <th class="px-6 py-4 font-semibold">Acciones</th>
                        </tr>
                    </thead>

                    <tbody id="tablaTareas" class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($tareas as $tarea)
                        <tr
                            data-titulo="{{ $tarea->titulo }}"
                            data-estado="{{ $tarea->estado }}"
                            data-prioridad="{{ $tarea->prioridad }}">
                            <td class="px-6 py-4 font-medium text-gray-800 dark:text-white">
                                {{ $tarea->titulo }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ $tarea->fecha_vencimiento ? \Carbon\Carbon::parse($tarea->fecha_vencimiento)->format('d/m/Y') : 'Sin fecha' }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ ucfirst($tarea->prioridad) }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ ucfirst(str_replace('_', ' ', $tarea->estado)) }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">

                                    @if ($tarea->estado !== 'completada')
                                    <form action="{{ route('tareas.completar', $tarea->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold text-green-600 bg-green-50 hover:bg-green-100 dark:bg-green-900/30 dark:hover:bg-green-900/50 dark:text-green-400 rounded-lg transition">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 4 4L19 6" />
                                            </svg>

                                            Completar
                                        </button>
                                    </form>
                                    @endif

                                    <button
                                        type="button"
                                        @click="abrirEditar(@js([
                                                'id' => $tarea->id,
                                                'titulo' => $tarea->titulo,
                                                'descripcion' => $tarea->descripcion,
                                                'categoria_id' => $tarea->categoria_id,
                                                'prioridad' => $tarea->prioridad,
                                                'fecha_inicio' => $tarea->fecha_inicio ? \Carbon\Carbon::parse($tarea->fecha_inicio)->format('Y-m-d') : '',
                                                'fecha_vencimiento' => $tarea->fecha_vencimiento ? \Carbon\Carbon::parse($tarea->fecha_vencimiento)->format('Y-m-d') : '',
                                                'estado' => $tarea->estado,
                                                'repeticion' => $tarea->repeticion,
                                                'fecha_fin_repeticion' => $tarea->fecha_fin_repeticion ? \Carbon\Carbon::parse($tarea->fecha_fin_repeticion)->format('Y-m-d') : ''
                                            ]))"
                                        class="inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 dark:text-blue-400 rounded-lg transition">

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z" />
                                        </svg>

                                        Editar
                                    </button>

                                    <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" class="form-eliminar">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 dark:bg-red-900/30 dark:hover:bg-red-900/50 dark:text-red-400 rounded-lg transition">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12m-10 0V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2m2 0-1 13H8L7 7m3 3v6m4-6v6" />
                                            </svg>

                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif

        </div>

        <!-- Modal para registrar una tarea -->
        <div
            x-show="modalNuevaTarea"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center p-4">

            <div
                class="absolute inset-0 bg-black/50"
                @click="modalNuevaTarea = false">
            </div>

            <div
                x-show="modalNuevaTarea"
                x-transition
                class="relative w-full max-w-3xl max-h-[90vh] overflow-y-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl">

                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                            Nueva tarea
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Completa la información de tu actividad.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="modalNuevaTarea = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('tareas.store') }}" method="POST">
                    @csrf

                    <div class="p-6 space-y-6">

                        @if ($errors->any())
                        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 dark:bg-red-900/20 dark:border-red-800 dark:text-red-300">
                            <p class="font-semibold text-sm mb-2">
                                Revisa los siguientes campos:
                            </p>

                            <ul class="list-disc list-inside text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                                Información general
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Datos principales de tu tarea.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Título de la tarea
                                </label>

                                <input
                                    type="text"
                                    name="titulo"
                                    value="{{ old('titulo') }}"
                                    placeholder="Ej. Terminar proyecto de programación"
                                    required
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Descripción
                                </label>

                                <textarea
                                    name="descripcion"
                                    rows="3"
                                    placeholder="Describe los detalles de tu tarea..."
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm resize-none">{{ old('descripcion') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Categoría
                                </label>

                                <select
                                    name="categoria_id"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                    <option value="">Seleccionar categoría</option>

                                    @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Prioridad
                                </label>

                                <select
                                    name="prioridad"
                                    required
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                    <option value="baja" {{ old('prioridad', 'media') == 'baja' ? 'selected' : '' }}>Baja</option>
                                    <option value="media" {{ old('prioridad', 'media') == 'media' ? 'selected' : '' }}>Media</option>
                                    <option value="alta" {{ old('prioridad', 'media') == 'alta' ? 'selected' : '' }}>Alta</option>
                                </select>
                            </div>

                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">

                            <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                                Fechas y planificación
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-5">
                                Establece cuándo comenzarás y cuándo debes terminar.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha de inicio
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha_inicio"
                                        value="{{ old('fecha_inicio') }}"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha de vencimiento
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha_vencimiento"
                                        value="{{ old('fecha_vencimiento') }}"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Estado
                                    </label>

                                    <select
                                        name="estado"
                                        required
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                        <option value="pendiente" {{ old('estado', 'pendiente') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="en_progreso" {{ old('estado') == 'en_progreso' ? 'selected' : '' }}>En progreso</option>
                                        <option value="completada" {{ old('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Repetición
                                    </label>

                                    <select
                                        name="repeticion"
                                        required
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                        <option value="ninguna" {{ old('repeticion', 'ninguna') == 'ninguna' ? 'selected' : '' }}>Ninguna</option>
                                        <option value="diaria" {{ old('repeticion') == 'diaria' ? 'selected' : '' }}>Diariamente</option>
                                        <option value="semanal" {{ old('repeticion') == 'semanal' ? 'selected' : '' }}>Semanalmente</option>
                                        <option value="mensual" {{ old('repeticion') == 'mensual' ? 'selected' : '' }}>Mensualmente</option>
                                        <option value="anual" {{ old('repeticion') == 'anual' ? 'selected' : '' }}>Anualmente</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha final de repetición
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha_fin_repeticion"
                                        value="{{ old('fecha_fin_repeticion') }}"
                                        class="w-full md:w-1/2 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 px-6 py-5 bg-gray-50 dark:bg-gray-800/60 border-t border-gray-200 dark:border-gray-700 rounded-b-2xl">

                        <button
                            type="button"
                            @click="modalNuevaTarea = false"
                            class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition">
                            Cancelar
                        </button>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                            Guardar tarea
                        </button>

                    </div>
                </form>

            </div>
        </div>

        <!-- Modal para editar una tarea -->
        <div
            x-show="modalEditarTarea"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center p-4">

            <div
                class="absolute inset-0 bg-black/50"
                @click="modalEditarTarea = false">
            </div>

            <div
                x-show="modalEditarTarea"
                x-transition
                class="relative w-full max-w-3xl max-h-[90vh] overflow-y-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl">

                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                            Editar tarea
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Modifica la información de tu actividad.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="modalEditarTarea = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form :action="'/tareas/' + tareaEditar.id" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-6 space-y-6">

                        <div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                                Información general
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Datos principales de tu tarea.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Título de la tarea
                                </label>

                                <input
                                    type="text"
                                    name="titulo"
                                    x-model="tareaEditar.titulo"
                                    required
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Descripción
                                </label>

                                <textarea
                                    name="descripcion"
                                    rows="3"
                                    x-model="tareaEditar.descripcion"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm resize-none"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Categoría
                                </label>

                                <select
                                    name="categoria_id"
                                    x-model="tareaEditar.categoria_id"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                    <option value="">Seleccionar categoría</option>

                                    @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">
                                        {{ $categoria->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Prioridad
                                </label>

                                <select
                                    name="prioridad"
                                    x-model="tareaEditar.prioridad"
                                    required
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                    <option value="baja">Baja</option>
                                    <option value="media">Media</option>
                                    <option value="alta">Alta</option>
                                </select>
                            </div>

                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">

                            <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                                Fechas y planificación
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-5">
                                Establece cuándo comenzarás y cuándo debes terminar.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha de inicio
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha_inicio"
                                        x-model="tareaEditar.fecha_inicio"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha de vencimiento
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha_vencimiento"
                                        x-model="tareaEditar.fecha_vencimiento"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Estado
                                    </label>

                                    <select
                                        name="estado"
                                        x-model="tareaEditar.estado"
                                        required
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                        <option value="pendiente">Pendiente</option>
                                        <option value="en_progreso">En progreso</option>
                                        <option value="completada">Completada</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Repetición
                                    </label>

                                    <select
                                        name="repeticion"
                                        x-model="tareaEditar.repeticion"
                                        required
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                        <option value="ninguna">Ninguna</option>
                                        <option value="diaria">Diariamente</option>
                                        <option value="semanal">Semanalmente</option>
                                        <option value="mensual">Mensualmente</option>
                                        <option value="anual">Anualmente</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha final de repetición
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha_fin_repeticion"
                                        x-model="tareaEditar.fecha_fin_repeticion"
                                        class="w-full md:w-1/2 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 px-6 py-5 bg-gray-50 dark:bg-gray-800/60 border-t border-gray-200 dark:border-gray-700 rounded-b-2xl">

                        <button
                            type="button"
                            @click="modalEditarTarea = false"
                            class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition">
                            Cancelar
                        </button>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                            Guardar cambios
                        </button>

                    </div>
                </form>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const formularios = document.querySelectorAll('.form-eliminar');

            formularios.forEach(function (formulario) {
                formulario.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Eliminar tarea?',
                        text: 'Esta acción no se puede deshacer.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#64748b'
                    }).then((resultado) => {
                        if (resultado.isConfirmed) {
                            formulario.submit();
                        }
                    });
                });
            });
        });
    </script>

    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Correcto!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#2563eb'
            });
        });
    </script>
    @endif

    <script src="{{ asset('js/tareas.js') }}" defer></script>

</x-app-layout>
