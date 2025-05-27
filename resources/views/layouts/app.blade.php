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
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
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
            <footer class="footer mt-auto py-3 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Tutorando</h5>
                            <p>Plataforma de interação entre tutores e tutorandos, focada no apoio acadêmico e profissional.</p>
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
        </div>
        
        <!-- Bootstrap JS with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
