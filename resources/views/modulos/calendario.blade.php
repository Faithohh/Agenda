
<x-app-layout>
    <div class="space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Calendario
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Visualiza tus tareas y eventos organizados por fecha.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a
                    href="{{ route('tareas.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm transition duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nueva tarea
                </a>

                <a
                    href="{{ route('eventos.index') }}"
                    style="background-color: #7c3aed;"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 hover:opacity-90 text-white text-sm font-semibold rounded-xl shadow-sm transition duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nuevo evento
                </a>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

            <div class="p-5 sm:p-6 border-b border-gray-200 dark:border-gray-700">

                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-5">

                    <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                        <button
                            type="button"
                            id="btnMesAnterior"
                            class="p-2.5 rounded-xl border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200"
                            title="Mes anterior">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <h2
                            id="tituloMesCalendario"
                            class="text-lg sm:text-xl font-bold text-gray-800 dark:text-white capitalize min-w-[170px] text-center">
                            Mes Año
                        </h2>

                        <button
                            type="button"
                            id="btnMesSiguiente"
                            class="p-2.5 rounded-xl border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200"
                            title="Mes siguiente">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <button
                            type="button"
                            id="btnMesHoy"
                            class="px-4 py-2.5 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-xl transition duration-200">
                            Hoy
                        </button>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">

                        <div class="flex items-center gap-4">
                            <span class="inline-flex items-center gap-2 text-xs font-medium text-gray-600 dark:text-gray-300">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                                Tareas
                            </span>

                            <span class="inline-flex items-center gap-2 text-xs font-medium text-gray-600 dark:text-gray-300">
                                <span style="background-color: #7c3aed;" class="w-2.5 h-2.5 rounded-full"></span>
                                Eventos
                            </span>
                        </div>

                        <div>
                            <select
                                id="filtroTipoCalendario"
                                class="w-full sm:w-auto rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="todos">Mostrar todo</option>
                                <option value="tarea">Solo tareas</option>
                                <option value="evento">Solo eventos</option>
                            </select>
                        </div>

                    </div>

                </div>

            </div>

            <div class="overflow-x-auto">

                <div class="min-w-[560px]">

                    <div
                        style="display: grid; grid-template-columns: repeat(7, minmax(0, 1fr));"
                        class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700 text-center text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">

                        <div class="py-3">Lun</div>
                        <div class="py-3">Mar</div>
                        <div class="py-3">Mié</div>
                        <div class="py-3">Jue</div>
                        <div class="py-3">Vie</div>
                        <div class="py-3">Sáb</div>
                        <div class="py-3">Dom</div>

                    </div>

                    <div
                        id="gridCalendario"
                        style="display: grid; grid-template-columns: repeat(7, minmax(0, 1fr));"
                        class="divide-x divide-y divide-gray-200 dark:divide-gray-700">
                    </div>

                </div>

            </div>

        </div>

        <div
            id="modalDetalleDia"
            style="display: none;"
            class="fixed inset-0 z-50 items-center justify-center p-4">

            <div class="fondo-modal-dia absolute inset-0 bg-black/50"></div>

            <div class="relative w-full max-w-xl max-h-[85vh] flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">

                <div class="flex items-center justify-between p-5 sm:p-6 border-b border-gray-200 dark:border-gray-700 shrink-0">

                    <div>
                        <h2
                            id="tituloModalDia"
                            class="text-lg font-bold text-gray-800 dark:text-white">
                            Actividades del día
                        </h2>

                        <p
                            id="subtituloModalDia"
                            class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Detalle de tareas y eventos programados.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="cerrar-modal-dia p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-gray-700 transition"
                        title="Cerrar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                </div>

                <div
                    id="listaActividadesDia"
                    class="p-5 sm:p-6 space-y-3 overflow-y-auto">
                </div>

                <div class="flex justify-end px-5 sm:px-6 py-4 bg-gray-50 dark:bg-gray-800/60 border-t border-gray-200 dark:border-gray-700 shrink-0">

                    <button
                        type="button"
                        class="cerrar-modal-dia px-5 py-2.5 text-sm font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition">
                        Cerrar
                    </button>

                </div>

            </div>

        </div>

    </div>

    <div id="datosCalendarioContainer" data-items='@json($itemsCalendario)' class="hidden"></div>

    <script src="{{ asset('js/calendario.js') }}" defer></script>
</x-app-layout>
