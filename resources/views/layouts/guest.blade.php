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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                height: 100vh;
            }
            .auth-card {
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }
            .auth-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid #eee;
                padding: 1.5rem;
            }
            .brand-logo {
                font-size: 2.5rem;
                font-weight: 700;
                background: linear-gradient(45deg, #6a11cb, #2575fc);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
                display: inline-block;
            }
            .nav-tabs .nav-link {
                font-weight: 600;
                color: #495057;
                border: none;
                padding: 0.8rem 1.5rem;
                border-radius: 0;
                transition: all 0.3s;
            }
            .nav-tabs .nav-link.active {
                color: #2575fc;
                border-bottom: 3px solid #2575fc;
                background: transparent;
            }
            .btn-primary {
                background: linear-gradient(45deg, #6a11cb, #2575fc);
                border: none;
                box-shadow: 0 4px 15px rgba(37, 117, 252, 0.2);
            }
            .btn-primary:hover {
                background: linear-gradient(45deg, #5b0fb0, #1e68e6);
                box-shadow: 0 8px 25px rgba(37, 117, 252, 0.3);
            }
        </style>
    </head>
    <body>
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="auth-card card border-0">
                            <div class="auth-header text-center">
                                <a href="/" class="text-decoration-none">
                                    <div class="brand-logo">Tutorando</div>
                                </a>
                                <p class="text-muted mt-2">Plataforma de conexão entre tutores e tutorandos</p>
                            </div>
                            
                            <div class="card-body p-4 p-md-5">
                                {{ $slot }}
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <p class="text-white">&copy; {{ date('Y') }} Tutorando. Todos os direitos reservados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
