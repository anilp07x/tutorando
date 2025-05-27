<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" id="sidebarMenu">
                <div class="position-sticky pt-3">
                    <div class="px-3 py-4 d-flex justify-content-between align-items-center border-bottom">
                        <span class="fs-5 fw-bold text-primary">
                            <i class="bi bi-shield-lock me-2"></i>Admin Panel
                        </span>
                        <button class="btn btn-sm btn-link d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <ul class="nav flex-column mt-3">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.dashboard') ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.instituicoes.*') ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{ route('admin.instituicoes.index') }}">
                                <i class="bi bi-building me-2"></i>
                                Instituições
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.users.*') ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{ route('admin.users.index') }}">
                                <i class="bi bi-people me-2"></i>
                                Usuários
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.projetos.*') ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{ route('admin.projetos.index') }}">
                                <i class="bi bi-folder me-2"></i>
                                Projetos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('admin.publicacoes.*') ? 'active text-primary fw-bold' : 'text-dark' }}" href="{{ route('admin.publicacoes.index') }}">
                                <i class="bi bi-journal-text me-2"></i>
                                Publicações
                            </a>
                        </li>
                    </ul>
                    
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Configurações</span>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear me-2"></i>
                                Configurações
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="nav-link text-dark pe-0">
                                @csrf
                                <button type="submit" class="btn btn-link text-dark p-0" style="text-decoration: none;">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <button class="btn btn-sm btn-link d-md-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <h1 class="h2">{{ $title ?? 'Painel Administrativo' }}</h1>
                </div>
                
                {{ $slot }}
            </div>
        </div>
    </div>
    
    <style>
        @media (min-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 100;
                padding: 70px 0 0;
                box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
                height: 100vh;
            }
            .navbar {
                padding-left: 16.66667%;
            }
        }
        
        .sidebar .nav-link {
            font-weight: 500;
            padding: 0.75rem 1rem;
        }
        
        .sidebar .nav-link.active {
            background-color: rgba(0, 123, 255, 0.1);
            border-radius: 0.25rem;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 0.25rem;
        }
        
        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
        }
    </style>
</x-app-layout>
