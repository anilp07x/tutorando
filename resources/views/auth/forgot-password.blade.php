<x-guest-layout>
    <div class="mb-4 alert alert-info">
        <i class="bi bi-info-circle me-2"></i>
        Esqueceu sua senha? Sem problema. Basta informar seu endereço de e-mail e enviaremos um link para redefinição de senha.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="'Email'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="seu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('login') }}" class="text-decoration-none text-muted">
                <small><i class="bi bi-arrow-left me-1"></i>Voltar ao login</small>
            </a>
            <x-primary-button class="px-4 py-2">
                <i class="bi bi-envelope me-2"></i> Enviar link
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
