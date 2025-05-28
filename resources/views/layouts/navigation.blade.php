<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <span class="fs-4 fw-bold text-primary">Tutorando</span>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>
                
                <!-- Exibir conforme o papel do usuário -->
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projetos.*') ? 'active' : '' }}" href="{{ route('projetos.index') }}">
                            <i class="bi bi-folder me-1"></i> Meus Projetos
                        </a>
                    </li>
                    
                    @if(auth()->user()->role === 'tutor')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('publicacoes.*') ? 'active' : '' }}" href="{{ route('publicacoes.index') }}">
                                <i class="bi bi-journal-text me-1"></i> Minhas Publicações
                            </a>
                        </li>
                    @endif
                    
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="#" id="adminDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-gear me-1"></i> Administração
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li><h6 class="dropdown-header"><i class="bi bi-speedometer2 me-1"></i> Dashboard</h6></li>
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-graph-up me-2"></i> Dashboard Admin
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                
                                <li><h6 class="dropdown-header"><i class="bi bi-building me-1"></i> Instituições</h6></li>
                                <li><a class="dropdown-item" href="{{ route('admin.instituicoes.index') }}">
                                    <i class="bi bi-list me-2"></i> Listar Todas
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.instituicoes.create') }}">
                                    <i class="bi bi-plus-circle me-2"></i> Nova Instituição
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                
                                <li><h6 class="dropdown-header"><i class="bi bi-folder me-1"></i> Projetos</h6></li>
                                <li><a class="dropdown-item" href="{{ route('admin.projetos.index') }}">
                                    <i class="bi bi-list me-2"></i> Todos os Projetos
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.projetos.index', ['status' => 'pendente']) }}">
                                    <i class="bi bi-clock me-2"></i> Projetos Pendentes
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.projetos.index', ['status' => 'aprovado']) }}">
                                    <i class="bi bi-check-circle me-2"></i> Projetos Aprovados
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                
                                <li><h6 class="dropdown-header"><i class="bi bi-book me-1"></i> Publicações</h6></li>
                                <li><a class="dropdown-item" href="{{ route('admin.publicacoes.index') }}">
                                    <i class="bi bi-list me-2"></i> Todas as Publicações
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.publicacoes.index', ['status' => 'pendente']) }}">
                                    <i class="bi bi-clock me-2"></i> Publicações Pendentes
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.publicacoes.index', ['status' => 'aprovado']) }}">
                                    <i class="bi bi-check-circle me-2"></i> Publicações Aprovadas
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                
                                <li><h6 class="dropdown-header"><i class="bi bi-people me-1"></i> Usuários</h6></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                    <i class="bi bi-person-lines-fill me-2"></i> Gerir Usuários
                                </a></li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>
            
            <!-- User Menu -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item me-2">
                        <a class="nav-link btn btn-outline-primary px-3" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white px-3" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i> Cadastrar
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Meu Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
