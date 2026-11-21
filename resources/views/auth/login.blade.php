<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Iniciar sesión</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Ingresa tus credenciales para acceder a tu agenda.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Correo electrónico -->
        <div>
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full rounded-xl" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Recordarme -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Recordarme</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-xs text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl transition">
                Ingresar
            </button>
        </div>

        @if (Route::has('register'))
            <p class="mt-5 text-center text-xs text-gray-500 dark:text-gray-400">
                ¿Aún no tienes cuenta?
                <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-400 font-semibold">Regístrate aquí</a>
            </p>
        @endif
    </form>
</x-guest-layout>