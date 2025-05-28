<x-guest-layout>
    <div class="mb-4">
        <ul class="nav nav-tabs nav-fill" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Entrar
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active" href="{{ route('register') }}">
                    <i class="bi bi-person-plus me-2"></i>Cadastrar
                </a>
            </li>
        </ul>
    </div>

    <div class="alert alert-info mb-4">
        <i class="bi bi-info-circle-fill me-2"></i>
        Complete seu cadastro para acessar a plataforma Tutorando e conectar-se com a comunidade acadêmica.
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <div class="row g-3">
            <div class="col-12">
                <x-input-label for="name" :value="'Nome Completo'" />
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                    <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Seu nome completo" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="col-md-6">
                <x-input-label for="email" :value="'Email'" />
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="seu@email.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="col-md-6">
                <x-input-label for="role" :value="'Tipo de Conta'" />
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-person-badge"></i></span>
                    <select id="role" name="role" class="form-select" required>
                        <option value="" disabled selected>Selecione...</option>
                        <option value="tutor" {{ old('role') == 'tutor' ? 'selected' : '' }}>Tutor</option>
                        <option value="tutorando" {{ old('role') == 'tutorando' ? 'selected' : '' }}>Tutorando</option>
                    </select>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="col-md-6">
                <x-input-label for="instituicao_id" :value="'Instituição'" />
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-building"></i></span>
                    <select id="instituicao_id" name="instituicao_id" class="form-select" required>
                        <option value="" selected>Selecione sua instituição</option>
                        @foreach(App\Models\Instituicao::all() as $instituicao)
                            <option value="{{ $instituicao->id }}" {{ old('instituicao_id') == $instituicao->id ? 'selected' : '' }}>
                                {{ $instituicao->nome }} ({{ ucfirst($instituicao->tipo) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-input-error :messages="$errors->get('instituicao_id')" class="mt-2" />
            </div>

            <div class="col-md-6">
                <x-input-label for="curso" :value="'Curso'" />
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-book"></i></span>
                    <x-text-input id="curso" type="text" name="curso" :value="old('curso')" required placeholder="Ex: Ciência da Computação" />
                </div>
                <x-input-error :messages="$errors->get('curso')" class="mt-2" />
            </div>

            <div class="col-12">
                <x-input-label for="document" :value="'Documento de Verificação'" />
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-file-earmark-text"></i></span>
                    <input id="document" type="file" name="document" class="form-control" accept=".pdf,.jpg,.jpeg,.png" />
                </div>
                <div class="form-text">
                    <i class="bi bi-info-circle me-1"></i>
                    Envie um documento que comprove sua identidade ou vínculo acadêmico (opcional)
                </div>
                <x-input-error :messages="$errors->get('document')" class="mt-2" />
            </div>

            <div class="col-md-6">
                <x-input-label for="password" :value="'Senha'" />
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres" />
                    <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <div class="form-text password-strength mt-1">
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="col-md-6">
                <x-input-label for="password_confirmation" :value="'Confirmar Senha'" />
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock-fill"></i></span>
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repita sua senha" />
                    <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="col-12 mt-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="termsCheck" required>
                    <label class="form-check-label" for="termsCheck">
                        Concordo com os <a href="#" class="text-decoration-none">Termos de Uso</a> e <a href="#" class="text-decoration-none">Política de Privacidade</a>
                    </label>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
            <a class="text-decoration-none text-muted d-flex align-items-center" href="{{ route('login') }}">
                <i class="bi bi-arrow-left me-1"></i> Já possui uma conta?
            </a>
            <x-primary-button class="px-4 py-2">
                <i class="bi bi-person-plus me-2"></i> Cadastrar
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(function(button) {
                button.addEventListener('click', function() {
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

            // Simple password strength meter
            const passwordInput = document.getElementById('password');
            const progressBar = document.querySelector('.password-strength .progress-bar');
            
            passwordInput.addEventListener('input', function() {
                const value = passwordInput.value;
                let strength = 0;
                
                if (value.length >= 8) strength += 20;
                if (value.match(/[a-z]+/)) strength += 20;
                if (value.match(/[A-Z]+/)) strength += 20;
                if (value.match(/[0-9]+/)) strength += 20;
                if (value.match(/[^a-zA-Z0-9]+/)) strength += 20;
                
                progressBar.style.width = strength + '%';
                
                if (strength < 40) {
                    progressBar.classList.remove('bg-warning', 'bg-success');
                    progressBar.classList.add('bg-danger');
                } else if (strength < 80) {
                    progressBar.classList.remove('bg-danger', 'bg-success');
                    progressBar.classList.add('bg-warning');
                } else {
                    progressBar.classList.remove('bg-danger', 'bg-warning');
                    progressBar.classList.add('bg-success');
                }
            });
        });
    </script>
</x-guest-layout>
