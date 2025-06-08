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
