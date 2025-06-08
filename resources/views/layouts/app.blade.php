<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Tutorando') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=nunito:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
        <!-- Custom Admin CSS -->
        <link href="/css/admin.css" rel="stylesheet">
        <!-- Custom Navbar CSS -->
        <link href="/css/navbar.css" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css'])
    </head>
    <body class="{{ auth()->check() && auth()->user()->role === 'admin' && request()->is('admin*') ? 'admin-body' : '' }}">
        <div class="d-flex flex-column min-vh-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-primary text-white py-3">
                    <div class="container">
                        {{ $header }}
                    </div>
                </header>
            @endisset            <!-- Page Content -->
            <main class="flex-grow-1 py-4">
                <div class="container">
                    <!-- System Information Bar -->
                    @if(auth()->check())
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-0 shadow-sm bg-light">
                                    <div class="card-body py-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-4">
                                                        <i class="bi bi-person-circle fs-4 text-primary me-2"></i>
                                                        <strong>{{ auth()->user()->name }}</strong>
                                                        <span class="badge bg-{{ auth()->user()->role === 'admin' ? 'danger' : (auth()->user()->role === 'tutor' ? 'success' : 'info') }} ms-2">
                                                            {{ ucfirst(auth()->user()->role) }}
                                                        </span>
                                                    </div>
                                                    @if(auth()->user()->role === 'admin')                                                        <div class="d-flex gap-3 small text-muted">
                                                            <span><i class="bi bi-people me-1"></i>{{ \App\Models\User::count() }} utilizadores</span>
                                                            <span><i class="bi bi-folder me-1"></i>{{ \App\Models\Projeto::count() }} projectos</span>
                                                            <span><i class="bi bi-journal-text me-1"></i>{{ \App\Models\Publicacao::count() }} publicações</span>
                                                        </div>
                                                    @else
                                                        <div class="small text-muted">
                                                            <i class="bi bi-clock me-1"></i>Último acesso: {{ auth()->user()->updated_at->diffForHumans() }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-md-end">
                                                <div class="d-flex justify-content-md-end gap-2 mt-2 mt-md-0">
                                                    @if(auth()->user()->role === 'admin')
                                                        @php
                                                            $pendingProjects = \App\Models\Projeto::where('aprovado', false)->count();
                                                            $pendingPublications = \App\Models\Publicacao::where('aprovado', false)->count();
                                                        @endphp                                                        @if($pendingProjects > 0)
                                                            <a href="{{ route('admin.projetos.index') }}" class="btn btn-sm btn-outline-warning">
                                                                <i class="bi bi-exclamation-triangle me-1"></i>{{ $pendingProjects }} projectos pendentes
                                                            </a>
                                                        @endif
                                                        @if($pendingPublications > 0)
                                                            <a href="{{ route('admin.publicacoes.index') }}" class="btn btn-sm btn-outline-info">
                                                                <i class="bi bi-file-earmark-text me-1"></i>{{ $pendingPublications }} publicações pendentes
                                                            </a>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('projetos.create') }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-plus-circle me-1"></i>Novo Projecto
                                                        </a>
                                                        <a href="{{ route('publicacoes.create') }}" class="btn btn-sm btn-outline-success">
                                                            <i class="bi bi-journal-plus me-1"></i>Nova Publicação
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>            <!-- Footer -->
            <footer class="footer mt-auto py-3 {{ auth()->check() && auth()->user()->role === 'admin' && request()->is('admin*') ? 'bg-primary bg-opacity-10' : 'bg-light' }}">
                <div class="container">
                    <!-- System Status and Quick Info -->
                    @if(auth()->check())
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex flex-wrap justify-content-between align-items-center py-2 border-bottom">
                                    <div class="d-flex align-items-center gap-3 small">
                                        <span class="text-success">
                                            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i>Sistema Online
                                        </span>
                                        @if(auth()->user()->role === 'admin')
                                            <span class="text-muted">
                                                <i class="bi bi-server me-1"></i>Servidor: {{ php_uname('n') }}
                                            </span>
                                            <span class="text-muted">
                                                <i class="bi bi-memory me-1"></i>PHP: {{ PHP_VERSION }}
                                            </span>
                                            <span class="text-muted">
                                                <i class="bi bi-database me-1"></i>Laravel: {{ app()->version() }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center gap-2 small">
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-primary">
                                                <i class="bi bi-speedometer2 me-1"></i>Painel Admin
                                            </a>
                                        @endif
                                        <span class="text-muted">
                                            <i class="bi bi-clock me-1"></i>{{ now()->format('d/m/Y H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">                            <h5>Tutorando</h5>
                            <p>Plataforma de interacção entre tutores e tutorandos, focada no apoio académico e profissional.</p>
                            @if(auth()->check() && auth()->user()->role === 'admin' && request()->is('admin*'))
                                <div class="badge bg-primary text-white mb-2">Modo Administrador</div>
                                <div class="small text-muted mt-2">
                                    <i class="bi bi-shield-check me-1"></i>Acesso total ao sistema
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <h5>Links Úteis</h5>
                            <ul class="list-unstyled">
                                <li><a href="/" class="text-decoration-none">Página Inicial</a></li>
                                @if(auth()->check())
                                    <li><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
                                    <li><a href="/projetos" class="text-decoration-none">Meus Projetos</a></li>
                                    <li><a href="/publicacoes" class="text-decoration-none">Minhas Publicações</a></li>
                                    @if(auth()->user()->role === 'admin')
                                        <li><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-primary">Painel Administrativo</a></li>
                                    @endif
                                @else
                                    <li><a href="/login" class="text-decoration-none">Login</a></li>
                                    <li><a href="/register" class="text-decoration-none">Cadastro</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Suporte & Contato</h5>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-envelope-fill me-2"></i> info@tutorando.com</li>
                                <li><i class="bi bi-telephone-fill me-2"></i> +244 923 456 789</li>
                                @if(auth()->check())
                                    <li class="mt-2">
                                        <small class="text-muted">
                                            <i class="bi bi-person-badge me-1"></i>Logado como: {{ auth()->user()->email }}
                                        </small>
                                    </li>
                                @endif
                            </ul>
                            <div class="mt-3">
                                <a href="#" class="text-decoration-none me-2"><i class="bi bi-facebook fs-5"></i></a>
                                <a href="#" class="text-decoration-none me-2"><i class="bi bi-twitter fs-5"></i></a>
                                <a href="#" class="text-decoration-none me-2"><i class="bi bi-instagram fs-5"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="mb-0">&copy; {{ date('Y') }} Tutorando. Todos os direitos reservados.</p>
                            @if(auth()->check())
                                <small class="text-muted d-block mt-1">
                                    Sessão ativa desde {{ auth()->user()->updated_at->format('d/m/Y H:i') }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            </footer>
              <!-- Botão Voltar ao Topo -->
            <button id="backToTop" class="btn btn-primary rounded-circle shadow position-fixed bottom-0 end-0 me-4 d-none" 
                    style="width: 45px; height: 45px; z-index: 1000; bottom: 20px;">
                <i class="bi bi-arrow-up"></i>
            </button>

            <!-- Widget de Informações Rápidas (Flutuante) -->
            @if(auth()->check() && auth()->user()->role === 'admin')
                <div id="adminInfoWidget" class="position-fixed bottom-0 start-0 m-3 d-none" style="z-index: 999;">
                    <div class="card border-0 shadow-lg" style="width: 300px;">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <small><i class="bi bi-info-circle me-1"></i>Info do Sistema</small>
                            <button class="btn btn-sm btn-link text-white p-0" onclick="toggleAdminWidget()">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-2 text-center">
                                <div class="col-6">
                                    <div class="bg-light rounded p-2">
                                        <div class="fw-bold text-primary">{{ \App\Models\User::whereDate('created_at', today())->count() }}</div>
                                        <small class="text-muted">Novos hoje</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded p-2">
                                        <div class="fw-bold text-warning">{{ \App\Models\Projeto::where('aprovado', false)->count() }}</div>
                                        <small class="text-muted">Pendentes</small>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between small">
                                <span>Uptime:</span>
                                <span class="text-success" id="systemUptime">Online</span>
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span>Última atualização:</span>
                                <span class="text-muted" id="lastUpdate">{{ now()->format('H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botão Toggle do Widget Admin -->
                <button id="toggleAdminInfo" class="btn btn-sm btn-primary position-fixed bottom-0 start-0 m-3 rounded-circle shadow" 
                        style="width: 40px; height: 40px; z-index: 1000;" onclick="toggleAdminWidget()" 
                        title="Informações do Sistema">
                    <i class="bi bi-info-lg"></i>
                </button>
            @endif
        </div>
        
        <!-- Bootstrap Bundle JS (inclui Popper.js) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
          <!-- Scripts customizados -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Bootstrap carregado:', typeof bootstrap !== 'undefined');
                
                // Verificar se os dropdowns estão sendo inicializados corretamente
                const dropdowns = document.querySelectorAll('[data-bs-toggle="dropdown"]');
                console.log('Dropdowns encontrados:', dropdowns.length);
                
                // Navbar scroll effect
                const navbar = document.querySelector('.navbar');
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 30) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
                
                // Back to top button
                const backToTopBtn = document.getElementById('backToTop');
                if (backToTopBtn) {
                    window.addEventListener('scroll', function() {
                        if (window.scrollY > 300) {
                            backToTopBtn.classList.remove('d-none');
                            backToTopBtn.classList.add('d-flex', 'justify-content-center', 'align-items-center');
                        } else {
                            backToTopBtn.classList.add('d-none');
                            backToTopBtn.classList.remove('d-flex', 'justify-content-center', 'align-items-center');
                        }
                    });
                    
                    backToTopBtn.addEventListener('click', function() {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    });
                }

                // Auto-refresh admin widget data
                @if(auth()->check() && auth()->user()->role === 'admin')
                    setInterval(function() {
                        updateSystemTime();
                    }, 60000); // Update every minute
                @endif

                // Tooltip initialization
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });

                // Auto-hide alerts after 5 seconds
                const alerts = document.querySelectorAll('.alert-dismissible');
                alerts.forEach(function(alert) {
                    setTimeout(function() {
                        const closeBtn = alert.querySelector('.btn-close');
                        if (closeBtn) {
                            closeBtn.click();
                        }
                    }, 5000);
                });
            });

            // Admin widget functions
            @if(auth()->check() && auth()->user()->role === 'admin')
            function toggleAdminWidget() {
                const widget = document.getElementById('adminInfoWidget');
                const button = document.getElementById('toggleAdminInfo');
                
                if (widget.classList.contains('d-none')) {
                    widget.classList.remove('d-none');
                    button.style.display = 'none';
                } else {
                    widget.classList.add('d-none');
                    button.style.display = 'block';
                }
            }

            function updateSystemTime() {
                const timeElement = document.getElementById('lastUpdate');
                if (timeElement) {
                    const now = new Date();
                    timeElement.textContent = now.toLocaleTimeString('pt-BR', { 
                        hour: '2-digit', 
                        minute: '2-digit' 
                    });
                }
            }
            @endif

            // Performance monitoring
            window.addEventListener('load', function() {
                const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
                console.log('Tempo de carregamento da página:', loadTime + 'ms');
                
                @if(auth()->check() && auth()->user()->role === 'admin')
                // Log performance for admin users
                if (loadTime > 3000) {
                    console.warn('Página carregou lentamente:', loadTime + 'ms');
                }
                @endif
            });
        </script>
        
        <!-- Admin Mode Toggle Script -->
        @if(auth()->check() && auth()->user()->role === 'admin')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggle = document.getElementById('adminModeToggle');
                if (toggle) {
                    toggle.addEventListener('click', function() {
                        if (toggle.classList.contains('on')) {
                            window.location.href = '{{ route('dashboard') }}';
                        } else {
                            window.location.href = '{{ route('admin.dashboard') }}';
                        }
                    });
                }
            });
        </script>
        @endif
    </body>
</html>