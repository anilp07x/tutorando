<x-guest-layout>
    <div class="mb-4">
        <ul class="nav nav-tabs" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="{{ route('login') }}">Entrar</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active" href="{{ route('register') }}">Cadastrar</a>
            </li>
        </ul>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <x-input-label for="name" :value="'Nome'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Seu nome completo" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="'Email'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="seu@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- User Role -->
        <div class="mb-3">
            <x-input-label for="role" :value="'Tipo de Conta'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-person-badge"></i></span>
                <select id="role" name="role" class="form-select" required>
                    <option value="tutor" {{ old('role') == 'tutor' ? 'selected' : '' }}>Tutor</option>
                    <option value="tutorando" {{ old('role') == 'tutorando' ? 'selected' : '' }}>Tutorando</option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Institution -->
        <div class="mb-3">
            <x-input-label for="instituicao_id" :value="'Instituição'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-building"></i></span>
                <select id="instituicao_id" name="instituicao_id" class="form-select" required>
                    <option value="">Selecione sua instituição</option>
                    @foreach(App\Models\Instituicao::all() as $instituicao)
                        <option value="{{ $instituicao->id }}" {{ old('instituicao_id') == $instituicao->id ? 'selected' : '' }}>
                            {{ $instituicao->nome }} ({{ ucfirst($instituicao->tipo) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <x-input-error :messages="$errors->get('instituicao_id')" class="mt-2" />
        </div>

        <!-- Course -->
        <div class="mb-3">
            <x-input-label for="curso" :value="'Curso'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-book"></i></span>
                <x-text-input id="curso" type="text" name="curso" :value="old('curso')" required placeholder="Ex: Ciência da Computação" />
            </div>
            <x-input-error :messages="$errors->get('curso')" class="mt-2" />
        </div>

        <!-- Verification Document (Optional) -->
        <div class="mb-3">
            <x-input-label for="document" :value="'Documento de Verificação (Opcional)'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-file-earmark-text"></i></span>
                <input id="document" type="file" name="document" class="form-control" accept=".pdf,.jpg,.jpeg,.png" />
            </div>
            <div class="form-text">Envie um documento que comprove sua identidade ou vínculo acadêmico (opcional)</div>
            <x-input-error :messages="$errors->get('document')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="'Senha'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="'Confirmar Senha'" />
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-lock-fill"></i></span>
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repita sua senha" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a class="text-decoration-none text-muted" href="{{ route('login') }}">
                <small>Já possui uma conta?</small>
            </a>
            <x-primary-button class="px-4 py-2">
                <i class="bi bi-person-plus me-2"></i> Cadastrar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
