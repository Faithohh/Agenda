<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Agenda — Organiza tu tiempo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-950 text-white min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white">

    <!-- Barra superior -->
    <header class="w-full max-w-6xl mx-auto px-6 py-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center font-bold text-lg shadow-lg shadow-blue-600/30">
                A
            </div>
            <div>
                <span class="font-bold text-lg tracking-tight block leading-none">Mi Agenda</span>
                <span class="text-xs text-blue-300">Organiza tu tiempo</span>
            </div>
        </div>

        <nav class="flex items-center gap-3">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-4 py-2 text-sm font-semibold rounded-xl bg-blue-600 hover:bg-blue-500 text-white transition">
                    Ir al Panel
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 text-sm font-semibold text-gray-300 hover:text-white transition">
                    Iniciar sesión
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 text-sm font-semibold rounded-xl bg-blue-600 hover:bg-blue-500 text-white transition">
                        Registrarse
                    </a>
                @endif
            @endauth
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="w-full max-w-6xl mx-auto px-6 py-12">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0A1A3C] via-[#12326B] to-[#1F5FA8] p-8 sm:p-14 border border-blue-500/20 shadow-2xl">
            <div class="relative z-10 max-w-2xl">
                <span class="inline-block px-3 py-1 text-xs font-semibold uppercase tracking-wider text-blue-200 bg-white/10 rounded-full mb-5">
                    Planificador personal y académico
                </span>

                <h1 class="text-3xl sm:text-5xl font-bold leading-tight mb-5">
                    Controla tus tareas, eventos y calendario en un solo lugar.
                </h1>

                <p class="text-blue-100 text-base sm:text-lg leading-relaxed mb-8">
                    Organiza tus actividades diarias por categoría y prioridad, visualiza tus compromisos del mes y mantén el seguimiento de tu progreso.
                </p>

                <div class="flex flex-wrap items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-6 py-3.5 rounded-xl bg-white text-[#0A1A3C] font-bold text-sm hover:bg-blue-50 transition shadow-lg">
                            Entrar a mi agenda
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-6 py-3.5 rounded-xl bg-white text-[#0A1A3C] font-bold text-sm hover:bg-blue-50 transition shadow-lg">
                            Comenzar ahora
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-6 py-3.5 rounded-xl bg-white/15 hover:bg-white/25 text-white font-semibold text-sm backdrop-blur-sm transition">
                                Crear cuenta gratis
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Tarjetas de características -->
            <div class="relative z-10 grid grid-cols-1 sm:grid-cols-3 gap-4 mt-12 pt-8 border-t border-white/15">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                    <h3 class="font-bold text-white text-sm mb-1">Gestión de Tareas</h3>
                    <p class="text-xs text-blue-100">Filtra por estado, prioridad y categoría para cumplir tus metas.</p>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                    <h3 class="font-bold text-white text-sm mb-1">Eventos y Citas</h3>
                    <p class="text-xs text-blue-100">Programa reuniones, clases y recordatorios con fecha y lugar.</p>
                </div>

                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                    <h3 class="font-bold text-white text-sm mb-1">Calendario Visual</h3>
                    <p class="text-xs text-blue-100">Consulta todo tu mes con colores por categoría y feriados.</p>
                </div>
            </div>

            <div class="absolute -right-16 -bottom-24 w-80 h-80 bg-white/5 rounded-full"></div>
            <div class="absolute right-24 -top-24 w-60 h-60 bg-white/5 rounded-full"></div>
        </div>
    </main>

    <!-- Pie de página -->
    <footer class="w-full max-w-6xl mx-auto px-6 py-6 text-center text-xs text-gray-500">
        Mi Agenda &copy; {{ date('Y') }} — Sistema de organización personal
    </footer>

</body>
</html>