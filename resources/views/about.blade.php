<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sobre - Tutorando</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
        <!-- Guest Theme CSS -->
        <link href="{{ asset('css/guest.css') }}" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
            }
            .hero-section {
                background: linear-gradient(135deg, #ff7609 0%, #ff9039 100%);
                color: white;
                padding: 4rem 0;
            }
            .section-header {
                border-left: 4px solid #ff7609;
                padding-left: 1rem;
                margin-bottom: 2rem;
            }
            .timeline-item {
                position: relative;
                padding-left: 3rem;
                margin-bottom: 2rem;
            }
            .timeline-item::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0.5rem;
                width: 12px;
                height: 12px;
                background: #ff7609;
                border-radius: 50%;
            }
            .timeline-item::after {
                content: '';
                position: absolute;
                left: 5px;
                top: 1.2rem;
                width: 2px;
                height: calc(100% + 1rem);
                background: rgba(255, 118, 9, 0.2);
            }
            .timeline-item:last-child::after {
                display: none;
            }
        </style>
    </head>    <body class="bg-light guest-theme">
        <!-- Navigation -->
        @include('components.guest-navbar')

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1 class="display-4 fw-bold mb-4">Sobre o Tutorando</h1>
                        <p class="lead mb-4">Conhece a nossa missão, visão e os valores que nos guiam na construção da maior plataforma de apoio acadêmico em língua portuguesa.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="py-5 bg-white">
            <div class="container py-4">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="section-header">
                            <h2 class="fw-bold">A Nossa Missão</h2>
                        </div>
                        <p class="lead text-muted mb-4">
                            Democratizar o acesso ao conhecimento académico, conectando tutores e tutorandos numa plataforma segura, eficiente e gratuita, promovendo o crescimento educacional e profissional da comunidade académica lusófona.
                        </p>
                    </div>
                </div>
                
                <div class="row g-4 mt-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                                <i class="bi bi-lightbulb text-white fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Inovação</h5>
                            <p class="text-muted">Utilizamos tecnologia de ponta para criar soluções inovadoras no setor educacional.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                                <i class="bi bi-people text-white fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Comunidade</h5>
                            <p class="text-muted">Construímos uma comunidade forte e unida, focada no apoio mútuo e no crescimento coletivo.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                                <i class="bi bi-award text-white fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Excelência</h5>
                            <p class="text-muted">Mantemos padrões elevados de qualidade em todos os aspectos da nossa plataforma.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- History Section -->
        <section class="py-5 bg-light">
            <div class="container py-4">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="section-header">
                            <h2 class="fw-bold">A Nossa História</h2>
                        </div>
                        
                        <div class="timeline-item">
                            <h5 class="fw-bold">2023 - Conceção da Ideia</h5>
                            <p class="text-muted mb-0">Identificámos a necessidade de uma plataforma que conectasse tutores e tutorandos de forma eficiente, segura e gratuita no espaço lusófono.</p>
                        </div>
                        
                        <div class="timeline-item">
                            <h5 class="fw-bold">2024 - Desenvolvimento</h5>
                            <p class="text-muted mb-0">Iniciámos o desenvolvimento da plataforma com foco na experiência do utilizador, segurança dos dados e funcionalidades inovadoras.</p>
                        </div>
                        
                        <div class="timeline-item">
                            <h5 class="fw-bold">2025 - Lançamento</h5>
                            <p class="text-muted mb-0">Lançámos oficialmente o Tutorando, com suporte para Portugal, Brasil e Angola, estabelecendo as bases para uma comunidade académica global.</p>
                        </div>
                        
                        <div class="timeline-item">
                            <h5 class="fw-bold">Futuro - Expansão</h5>
                            <p class="text-muted mb-0">Planeamos expandir para todos os países de língua portuguesa e introduzir funcionalidades avançadas como IA para matching e análise de desempenho.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="py-5 bg-white">
            <div class="container py-4">
                <div class="section-header text-center">
                    <h2 class="fw-bold">A Nossa Equipa</h2>
                    <p class="lead text-muted">Profissionais dedicados ao sucesso da comunidade académica</p>
                </div>
                
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="CEO">
                                <h5 class="fw-bold">Ana Silva</h5>
                                <p class="text-muted small mb-3">CEO & Fundadora</p>
                                <p class="small">Doutora em Educação com 15 anos de experiência em tecnologia educacional.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="text-muted"><i class="bi bi-linkedin"></i></a>
                                    <a href="#" class="text-muted"><i class="bi bi-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="CTO">
                                <h5 class="fw-bold">João Santos</h5>
                                <p class="text-muted small mb-3">CTO</p>
                                <p class="small">Engenheiro de Software especializado em arquiteturas escaláveis e segurança de dados.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="text-muted"><i class="bi bi-linkedin"></i></a>
                                    <a href="#" class="text-muted"><i class="bi bi-github"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Head of Education">
                                <h5 class="fw-bold">Maria Costa</h5>
                                <p class="text-muted small mb-3">Diretora Educacional</p>
                                <p class="small">Especialista em pedagogia digital e metodologias de ensino online.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="text-muted"><i class="bi bi-linkedin"></i></a>
                                    <a href="#" class="text-muted"><i class="bi bi-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Community Manager">
                                <h5 class="fw-bold">Pedro Oliveira</h5>
                                <p class="text-muted small mb-3">Gestor de Comunidade</p>
                                <p class="small">Responsável pela gestão e crescimento da comunidade Tutorando.</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="text-muted"><i class="bi bi-linkedin"></i></a>
                                    <a href="#" class="text-muted"><i class="bi bi-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-5 bg-light">
            <div class="container py-4">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="section-header text-center">
                            <h2 class="fw-bold">Entre em Contacto</h2>
                            <p class="lead text-muted">Tem alguma questão ou sugestão? Adoramos ouvir da nossa comunidade!</p>
                        </div>
                        
                        <div class="row g-4 mt-4">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: rgba(255, 118, 9, 0.1);">
                                        <i class="bi bi-envelope fs-4" style="color: #ff7609;"></i>
                                    </div>
                                    <h6 class="fw-bold">Email</h6>
                                    <p class="text-muted mb-0">contato@tutorando.com</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: rgba(255, 118, 9, 0.1);">
                                        <i class="bi bi-telephone fs-4" style="color: #ff7609;"></i>
                                    </div>
                                    <h6 class="fw-bold">Telefone</h6>
                                    <p class="text-muted mb-0">+351 123 456 789</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: rgba(255, 118, 9, 0.1);">
                                        <i class="bi bi-geo-alt fs-4" style="color: #ff7609;"></i>
                                    </div>
                                    <h6 class="fw-bold">Localização</h6>
                                    <p class="text-muted mb-0">Lisboa, Portugal</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-5">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4">
                                <i class="bi bi-person-plus me-2"></i>Juntar-se à comunidade
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-4 bg-dark text-white">
            <div class="container">
                <div class="row py-3">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-book me-2" style="color: #ff7609;"></i>Tutorando
                        </h5>
                        <p class="mb-0">Conectando tutores e tutorandos para um futuro académico melhor.</p>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <div class="d-flex justify-content-lg-end gap-3 mb-3">
                            <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                        </div>
                        <p class="small text-white-50 mb-0">&copy; {{ date('Y') }} Tutorando. Todos os direitos reservados.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
