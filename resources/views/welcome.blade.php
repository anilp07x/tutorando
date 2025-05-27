<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tutorando</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
            }
            .hero-section {
                background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
                color: white;
                padding: 6rem 0;
            }
            .features-icon {
                font-size: 2.5rem;
                color: #007bff;
                margin-bottom: 1rem;
            }
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }
            .btn-outline-light:hover {
                color: #007bff;
            }
            .navbar-brand {
                font-weight: 600;
                color: #007bff;
            }
        </style>
    </head>
    <body class="bg-light">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="bi bi-book me-2"></i>Tutorando
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Registro</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Plataforma de interação entre tutores e tutorandos</h1>
                        <p class="lead mb-4">Conectamos tutores e tutorandos para compartilhar conhecimento, projetos e publicações acadêmicas.</p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">Encontrar Tutor</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Publicar Projeto</a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <img src="https://via.placeholder.com/600x400?text=Tutorando" class="img-fluid rounded shadow" alt="Tutorando Platform">
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-5 bg-white">
            <div class="container py-4">
                <div class="row text-center mb-5">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="fw-bold">Como funciona o Tutorando</h2>
                        <p class="lead text-muted">Uma plataforma completa para apoio acadêmico e profissional</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-mortarboard-fill features-icon"></i>
                                <h3 class="h4 card-title">Para Tutorandos</h3>
                                <p class="card-text text-muted">Encontre tutores qualificados, acesse materiais acadêmicos e publique seus projetos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-person-workspace features-icon"></i>
                                <h3 class="h4 card-title">Para Tutores</h3>
                                <p class="card-text text-muted">Compartilhe seu conhecimento, publique materiais acadêmicos e conecte-se com tutorandos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-journal-richtext features-icon"></i>
                                <h3 class="h4 card-title">Publicações</h3>
                                <p class="card-text text-muted">Acesse livros, artigos, sebentas, cursos e vídeos compartilhados pela comunidade acadêmica.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Projects Section -->
        <section class="py-5 bg-light">
            <div class="container py-4">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="fw-bold">Projetos em Destaque</h2>
                        <p class="text-muted">Conheça alguns dos projetos disponíveis em nossa plataforma</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="https://via.placeholder.com/300x200?text=Projeto+1" class="card-img-top" alt="Projeto 1">
                            <div class="card-body">
                                <span class="badge bg-primary mb-2">Engenharia</span>
                                <h5 class="card-title">Sistema de Gestão Acadêmica</h5>
                                <p class="card-text">Projeto para desenvolver um sistema de gestão acadêmica para instituições de ensino.</p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Avatar">
                                    <small class="text-muted">João Silva</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="https://via.placeholder.com/300x200?text=Projeto+2" class="card-img-top" alt="Projeto 2">
                            <div class="card-body">
                                <span class="badge bg-success mb-2">Saúde</span>
                                <h5 class="card-title">Aplicativo de Monitoramento de Saúde</h5>
                                <p class="card-text">Desenvolvimento de um aplicativo para monitoramento de saúde dos pacientes.</p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Avatar">
                                    <small class="text-muted">Maria Sousa</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="https://via.placeholder.com/300x200?text=Projeto+3" class="card-img-top" alt="Projeto 3">
                            <div class="card-body">
                                <span class="badge bg-warning text-dark mb-2">Educação</span>
                                <h5 class="card-title">Plataforma de Ensino a Distância</h5>
                                <p class="card-text">Criação de uma plataforma para cursos online com recursos interativos.</p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" alt="Avatar">
                                    <small class="text-muted">Pedro Santos</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('register') }}" class="btn btn-primary">Ver todos os projetos</a>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5 bg-primary text-white">
            <div class="container py-4 text-center">
                <h2 class="fw-bold mb-4">Pronto para começar sua jornada acadêmica?</h2>
                <p class="lead mb-4">Registre-se agora e conecte-se com tutores e tutorandos de todo o país.</p>
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">Criar conta gratuita</a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-4 bg-dark text-white">
            <div class="container">
                <div class="row py-3">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h5 class="fw-bold mb-3">Tutorando</h5>
                        <p>Plataforma de interação entre tutores e tutorandos, focada no apoio acadêmico e profissional.</p>
                    </div>
                    <div class="col-md-4 col-lg-2 mb-4 mb-lg-0">
                        <h6 class="fw-bold mb-3">Links</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Sobre nós</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Projetos</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Publicações</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Contato</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-lg-2 mb-4 mb-lg-0">
                        <h6 class="fw-bold mb-3">Suporte</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Ajuda</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Termos</a></li>
                            <li class="mb-2"><a href="#" class="text-white text-decoration-none">Privacidade</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <h6 class="fw-bold mb-3">Receba novidades</h6>
                        <p class="mb-3">Inscreva-se para receber atualizações e novidades.</p>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Seu email" aria-label="Seu email">
                            <button class="btn btn-primary" type="button">Inscrever</button>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="small mb-0">&copy; {{ date('Y') }} Tutorando. Todos os direitos reservados.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                        <div class="d-flex justify-content-center justify-content-md-end gap-3">
                            <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
