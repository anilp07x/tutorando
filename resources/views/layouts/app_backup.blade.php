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
                <header class="py-3 border-bottom">
                    <div class="container">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow-1 py-4">
                <div class="container">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="footer mt-auto py-3 {{ auth()->check() && auth()->user()->role === 'admin' && request()->is('admin*') ? 'bg-primary bg-opacity-10' : 'bg-light' }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Tutorando</h5>
                            <p>Plataforma de interação entre tutores e tutorandos, focada no apoio acadêmico e profissional.</p>
                            @if(auth()->check() && auth()->user()->role === 'admin' && request()->is('admin*'))
                                <div class="badge bg-primary text-white mb-2">Modo Administrador</div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <h5>Links</h5>
                            <ul class="list-unstyled">
                                <li><a href="/" class="text-decoration-none">Página Inicial</a></li>
                                <li><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
                                <li><a href="/projetos" class="text-decoration-none">Projetos</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>Contato</h5>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-envelope-fill me-2"></i> info@tutorando.com</li>
                                <li><i class="bi bi-telephone-fill me-2"></i> +244 923 456 789</li>
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
                        </div>
                    </div>
                </div>
            </footer>
            
            <!-- Botão Voltar ao Topo -->
            <button id="backToTop" class="btn btn-primary rounded-circle shadow position-fixed bottom-0 end-0 me-4 d-none" 
                    style="width: 45px; height: 45px; z-index: 1000; bottom: 20px;">
                <i class="bi bi-arrow-up"></i>
            </button>
        </div>
        
        <!-- Bootstrap Bundle (inclui Popper.js) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Custom navbar script -->
        <script src="/js/navbar.js"></script>
        
        <!-- Custom Scripts sem interferência nos dropdowns -->
        <script>
            // Script para efeito de scroll na navbar
            document.addEventListener('DOMContentLoaded', function() {
                const navbar = document.querySelector('.navbar');
                
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 30) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
                
                // Toggle do modo administrador
                const adminModeToggle = document.getElementById('adminModeToggle');
                if (adminModeToggle) {
                    adminModeToggle.addEventListener('click', function() {
                        this.classList.toggle('on');
                    });
                }
            });
        </script>
        
        <!-- Funcionalidade Voltar ao Topo -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Botão Voltar ao Topo
                const backToTopBtn = document.getElementById('backToTop');
                
                // Mostrar o botão quando rolar para baixo
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        backToTopBtn.classList.remove('d-none');
                        backToTopBtn.classList.add('d-flex', 'justify-content-center', 'align-items-center');
                    } else {
                        backToTopBtn.classList.add('d-none');
                        backToTopBtn.classList.remove('d-flex', 'justify-content-center', 'align-items-center');
                    }
                });
                
                // Rolar para o topo quando clicar no botão
                backToTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            });
        </script>
        
        <!-- Admin Mode Toggle Script -->
        @if(auth()->check() && auth()->user()->role === 'admin')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggle = document.getElementById('adminModeToggle');
                if (toggle) {
                    toggle.addEventListener('click', function() {
                        // Se estiver no modo admin, redireciona para o dashboard normal
                        if (toggle.classList.contains('on')) {
                            window.location.href = '{{ route('dashboard') }}';
                        } 
                        // Se estiver no modo usuário, redireciona para o dashboard admin
                        else {
                            window.location.href = '{{ route('admin.dashboard') }}';
                        }
                        
                        // Toggle da classe (embora possa não ser visto devido ao redirecionamento)
                        toggle.classList.toggle('on');
                        
                        // Alterna o texto
                        const statusText = toggle.querySelector('.small');
                        if (statusText) {
                            statusText.textContent = toggle.classList.contains('on') ? 'ON' : 'OFF';
                        }
                    });
                }
            });
        </script>
        @endif
    </body>
</html>
