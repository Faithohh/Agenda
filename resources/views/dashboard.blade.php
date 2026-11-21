
<x-app-layout>

    <div class="space-y-8">

        <!-- Bienvenida -->
        <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0A1A3C] to-[#1F5FA8] p-6 sm:p-8 text-white shadow-lg">

            <div class="relative z-10 max-w-2xl">

                <p class="text-blue-200 text-sm font-medium mb-2">
                    {{ now()->format('d/m/Y') }}
                </p>

                <h1 class="text-2xl sm:text-3xl font-bold mb-3">
                    ¡Hola, {{ Auth::user()->name }}!
                </h1>

                <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                    Bienvenido a tu agenda personal. Organiza tus tareas, administra tus eventos y mantén el control de tu tiempo.
                </p>

            </div>

            <div class="absolute -right-10 -bottom-20 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute right-20 -top-20 w-48 h-48 bg-white/5 rounded-full"></div>

        </section>

        <!-- Titulo del resumen -->
        <section>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-5">

                <div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                        Resumen general
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Accede rápidamente a las secciones de tu agenda.
                    </p>
                </div>

            </div>

            <!-- Tarjetas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                <!-- Tareas -->
                <a href="#" class="group bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200">

                    <div class="flex items-center justify-between mb-5">

                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400">

                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                            </svg>

                        </div>

                        <span class="text-gray-400 group-hover:text-blue-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M7 7h10v10"/>
                            </svg>
                        </span>

                    </div>

                    <h3 class="font-semibold text-gray-800 dark:text-white">
                        Mis tareas
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Organiza tus actividades y pendientes.
                    </p>

                </a>

                <!-- Eventos -->
                <a href="#" class="group bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200">

                    <div class="flex items-center justify-between mb-5">

                        <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400">

                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="17" rx="2" stroke-width="2"/>
                                <path stroke-width="2" stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>

                        </div>

                        <span class="text-gray-400 group-hover:text-purple-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M7 7h10v10"/>
                            </svg>
                        </span>

                    </div>

                    <h3 class="font-semibold text-gray-800 dark:text-white">
                        Eventos y citas
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Administra tus compromisos importantes.
                    </p>

                </a>

                <!-- Recordatorios -->
                <a href="#" class="group bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200">

                    <div class="flex items-center justify-between mb-5">

                        <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400">

                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 22a2 2 0 002-2h-4a2 2 0 002 2zm6-6V11a6 6 0 00-12 0v5l-2 2h16l-2-2z"/>
                            </svg>

                        </div>

                        <span class="text-gray-400 group-hover:text-amber-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M7 7h10v10"/>
                            </svg>
                        </span>

                    </div>

                    <h3 class="font-semibold text-gray-800 dark:text-white">
                        Recordatorios
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        No olvides tus actividades importantes.
                    </p>

                </a>

                <!-- Calendario -->
                <a href="#" class="group bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200">

                    <div class="flex items-center justify-between mb-5">

                        <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400">

                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="17" rx="2" stroke-width="2"/>
                                <path stroke-width="2" stroke-linecap="round" d="M3 10h18M8 2v4m8-4v4"/>
                            </svg>

                        </div>

                        <span class="text-gray-400 group-hover:text-emerald-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M7 7h10v10"/>
                            </svg>
                        </span>

                    </div>

                    <h3 class="font-semibold text-gray-800 dark:text-white">
                        Mi calendario
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Visualiza y organiza tus fechas.
                    </p>

                </a>

            </div>

        </section>

        <!-- Seccion inferior -->
        <section class="grid grid-cols-1 xl:grid-cols-3 gap-5">

            <!-- Actividades -->
            <div class="xl:col-span-2 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                            Próximas actividades
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Tus tareas y eventos próximos aparecerán aquí.
                        </p>
                    </div>

                </div>

                <div class="flex flex-col items-center justify-center text-center py-12">

                    <div class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-4">

                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 11h8M8 15h5m-9 6h14a2 2 0 002-2V5a2 2 0 00-2-2H7L4 6v13a2 2 0 002 2z"/>
                        </svg>

                    </div>

                    <h3 class="font-semibold text-gray-700 dark:text-gray-200">
                        Tu agenda está lista
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 max-w-sm">
                        Cuando registres tus primeras tareas y eventos, podrás consultarlos desde este espacio.
                    </p>

                </div>

            </div>

            <!-- Accesos rapidos -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-2">
                    Accesos rápidos
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    Encuentra fácilmente las funciones de tu agenda.
                </p>

                <div class="space-y-3">

                    <a href="#" class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" d="M12 5v14m-7-7h14"/>
                            </svg>

                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                Nueva tarea
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Agrega una actividad
                            </p>
                        </div>

                    </a>

                    <a href="#" class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="17" rx="2" stroke-width="2"/>
                                <path stroke-width="2" stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>

                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                Nuevo evento
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Registra un compromiso
                            </p>
                        </div>

                    </a>

                    <a href="#" class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 22a2 2 0 002-2h-4a2 2 0 002 2zm6-6V11a6 6 0 00-12 0v5l-2 2h16l-2-2z"/>
                            </svg>

                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                Nuevo recordatorio
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Programa una alerta
                            </p>
                        </div>

                    </a>

                </div>

            </div>

        </section>

    </div>

</x-app-layout>
