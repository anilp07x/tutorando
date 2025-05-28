<x-guest-layout>
    <div class="mb-4">
        <ul class="nav nav-tabs" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" href="{{ route('login') }}">Entrar</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="{{ route('register') }}">Cadastrar</a>
            </li>
        </ul>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="'Email'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="seu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="'Senha'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Sua senha" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mb-4 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label" for="remember_me">Lembrar de mim</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a class="text-decoration-none text-muted" href="{{ route('password.request') }}">
                    <small>Esqueceu sua senha?</small>
                </a>
            @endif

            <x-primary-button class="px-4 py-2">
                <i class="bi bi-box-arrow-in-right me-2"></i> Entrar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
