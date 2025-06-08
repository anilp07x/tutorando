<!-- Guest Navigation Component -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Tutorando" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('sobre') ? 'active' : '' }}" href="{{ url('/sobre') }}">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ url('/faq') }}">FAQ</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link btn btn-outline-primary px-3">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="nav-link btn btn-outline-primary px-3">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link btn btn-primary text-white px-3">
                                    <i class="bi bi-person-plus me-1"></i> Cadastrar
                                </a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-brand {
        font-weight: 600;
        font-size: 1.5rem;
        text-decoration: none;
    }
    .nav-link.active {
        color: #ff7609 !important;
        font-weight: 500;
    }
</style>
