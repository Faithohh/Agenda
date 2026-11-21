<x-app-layout>

    <div class="space-y-8">

        <!-- Bienvenida -->
        <section id="bannerBienvenida" class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#0A1A3C] to-[#1F5FA8] p-6 sm:p-8 text-white shadow-lg">

            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="max-w-2xl">
                    <p class="text-blue-200 text-sm font-medium mb-2">
                        {{ now()->format('d/m/Y') }}
                    </p>

                    <h1 class="text-2xl sm:text-3xl font-bold mb-3">
                        ¡Hola, {{ Auth::user()->name }}!
                    </h1>

                    <p id="textoConsejoBanner" class="text-blue-100 text-sm sm:text-base leading-relaxed">
                        Bienvenido a tu agenda personal. Organiza tus tareas, administra tus eventos y mantén el control de tu tiempo.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-2 shrink-0">
                    <button
                        type="button"
                        id="btnSiguienteConsejo"
                        class="px-4 py-2.5 bg-white/15 hover:bg-white/25 text-white text-xs font-semibold rounded-xl backdrop-blur-sm transition">
                        Siguiente consejo
                    </button>

                    <button
                        type="button"
                        id="btnModoEnfoque"
                        class="px-4 py-2.5 bg-blue-500 hover:bg-blue-400 text-white text-xs font-semibold rounded-xl transition">
                        Resaltar resumen
                    </button>
                </div>
            </div>

            <div class="absolute -right-10 -bottom-20 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute right-20 -top-20 w-48 h-48 bg-white/5 rounded-full"></div>

        </section>

        <!-- Titulo del resumen -->
        <section id="seccionResumen">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-5">

                <div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                        Resumen general
                    </h2>

                    <p id="subtituloResumen" class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Accede rápidamente a las secciones de tu agenda.
                    </p>
                </div>

            </div>

            <!-- Tarjetas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                <!-- Tareas -->
                <a href="{{ route('tareas.index') }}" class="tarjeta-resumen group bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200">

                    <div class="flex items-center justify-between mb-5">

                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400">

                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                            </svg>

                        </div>

                        <span class="text-gray-400 group-hover:text-blue-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M7 7h10v10" />
                            </svg>
                        </span>

                    </div>

                    <h3 class="font-semibold text-gray-800 dark:text-white">
                        Mis tareas
                    </h3>

                    <p id="conteoTareasPendientes" class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                        {{ $tareasPendientes }}
                    </p>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Organiza tus actividades y pendientes.
                    </p>

                </a>

                <!-- Eventos -->
                <a href="{{ Route::has('eventos.index') ? route('eventos.index') : '#' }}" class="tarjeta-resumen group bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200">

                    <div class="flex items-center justify-between mb-5">

                        <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400">

                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="17" rx="2" stroke-width="2" />
                                <path stroke-width="2" stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18" />
                            </svg>

                        </div>

                        <span class="text-gray-400 group-hover:text-purple-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M7 7h10v10" />
                            </svg>
                        </span>

                    </div>

                    <h3 class="font-semibold text-gray-800 dark:text-white">
                        Eventos y citas
                    </h3>

                    <p id="conteoEventos" class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                        {{ $eventosProximos }}
                    </p>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Administra tus compromisos importantes.
                    </p>

                </a>

                <!-- Tareas completadas -->
                <div class="tarjeta-resumen bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm">

                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-5">

                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>

                    </div>

                    <h3 class="font-semibold text-gray-800 dark:text-white">
                        Tareas completadas
                    </h3>

                    <p id="conteoTareasCompletadas" class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                        {{ $tareasCompletadas }}
                    </p>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Actividades finalizadas con éxito.
                    </p>

                </div>

                <!-- Rendimiento general (Calculado con JS) -->
                <div class="tarjeta-resumen bg-white dark:bg-gray-900 rounded-2xl p-5 border border-gray-200 dark:border-gray-800 shadow-sm">

                    <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-400 mb-5">

                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M11 3v18M6 8v13M16 13v8M21 6v15" />
                        </svg>

                    </div>

                    <h3 class="font-semibold text-gray-800 dark:text-white">
                        Cumplimiento
                    </h3>

                    <p id="porcentajeCumplimiento" class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                        0%
                    </p>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Porcentaje de tareas completadas.
                    </p>

                </div>

            </div>

        </section>

        <!-- Seccion inferior -->
        <section class="grid grid-cols-1 xl:grid-cols-3 gap-5">

            <!-- Actividades -->
            <div class="xl:col-span-2 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-sm p-6">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-6">

                    <div>
                        <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                            Próximas actividades
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Tus tareas y eventos próximos aparecerán aquí.
                        </p>
                    </div>

                    @if (!$proximasActividades->isEmpty())
                        <button
                            type="button"
                            id="btnInvertirOrden"
                            class="px-3 py-1.5 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 rounded-lg hover:bg-blue-100 transition">
                            Invertir orden
                        </button>
                    @endif

                </div>

                @if ($proximasActividades->isEmpty())

                    <div class="flex flex-col items-center justify-center text-center py-12">

                        <div class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-4">

                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 11h8M8 15h5m-9 6h14a2 2 0 002-2V5a2 2 0 00-2-2H7L4 6v13a2 2 0 002 2z" />
                            </svg>

                        </div>

                        <h3 class="font-semibold text-gray-700 dark:text-gray-200">
                            No tienes actividades próximas
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 max-w-sm">
                            Cuando registres tus primeras tareas y eventos, aparecerán aquí.
                        </p>

                    </div>

                @else

                    <div id="contenedorActividades" class="space-y-4">

                        @foreach ($proximasActividades as $actividad)

                            <div class="item-actividad flex items-center gap-4 p-3 rounded-xl border border-gray-200 dark:border-gray-700">

                                @if ($actividad->tipo_actividad == 'Tarea')

                                    <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-500/10 flex items-center justify-center text-blue-600 dark:text-blue-400 shrink-0">

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11" />
                                        </svg>

                                    </div>

                                @else

                                    <div class="w-11 h-11 rounded-xl bg-purple-100 dark:bg-purple-500/10 flex items-center justify-center text-purple-600 dark:text-purple-400 shrink-0">

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <rect x="3" y="4" width="18" height="17" rx="2" stroke-width="2" />
                                            <path stroke-width="2" stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18" />
                                        </svg>

                                    </div>

                                @endif

                                <div class="flex-1 min-w-0">

                                    <h3 class="font-semibold text-gray-800 dark:text-white truncate">
                                        {{ $actividad->titulo }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">

                                        {{ $actividad->tipo_actividad }} ·

                                        @if ($actividad->tipo_actividad == 'Tarea')
                                            {{ \Carbon\Carbon::parse($actividad->fecha_actividad)->format('d/m/Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($actividad->fecha_actividad)->format('d/m/Y H:i') }}
                                        @endif

                                    </p>

                                </div>

                                @if ($actividad->tipo_actividad == 'Tarea')

                                    <span class="text-xs font-medium text-blue-600 dark:text-blue-400">
                                        {{ $actividad->estado == 'pendiente' ? 'Pendiente' : 'En progreso' }}
                                    </span>

                                @else

                                    <span class="text-xs font-medium text-purple-600 dark:text-purple-400">
                                        Evento
                                    </span>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @endif

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

                    <a href="{{ route('tareas.index') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" d="M12 5v14m-7-7h14" />
                            </svg>

                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                Gestionar tareas
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Crea o actualiza tus pendientes
                            </p>
                        </div>

                    </a>

                    <a href="{{ Route::has('eventos.index') ? route('eventos.index') : '#' }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center shrink-0">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="17" rx="2" stroke-width="2" />
                                <path stroke-width="2" stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18" />
                            </svg>

                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                Eventos y citas
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Registra un compromiso
                            </p>
                        </div>

                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                            </svg>

                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                Mi perfil
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Configura tu cuenta
                            </p>
                        </div>

                    </a>

                </div>

            </div>

        </section>

    </div>

    <script>
        // =====================================================================
        // PARTE 6 y 7: FUNCIONES (parseInt, Number, Math.round, function*, yield, .next)
        // =====================================================================
        const pendientes = parseInt(document.getElementById("conteoTareasPendientes").innerHTML, 10) || 0;
        const completadas = parseInt(document.getElementById("conteoTareasCompletadas").innerHTML, 10) || 0;
        const eventos = parseInt(document.getElementById("conteoEventos").innerHTML, 10) || 0;

        // Parte 3 y 4: Arrays (.reduce, .sort, .reverse, for...of, .forEach)
        const metricas = [pendientes, completadas, eventos];
        const totalActividades = metricas.reduce((acumulador, valor) => acumulador + Number(valor), 0);

        const totalTareas = pendientes + completadas;
        const porcentaje = totalTareas > 0 ? Math.round((completadas / totalTareas) * 100) : 0;
        document.getElementById("porcentajeCumplimiento").innerHTML = porcentaje + "%";

        const subtitulo = document.getElementById("subtituloResumen");
        if (subtitulo) {
            subtitulo.innerHTML = `Tienes <strong>${totalActividades}</strong> registros activos en tu agenda.`;
        }

        // Función generadora (function*) con yield y .next()
        function* consejosDashboard() {
            yield "Consejo 1: Completa primero tus tareas pendientes antes de agregar nuevas.";
            yield "Consejo 2: Revisa tus eventos próximos cada mañana al iniciar sesión.";
            yield "Consejo 3: Mantén tu porcentaje de cumplimiento por encima del 70%.";
        }
        const iteradorDashboard = consejosDashboard();

        const btnConsejo = document.getElementById("btnSiguienteConsejo");
        const textoBanner = document.getElementById("textoConsejoBanner");

        function avanzarConsejo() {
            const paso = iteradorDashboard.next();
            if (!paso.done) {
                textoBanner.innerHTML = paso.value;
            } else {
                textoBanner.innerHTML = "Has visto todos los consejos de productividad de hoy.";
                // Uso de .removeEventListener()
                btnConsejo.removeEventListener("click", avanzarConsejo);
                btnConsejo.setAttribute("disabled", "true");
                btnConsejo.style.opacity = "0.5";
            }
        }
        btnConsejo.addEventListener("click", avanzarConsejo);

        // =====================================================================
        // PARTE 8: DOM Y EVENTOS (.classList.toggle, .classList.replace,
        // mousedown, mouseup, mousemove, mouseover)
        // =====================================================================
        const btnEnfoque = document.getElementById("btnModoEnfoque");
        const tarjetas = document.querySelectorAll(".tarjeta-resumen");

        btnEnfoque.addEventListener("click", () => {
            // for...of + .classList.toggle()
            for (const tarjeta of tarjetas) {
                tarjeta.classList.toggle("ring-2");
                tarjeta.classList.toggle("ring-blue-500");
            }
            // .classList.replace()
            if (btnEnfoque.classList.contains("bg-blue-500")) {
                btnEnfoque.classList.replace("bg-blue-500", "bg-emerald-600");
            } else {
                btnEnfoque.classList.replace("bg-emerald-600", "bg-blue-500");
            }
        });

        tarjetas.forEach(tarjeta => {
            tarjeta.addEventListener("mousedown", () => {
                tarjeta.style.transform = "scale(0.98)";
            });
            tarjeta.addEventListener("mouseup", () => {
                tarjeta.style.transform = "";
            });
            tarjeta.addEventListener("mouseover", () => {
                console.log("Cursor sobre tarjeta:", tarjeta.querySelector("h3").innerHTML.trim());
            });
        });

        const btnInvertir = document.getElementById("btnInvertirOrden");
        const contenedorAct = document.getElementById("contenedorActividades");
        if (btnInvertir && contenedorAct) {
            btnInvertir.addEventListener("click", () => {
                const items = Array.from(contenedorAct.querySelectorAll(".item-actividad"));
                items.reverse().forEach(item => contenedorAct.appendChild(item));
            });
        }
    </script>

</x-app-layout>