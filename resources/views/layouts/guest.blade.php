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
        <!-- Guest Theme CSS -->
        <link href="{{ asset('css/guest.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background: linear-gradient(135deg, #ff7609 0%, #ff9039 100%);
                height: 100vh;
                font-family: 'Nunito', sans-serif;
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
                background: linear-gradient(45deg, #ff7609, #ff9039);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
                display: inline-block;
            }
            .nav-tabs {
                border-bottom: 1px solid rgba(0,0,0,0.08);
            }
            .nav-tabs .nav-link {
                font-weight: 600;
                color: #495057;
                border: none;
                padding: 0.8rem 1.5rem;
                border-radius: 0;
                transition: all 0.3s;
                position: relative;
            }
            .nav-tabs .nav-link.active {
                color: #ff7609;
                background: transparent;
                border-bottom: 3px solid #ff7609;
            }
            .nav-tabs .nav-link.active:after {
                content: '';
                position: absolute;
                bottom: -3px;
                left: 50%;
                transform: translateX(-50%);
                width: 20px;
                height: 3px;
                background: #ff7609;
                border-radius: 3px;
            }
            .input-group-text {
                border-right: 0;
            }
            .form-control {
                border-left: 0;
            }
            .form-control:focus {
                box-shadow: none;
                border-color: #ced4da;
            }
            .input-group:focus-within {
                box-shadow: 0 0 0 0.25rem rgba(255, 118, 9, 0.15);
            }
            .btn-primary {
                background: linear-gradient(45deg, #ff7609, #ff9039);
                border: none;
                box-shadow: 0 4px 15px rgba(255, 118, 9, 0.2);
                font-weight: 600;
            }
            .btn-primary:hover {
                background: linear-gradient(45deg, #e56508, #ff7609);
                box-shadow: 0 8px 25px rgba(255, 118, 9, 0.3);
            }
            .alert-info {
                background-color: rgba(255, 118, 9, 0.1);
                border-color: rgba(255, 118, 9, 0.2);
                color: #ff7609;
            }
            .form-check-input:checked {
                background-color: #ff7609;
                border-color: #ff7609;
            }
            .form-text {
                color: #6c757d;
                font-size: 0.875rem;
            }
            .toggle-password:focus {
                box-shadow: none;
                border-color: #ced4da;
            }
            .progress {
                border-radius: 50px;
                overflow: hidden;
            }
            @media (max-width: 767.98px) {
                .auth-card {
                    margin: 0 10px;
                }
            }
        </style>
    </head>
    <body class="guest-theme">
        <div class="d-flex justify-content-center align-items-center min-vh-100 py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="auth-card card border-0">
                            <div class="auth-header text-center py-4">
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
        
        <script>
            // Enable form validation styling
            document.addEventListener('DOMContentLoaded', function() {
                // Apply validation styles on submit
                const forms = document.querySelectorAll('.needs-validation');
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
                
                // Add animation to cards
                const authCard = document.querySelector('.auth-card');
                if (authCard) {
                    authCard.style.opacity = '0';
                    authCard.style.transform = 'translateY(20px)';
                    authCard.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    
                    setTimeout(() => {
                        authCard.style.opacity = '1';
                        authCard.style.transform = 'translateY(0)';
                    }, 100);
                }
            });
        </script>
    </body>
</html>
