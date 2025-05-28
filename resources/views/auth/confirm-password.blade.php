<x-guest-layout>
    <div class="mb-4 alert alert-info">
        <i class="bi bi-shield-lock me-2"></i>
        Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="'Senha'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Digite sua senha atual" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('dashboard') }}" class="btn btn-link text-decoration-none text-muted">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
            <x-primary-button class="px-4 py-2">
                <i class="bi bi-shield-check me-2"></i> Confirmar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
