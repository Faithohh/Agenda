<x-app-layout>
    <div class="space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Mis eventos y citas
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Organiza y administra tus reuniones, citas y compromisos.
                </p>
            </div>

            <button
                type="button"
                id="btnAbrirModalCrear"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Nuevo evento
            </button>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

            <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                <h2 class="font-semibold text-gray-800 dark:text-white">
                    Todos mis eventos
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ $eventos->count() }} eventos registrados
                </p>
            </div>

            @if ($eventos->isEmpty())

            <div class="flex flex-col items-center justify-center text-center py-12 px-6">

                <div class="w-12 h-12 rounded-md bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-6 shrink-0">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 012 2v14H3V6a2 2 0 012-2z" />
                    </svg>
                </div>

                <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                    Aún no tienes eventos
                </h3>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 max-w-xs leading-relaxed">
                    Cuando registres tus eventos o citas, aparecerán aquí para que puedas organizarlos.
                </p>

            </div>

            @else

            <div class="p-5 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="buscarEvento" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Buscar evento
                        </label>

                        <input
                            type="text"
                            id="buscarEvento"
                            placeholder="Escribe el título o lugar..."
                            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">
                    </div>

                    <div>
                        <label for="filtrarRepeticion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Filtrar por repetición
                        </label>

                        <select
                            id="filtrarRepeticion"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">

                            <option value="todas">Todas las repeticiones</option>
                            <option value="ninguna">Ninguna</option>
                            <option value="diaria">Diaria</option>
                            <option value="semanal">Semanal</option>
                            <option value="mensual">Mensual</option>
                            <option value="anual">Anual</option>
                        </select>
                    </div>

                    <div>
                        <label for="filtrarModalidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Filtrar por duración
                        </label>

                        <select
                            id="filtrarModalidad"
                            class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm">

                            <option value="todos">Todos los horarios</option>
                            <option value="1">Todo el día</option>
                            <option value="0">Con hora específica</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p id="contadorEventos" class="text-sm text-gray-500 dark:text-gray-400">
                        Mostrando {{ $eventos->count() }} de {{ $eventos->count() }} eventos
                    </p>

                    <div class="flex items-center gap-4">
                        <button
                            type="button"
                            id="btnAgregarNotaSesion"
                            class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:underline">
                            + Nota de sesión
                        </button>

                        <button
                            type="button"
                            id="limpiarFiltrosEventos"
                            class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                            Limpiar filtros
                        </button>
                    </div>
                </div>

                <ul id="listaNotasSesion" class="space-y-1 text-xs text-gray-600 dark:text-gray-300"></ul>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-300">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Evento</th>
                            <th class="px-6 py-4 font-semibold">Lugar</th>
                            <th class="px-6 py-4 font-semibold">Inicio</th>
                            <th class="px-6 py-4 font-semibold">Fin</th>
                            <th class="px-6 py-4 font-semibold">Repetición</th>
                            <th class="px-6 py-4 font-semibold">Acciones</th>
                        </tr>
                    </thead>

                    <tbody id="tablaEventos" class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($eventos as $evento)
                        <tr
                            data-titulo="{{ $evento->titulo }}"
                            data-lugar="{{ $evento->lugar ?? '' }}"
                            data-repeticion="{{ $evento->repeticion }}"
                            data-todo-dia="{{ $evento->todo_el_dia ? '1' : '0' }}">
                            <td class="px-6 py-4 font-medium text-gray-800 dark:text-white">
                                {{ $evento->titulo }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ $evento->lugar ?: 'Sin ubicación' }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ $evento->fecha_fin ? \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y H:i') : ($evento->todo_el_dia ? 'Todo el día' : 'Sin fin') }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ ucfirst($evento->repeticion) }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">

                                    <button
                                        type="button"
                                        class="btn-editar-evento inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 dark:text-blue-400 rounded-lg transition"
                                        data-id="{{ $evento->id }}"
                                        data-titulo="{{ $evento->titulo }}"
                                        data-descripcion="{{ $evento->descripcion }}"
                                        data-lugar="{{ $evento->lugar }}"
                                        data-categoria="{{ $evento->categoria_id }}"
                                        data-inicio="{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('Y-m-d\TH:i') }}"
                                        data-fin="{{ $evento->fecha_fin ? \Carbon\Carbon::parse($evento->fecha_fin)->format('Y-m-d\TH:i') : '' }}"
                                        data-todo-dia="{{ $evento->todo_el_dia ? '1' : '0' }}"
                                        data-repeticion="{{ $evento->repeticion }}"
                                        data-fin-repeticion="{{ $evento->fecha_fin_repeticion ? \Carbon\Carbon::parse($evento->fecha_fin_repeticion)->format('Y-m-d') : '' }}">

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2v-5M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z" />
                                        </svg>

                                        Editar
                                    </button>

                                    <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" class="form-eliminar">
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

        <div
            id="modalNuevoEvento"
            data-tiene-errores="{{ $errors->any() ? '1' : '0' }}"
            style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center p-4">

            <div class="fondo-modal-evento absolute inset-0 bg-black/50"></div>

            <div class="relative w-full max-w-3xl max-h-[90vh] overflow-y-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl">

                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                            Nuevo evento
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Completa la información de tu evento o cita.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="cerrar-modal-evento text-gray-400 hover:text-gray-600 dark:hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('eventos.store') }}" method="POST">
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
                                Datos principales de tu evento.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Título del evento
                                </label>

                                <input
                                    type="text"
                                    name="titulo"
                                    value="{{ old('titulo') }}"
                                    placeholder="Ej. Reunión de equipo o cita médica"
                                    required
                                    maxlength="150"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Descripción
                                </label>

                                <textarea
                                    name="descripcion"
                                    rows="3"
                                    placeholder="Describe los detalles de tu evento..."
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm resize-none">{{ old('descripcion') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Lugar
                                </label>

                                <input
                                    type="text"
                                    name="lugar"
                                    value="{{ old('lugar') }}"
                                    placeholder="Ej. Sala de juntas o Zoom"
                                    maxlength="200"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
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

                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">

                            <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                                Fechas y horario
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-5">
                                Establece el inicio, fin y frecuencia del evento.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha y hora de inicio
                                    </label>

                                    <input
                                        type="datetime-local"
                                        name="fecha_inicio"
                                        value="{{ old('fecha_inicio') }}"
                                        required
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha y hora de fin
                                    </label>

                                    <input
                                        type="datetime-local"
                                        name="fecha_fin"
                                        value="{{ old('fecha_fin') }}"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                                <div class="md:col-span-2 flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        name="todo_el_dia"
                                        id="crearTodoDia"
                                        value="1"
                                        {{ old('todo_el_dia') ? 'checked' : '' }}
                                        class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-blue-600 focus:ring-blue-500">

                                    <label for="crearTodoDia" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Evento de todo el día
                                    </label>
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

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha final de repetición
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha_fin_repeticion"
                                        value="{{ old('fecha_fin_repeticion') }}"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 px-6 py-5 bg-gray-50 dark:bg-gray-800/60 border-t border-gray-200 dark:border-gray-700 rounded-b-2xl">

                        <button
                            type="button"
                            class="cerrar-modal-evento inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition">
                            Cancelar
                        </button>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                            Guardar evento
                        </button>

                    </div>
                </form>

            </div>
        </div>

        <div
            id="modalEditarEvento"
            style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center p-4">

            <div class="fondo-modal-evento absolute inset-0 bg-black/50"></div>

            <div class="relative w-full max-w-3xl max-h-[90vh] overflow-y-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl">

                <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                            Editar evento
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Modifica la información de tu evento o cita.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="cerrar-modal-evento text-gray-400 hover:text-gray-600 dark:hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="formEditarEvento" action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-6 space-y-6">

                        <div>
                            <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                                Información general
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Datos principales de tu evento.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Título del evento
                                </label>

                                <input
                                    type="text"
                                    name="titulo"
                                    id="editTituloEvento"
                                    required
                                    maxlength="150"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Descripción
                                </label>

                                <textarea
                                    name="descripcion"
                                    id="editDescripcionEvento"
                                    rows="3"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm resize-none"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Lugar
                                </label>

                                <input
                                    type="text"
                                    name="lugar"
                                    id="editLugarEvento"
                                    maxlength="200"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Categoría
                                </label>

                                <select
                                    name="categoria_id"
                                    id="editCategoriaEvento"
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                    <option value="">Seleccionar categoría</option>

                                    @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">
                                        {{ $categoria->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">

                            <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                                Fechas y horario
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-5">
                                Establece el inicio, fin y frecuencia del evento.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha y hora de inicio
                                    </label>

                                    <input
                                        type="datetime-local"
                                        name="fecha_inicio"
                                        id="editInicioEvento"
                                        required
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha y hora de fin
                                    </label>

                                    <input
                                        type="datetime-local"
                                        name="fecha_fin"
                                        id="editFinEvento"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                                <div class="md:col-span-2 flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        name="todo_el_dia"
                                        id="editTodoDiaEvento"
                                        value="1"
                                        class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-blue-600 focus:ring-blue-500">

                                    <label for="editTodoDiaEvento" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Evento de todo el día
                                    </label>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Repetición
                                    </label>

                                    <select
                                        name="repeticion"
                                        id="editRepeticionEvento"
                                        required
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">

                                        <option value="ninguna">Ninguna</option>
                                        <option value="diaria">Diariamente</option>
                                        <option value="semanal">Semanalmente</option>
                                        <option value="mensual">Mensualmente</option>
                                        <option value="anual">Anualmente</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fecha final de repetición
                                    </label>

                                    <input
                                        type="date"
                                        name="fecha_fin_repeticion"
                                        id="editFinRepeticionEvento"
                                        class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm">
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 px-6 py-5 bg-gray-50 dark:bg-gray-800/60 border-t border-gray-200 dark:border-gray-700 rounded-b-2xl">

                        <button
                            type="button"
                            class="cerrar-modal-evento inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition">
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
                        title: '¿Eliminar evento?',
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

    <script src="{{ asset('js/eventos.js') }}" defer></script>

</x-app-layout>