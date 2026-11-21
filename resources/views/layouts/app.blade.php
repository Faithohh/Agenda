<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{
        sidebarOpen: false,
        sidebarCollapsed: false,
        userMenuOpen: false,
        isDesktop: window.innerWidth >= 1024,
        init() {
            window.addEventListener('resize', () => {
                this.isDesktop = window.innerWidth >= 1024;
                if (!this.isDesktop) {
                    this.sidebarCollapsed = false;
                }
            });
        }
    }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Agenda Personal</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <script>
            if (localStorage.getItem('theme') !== 'light') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-950 text-gray-800 dark:text-gray-100">

        <div class="min-h-screen flex">

            <div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false"
                class="fixed inset-0 bg-black/50 z-40 lg:hidden">
            </div>

            <aside
                class="fixed inset-y-0 left-0 z-50 bg-[#0A1A3C] text-white flex flex-col transition-all duration-300 lg:sticky lg:top-0 lg:h-screen lg:translate-x-0"
                :class="[
                    sidebarOpen ? 'translate-x-0' : '-translate-x-full',
                    (sidebarCollapsed && isDesktop) ? 'lg:w-20' : 'lg:w-64',
                    'w-64'
                ]">

                <div class="relative h-20 flex items-center border-b border-white/10 shrink-0"
                    :class="(sidebarCollapsed && isDesktop) ? 'lg:justify-center lg:px-2' : 'justify-between px-4'">

                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 min-w-0 overflow-hidden"
                        :class="(sidebarCollapsed && isDesktop) ? 'lg:justify-center lg:w-full lg:pt-3' : 'flex-1 pr-8'">

                        <div class="w-10 h-10 min-w-10 rounded-xl bg-blue-600 flex items-center justify-center font-bold text-xl shrink-0">
                            A
                        </div>

                        <div x-show="!(sidebarCollapsed && isDesktop)" x-transition class="whitespace-nowrap">
                            <h1 class="text-lg font-bold">Mi Agenda</h1>
                            <p class="text-xs text-blue-200">Organiza tu tiempo</p>
                        </div>

                    </a>

                    <button @click="sidebarCollapsed = !sidebarCollapsed"
                        class="hidden lg:flex items-center justify-center w-7 h-7 text-blue-200 hover:text-white hover:bg-white/10 rounded-lg transition absolute"
                        :class="sidebarCollapsed ? 'top-2 right-2' : 'right-3 top-1/2 -translate-y-1/2'"
                        :title="sidebarCollapsed ? 'Expandir menú' : 'Contraer menú'">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>

                    </button>

                    <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg text-blue-200 hover:text-white hover:bg-white/10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                </div>

                <div class="flex-1 px-3 py-6 overflow-y-auto">

                    <p x-show="!(sidebarCollapsed && isDesktop)" x-transition class="px-3 mb-3 text-xs font-semibold uppercase tracking-wider text-blue-300">
                        Menú principal
                    </p>

                    <nav class="space-y-2">

                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-3 py-3 rounded-xl transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-white/10' }}"
                            :class="(sidebarCollapsed && isDesktop) ? 'lg:justify-center lg:px-2' : ''">
                            <svg class="w-5 h-5 min-w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10.5L12 3l9 7.5V21H3V10.5z"/>
                            </svg>
                            <span x-show="!(sidebarCollapsed && isDesktop)" x-transition class="whitespace-nowrap">Inicio</span>
                        </a>

                        <a href="{{ route('tareas.index') }}"
                            class="flex items-center gap-3 px-3 py-3 rounded-xl transition {{ request()->routeIs('tareas.*') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-white/10' }}"
                            :class="(sidebarCollapsed && isDesktop) ? 'lg:justify-center lg:px-2' : ''">
                            <svg class="w-5 h-5 min-w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 11l3 3L22 4M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                            </svg>
                            <span x-show="!(sidebarCollapsed && isDesktop)" x-transition class="whitespace-nowrap">Tareas</span>
                        </a>

                        <a href="{{ Route::has('eventos.index') ? route('eventos.index') : '#' }}"
                            class="flex items-center gap-3 px-3 py-3 rounded-xl transition {{ request()->routeIs('eventos.*') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-white/10' }}"
                            :class="(sidebarCollapsed && isDesktop) ? 'lg:justify-center lg:px-2' : ''">
                            <svg class="w-5 h-5 min-w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 012 2v14H3V6a2 2 0 012-2z"/>
                            </svg>
                            <span x-show="!(sidebarCollapsed && isDesktop)" x-transition class="whitespace-nowrap">Eventos y citas</span>
                        </a>

                        <a href="{{ Route::has('calendario.index') ? route('calendario.index') : '#' }}"
                            class="flex items-center gap-3 px-3 py-3 rounded-xl transition {{ request()->routeIs('calendario.*') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-white/10' }}"
                            :class="(sidebarCollapsed && isDesktop) ? 'lg:justify-center lg:px-2' : ''">
                            <svg class="w-5 h-5 min-w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="17" rx="2" stroke-width="2"/>
                                <path stroke-width="2" stroke-linecap="round" d="M16 2v4M8 2v4M3 10h18"/>
                            </svg>
                            <span x-show="!(sidebarCollapsed && isDesktop)" x-transition class="whitespace-nowrap">Calendario</span>
                        </a>

                        <a href="{{ Route::has('estadisticas.index') ? route('estadisticas.index') : '#' }}"
                            class="flex items-center gap-3 px-3 py-3 rounded-xl transition {{ request()->routeIs('estadisticas.*') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-white/10' }}"
                            :class="(sidebarCollapsed && isDesktop) ? 'lg:justify-center lg:px-2' : ''">
                            <svg class="w-5 h-5 min-w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M8 16v-5m5 5V5m5 11v-8"/>
                            </svg>
                            <span x-show="!(sidebarCollapsed && isDesktop)" x-transition class="whitespace-nowrap">Estadísticas</span>
                        </a>

                    </nav>

                    <p x-show="!(sidebarCollapsed && isDesktop)" x-transition class="px-3 mt-8 mb-3 text-xs font-semibold uppercase tracking-wider text-blue-300">
                        Preferencias
                    </p>

                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-xl transition {{ request()->routeIs('profile.*') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-white/10' }}"
                        :class="(sidebarCollapsed && isDesktop) ? 'lg:justify-center lg:px-2' : ''">
                        <svg class="w-5 h-5 min-w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7zM19.4 15a1.7 1.7 0 00.3 1.9l.1.1-1.7 1.7-.1-.1a1.7 1.7 0 00-1.9-.3 1.7 1.7 0 00-1 1.5v.2h-2.4v-.2a1.7 1.7 0 00-1-1.5 1.7 1.7 0 00-1.9.3l-.1.1L8 17l.1-.1a1.7 1.7 0 00.3-1.9 1.7 1.7 0 00-1.5-1H6.7v-2.4h.2a1.7 1.7 0 001.5-1 1.7 1.7 0 00-.3-1.9L8 8.6l1.7-1.7.1.1a1.7 1.7 0 001.9.3 1.7 1.7 0 001-1.5v-.2h2.4v.2a1.7 1.7 0 001 1.5 1.7 1.7 0 001.9-.3l.1-.1 1.7 1.7-.1.1a1.7 1.7 0 00-.3 1.9 1.7 1.7 0 001.5 1h.2V14h-.2a1.7 1.7 0 00-1.5 1z"/>
                        </svg>
                        <span x-show="!(sidebarCollapsed && isDesktop)" x-transition class="whitespace-nowrap">Configuración</span>
                    </a>

                </div>

                <div class="p-4 border-t border-white/10 shrink-0">
                    <div class="flex items-center gap-3"
                        :class="(sidebarCollapsed && isDesktop) ? 'lg:justify-center' : ''">

                        <div class="w-10 h-10 min-w-10 rounded-full bg-blue-600 flex items-center justify-center font-semibold shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div x-show="!(sidebarCollapsed && isDesktop)" x-transition class="overflow-hidden">
                            <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-blue-200 truncate">{{ Auth::user()->email }}</p>
                        </div>

                    </div>
                </div>

            </aside>

            <div class="flex-1 min-w-0 flex flex-col">

                <header class="h-20 flex items-center justify-between px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shrink-0">

                    <div class="flex items-center gap-4">

                        <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-white">Mi espacio personal</h2>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Organiza tus actividades</p>
                        </div>

                    </div>

                    <div class="flex items-center gap-2 sm:gap-4">

                        <button type="button" id="btnCambiarTema"
                            class="p-2.5 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                            title="Cambiar tema">

                            <svg id="iconoSol" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="4" stroke-width="2"/>
                                <path stroke-width="2" stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3l1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3l1.42-1.42"/>
                            </svg>

                            <svg id="iconoLuna" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M20.9 13A9 9 0 0111 3.1 9 9 0 1020.9 13z"/>
                            </svg>

                        </button>

                        <div class="relative" @click.outside="userMenuOpen = false">

                            <button @click="userMenuOpen = !userMenuOpen"
                                class="flex items-center gap-2 p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition">

                                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>

                                <span class="hidden sm:block text-sm font-medium text-gray-700 dark:text-gray-200">
                                    {{ Auth::user()->name }}
                                </span>

                                <svg class="hidden sm:block w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>

                            </button>

                            <div x-cloak x-show="userMenuOpen" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50">

                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Mi perfil
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Cerrar sesión
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                </header>

                <main class="flex-1 p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>

            </div>

        </div>

        <script src="{{ asset('js/tema.js') }}" defer></script>
    </body>
</html>