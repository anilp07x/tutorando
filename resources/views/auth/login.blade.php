<x-guest-layout>
    <div class="mb-4">
        <ul class="nav nav-tabs nav-fill" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="{{ route('register') }}">
                    <i class="bi bi-person-plus me-2"></i>Cadastrar
                </a>
            </li>
        </ul>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="alert alert-info mb-4">
        <i class="bi bi-info-circle-fill me-2"></i>
        Acesse sua conta para gerenciar seus projetos e interagir com a comunidade acadêmica.
    </div>

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
                <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                    <i class="bi bi-eye"></i>
                </button>
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
                <a class="text-decoration-none text-muted d-flex align-items-center" href="{{ route('password.request') }}">
                    <i class="bi bi-question-circle me-1"></i> Esqueceu sua senha?
                </a>
            @endif

            <x-primary-button class="px-4 py-2">
                <i class="bi bi-box-arrow-in-right me-2"></i> Entrar
            </x-primary-button>
        </div>
    </form>

    <div class="mt-5 pt-4 border-top">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                            <i class="bi bi-people text-white"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-1">Comunidade Ativa</h6>
                        <small class="text-muted">Mais de 4.700 utilizadores registados</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                            <i class="bi bi-shield-check text-white"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-1">Seguro e Confiável</h6>
                        <small class="text-muted">Dados protegidos e verificados</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                            <i class="bi bi-clock text-white"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-1">Disponível 24/7</h6>
                        <small class="text-muted">Acesso sempre que precisar</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                            <i class="bi bi-award text-white"></i>
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-1">Qualidade Garantida</h6>
                        <small class="text-muted">Tutores qualificados e avaliados</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 pt-2 text-center">
        <p class="text-muted mb-0">Novo no Tutorando?</p>
        <a href="{{ route('register') }}" class="text-decoration-none">
            <strong>Cadastre-se agora</strong> <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            document.querySelector('.toggle-password').addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    </script>
</x-guest-layout>
