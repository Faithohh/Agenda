<x-app-layout>
    <div id="datosEstadisticasContainer"
         data-tareas='@json($datosTareas)'
         data-eventos='@json($datosEventos)'
         class="space-y-6">

        <!-- Cabecera -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Estadísticas y Progreso</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Resumen visual de tu rendimiento en tareas, eventos y distribución por categorías.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <select id="filtroOrdenCategorias"
                    class="rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white text-sm">
                    <option value="mayor">Ordenar: Mayor cantidad</option>
                    <option value="menor">Ordenar: Menor cantidad</option>
                </select>
            </div>
        </div>

        <!-- Tarjetas KPI principales -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total de tareas</p>
                <p id="kpiTotalTareas" class="text-3xl font-bold text-gray-800 dark:text-white mt-2">0</p>
                <p id="kpiDetalleTareas" class="text-xs text-gray-500 dark:text-gray-400 mt-1">0 completadas</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Cumplimiento</p>
                <p id="kpiPorcentaje" class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">0%</p>
                <div class="w-full h-2 bg-gray-200 dark:bg-gray-800 rounded-full mt-2 overflow-hidden">
                    <div id="barraProgresoGeneral" class="h-full bg-blue-600 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Eventos registrados</p>
                <p id="kpiTotalEventos" class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-2">0</p>
                <p id="kpiEventosRecurrentes" class="text-xs text-gray-500 dark:text-gray-400 mt-1">0 recurrentes</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Índice de productividad</p>
                <p id="kpiIndiceProductividad" class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-2">0 pts</p>
                <p id="kpiNivelProductividad" class="text-xs text-gray-500 dark:text-gray-400 mt-1">Calculado dinámicamente</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 space-y-5">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">Tareas por estado y prioridad</h2>

                <div id="contenedorEstados" class="space-y-3"></div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-800">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Por nivel de prioridad</h3>
                    <div id="contenedorPrioridades" class="grid grid-cols-3 gap-3"></div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">Actividades por categoría</h2>
                    <span id="contadorCategoriasUnicas" class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-blue-600/15 text-blue-500">
                        0 categorías
                    </span>
                </div>

                <div id="contenedorCategorias" class="space-y-3"></div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-[#0A1A3C] to-[#1F5FA8] text-white rounded-2xl p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-blue-200">Asistente de productividad</span>
                <p id="textoConsejoGenerador" class="text-base font-semibold mt-1">
                    Haz clic en "Siguiente consejo" para ver recomendaciones personalizadas.
                </p>
            </div>

            <button type="button" id="btnSiguienteConsejo"
                class="px-4 py-2.5 bg-white text-[#0A1A3C] font-bold text-sm rounded-xl hover:bg-blue-50 transition shrink-0">
                Siguiente consejo
            </button>
        </div>
    </div>

    <script src="{{ asset('js/estadisticas.js') }}" defer></script>
</x-app-layout>