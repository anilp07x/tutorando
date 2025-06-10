<nav class="navbar navbar-expand-lg navbar-centered {{ auth()->check() && auth()->user()->role === 'admin' ? 'navbar-admin-minimal navbar-light' : 'navbar-minimal navbar-light' }}">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ auth()->check() && auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Tutorando" height="32">
            @if(auth()->check() && auth()->user()->role === 'admin')
                <span class="admin-badge ms-2">Admin</span>
            @endif
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav align-items-center mx-auto">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <!-- Menu de navegação para Administradores -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-grid navbar-icon"></i>Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.instituicoes.*') ? 'active' : '' }}" 
                           href="{{ route('admin.instituicoes.index') }}">
                            <i class="bi bi-building navbar-icon"></i>Instituições
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.projetos.*') ? 'active' : '' }}" 
                           href="{{ route('admin.projetos.index') }}">
                            <i class="bi bi-folder navbar-icon"></i>Projectos
                            @if($projetosPendentes = \App\Models\Projeto::where('aprovado', false)->count())
                                <span class="badge bg-warning text-dark ms-1 rounded-pill small">{{ $projetosPendentes }}</span>
                            @endif
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.publicacoes.*') ? 'active' : '' }}" 
                           href="{{ route('admin.publicacoes.index') }}">
                            <i class="bi bi-journal navbar-icon"></i>Publicações
                            @if($publicacoesPendentes = \App\Models\Publicacao::where('aprovado', false)->count())
                                <span class="badge bg-primary text-white ms-1 rounded-pill small">{{ $publicacoesPendentes }}</span>
                            @endif
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                           href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people navbar-icon"></i>Utilizadores
                        </a>
                    </li>
                @else
                    <!-- Menu de navegação para utilizadores normais -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 navbar-icon"></i>Painel Principal
                        </a>
                    </li>
                    
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('projetos.*') ? 'active' : '' }}" href="{{ route('projetos.index') }}">
                                <i class="bi bi-folder navbar-icon"></i>Os Meus Projectos
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('tutores.*') ? 'active' : '' }}" href="{{ route('tutores.index') }}">
                                <i class="bi bi-people navbar-icon"></i>Encontrar Tutores
                            </a>
                        </li>
                        
                        @if(auth()->user()->role === 'tutor')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('publicacoes.*') ? 'active' : '' }}" href="{{ route('publicacoes.index') }}">
                                    <i class="bi bi-journal-text navbar-icon"></i>As Minhas Publicações
                                </a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
            
            <!-- User Menu -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item me-2 d-flex align-items-center">
                        <a class="btn btn-sm nav-btn btn-login" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="btn btn-sm nav-btn btn-signup" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i> Registar
                        </a>
                    </li>
                @else
                    @if(auth()->user()->role === 'admin')
                        <!-- Menu rápido para ações administrativas -->
                        <li class="nav-item me-2 d-flex align-items-center">
                            <a href="{{ route('admin.instituicoes.create') }}" class="btn btn-sm btn-light btn-action-admin">
                                <i class="bi bi-plus"></i> Nova
                            </a>
                        </li>
                        
                        <!-- Contador de itens pendentes -->
                        @php
                            $totalPendentes = \App\Models\Projeto::where('aprovado', false)->count() + 
                                              \App\Models\Publicacao::where('aprovado', false)->count();
                        @endphp
                        
                        @if($totalPendentes > 0)
                            <li class="nav-item me-2 d-flex align-items-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light position-relative btn-notification" type="button" 
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-bell"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $totalPendentes }}
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                        <li><h6 class="dropdown-header">Pendentes</h6></li>
                                        @if($projetosPendentes = \App\Models\Projeto::where('aprovado', false)->count())
                                        <li>
                                            <a class="dropdown-item d-flex justify-content-between align-items-center" 
                                               href="{{ route('admin.projetos.index', ['status' => 'pendente']) }}">
                                                <span><i class="bi bi-folder me-2 text-warning"></i> Projetos</span>
                                                <span class="badge bg-warning text-dark rounded-pill">{{ $projetosPendentes }}</span>
                                            </a>
                                        </li>
                                        @endif
                                        
                                        @if($publicacoesPendentes = \App\Models\Publicacao::where('aprovado', false)->count())
                                        <li>
                                            <a class="dropdown-item d-flex justify-content-between align-items-center" 
                                               href="{{ route('admin.publicacoes.index', ['status' => 'pendente']) }}">
                                                <span><i class="bi bi-journal me-2 text-primary"></i> Publicações</span>
                                                <span class="badge bg-primary text-white rounded-pill">{{ $publicacoesPendentes }}</span>
                                            </a>
                                        </li>
                                        @endif
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item small text-center" href="{{ route('admin.dashboard') }}">
                                                <i class="bi bi-grid me-1"></i> Dashboard
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endif
                    
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a class="nav-link dropdown-toggle d-flex align-items-center {{ auth()->user()->role === 'admin' ? 'text-white' : '' }}" 
                           href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="navbar-avatar">
                                <span class="avatar-initial">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="d-none d-md-inline">{{ Str::limit(Auth::user()->name, 15) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown">
                            <li class="px-3 py-2 d-flex flex-column">
                                <span class="fw-bold">{{ Auth::user()->name }}</span>
                                <span class="text-muted small">{{ Auth::user()->email }}</span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="bi bi-eye me-2"></i> Ver Perfil
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-pencil-square me-2"></i> Editar Perfil
                            </a></li>
                            
                            @if(auth()->user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="bi bi-house me-2"></i> Área de Usuário
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <div class="dropdown-item d-flex justify-content-between align-items-center">
                                        <span class="me-3"><i class="bi bi-shield me-2"></i> Modo Admin</span>
                                        <div class="toggle-admin-mode on" id="adminModeToggle">
                                            <span class="small me-1">ON</span>
                                            <span class="toggle-icon"></span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Sair
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@if(auth()->check() && auth()->user()->role === 'admin')
<!-- A barra de status foi removida conforme solicitado -->
@endif
