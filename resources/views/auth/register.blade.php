<x-guest-layout>
    <div class="mb-4">
        <ul class="nav nav-tabs" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        </ul>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- User Role -->
        <div class="mb-3">
            <x-input-label for="role" :value="__('Account Type')" />
            <select id="role" name="role" class="form-select" required>
                <option value="tutor" {{ old('role') == 'tutor' ? 'selected' : '' }}>{{ __('Tutor') }}</option>
                <option value="tutorando" {{ old('role') == 'tutorando' ? 'selected' : '' }}>{{ __('Tutorando') }}</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Institution -->
        <div class="mb-3">
            <x-input-label for="instituicao_id" :value="__('Institution')" />
            <select id="instituicao_id" name="instituicao_id" class="form-select" required>
                <option value="">{{ __('Select your institution') }}</option>
                @foreach(App\Models\Instituicao::all() as $instituicao)
                    <option value="{{ $instituicao->id }}" {{ old('instituicao_id') == $instituicao->id ? 'selected' : '' }}>
                        {{ $instituicao->nome }} ({{ ucfirst($instituicao->tipo) }})
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('instituicao_id')" class="mt-2" />
        </div>

        <!-- Course -->
        <div class="mb-3">
            <x-input-label for="curso" :value="__('Course')" />
            <x-text-input id="curso" type="text" name="curso" :value="old('curso')" required />
            <x-input-error :messages="$errors->get('curso')" class="mt-2" />
        </div>

        <!-- Verification Document (Optional) -->
        <div class="mb-3">
            <x-input-label for="document" :value="__('Verification Document (Optional)')" />
            <input id="document" type="file" name="document" class="form-control" accept=".pdf,.jpg,.jpeg,.png" />
            <div class="form-text">{{ __('Upload a document that verifies your identity or academic status (optional)') }}</div>
            <x-input-error :messages="$errors->get('document')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a class="text-decoration-none" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
