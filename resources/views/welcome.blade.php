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
                padding: 6rem 0;
            }
            .features-icon {
                font-size: 2.5rem;
                color: #ff7609;
                margin-bottom: 1rem;
            }
            .btn-primary {
                background: linear-gradient(45deg, #ff7609, #ff9039);
                border: none;
                box-shadow: 0 4px 15px rgba(255, 118, 9, 0.2);
            }
            .btn-primary:hover {
                background: linear-gradient(45deg, #e56508, #ff7609);
                box-shadow: 0 8px 25px rgba(255, 118, 9, 0.3);
            }
            .btn-outline-light:hover {
                color: #ff7609;
            }
        </style>
    </head>
    <body class="bg-light guest-theme">
        <!-- Navigation -->
        @include('components.guest-navbar')

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
                    <div class="col-lg-6">
                        <img src="{{ asset('img/hero.jpg') }}" class="img-fluid rounded shadow d-block mx-auto" alt="Tutorando Platform">
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

        <!-- Detailed Features Section -->
        <section class="py-5 bg-light">
            <div class="container py-4">
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="fw-bold">Recursos da Plataforma</h2>
                        <p class="lead text-muted">Tudo o que precisa para uma experiência acadêmica completa</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                                    <i class="bi bi-search text-white fs-4"></i>
                                </div>
                            </div>
                            <div class="ms-4">
                                <h5 class="fw-bold">Sistema de Pesquisa Avançado</h5>
                                <p class="text-muted mb-0">Encontre tutores e projetos por área, localização, avaliações e disponibilidade através do nosso sistema de filtros inteligente.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                                    <i class="bi bi-chat-dots text-white fs-4"></i>
                                </div>
                            </div>
                            <div class="ms-4">
                                <h5 class="fw-bold">Sistema de Mensagens</h5>
                                <p class="text-muted mb-0">Comunicação direta entre tutores e tutorandos através de um sistema de mensagens seguro e privado.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                                    <i class="bi bi-calendar-check text-white fs-4"></i>
                                </div>
                            </div>
                            <div class="ms-4">
                                <h5 class="fw-bold">Agendamento de Sessões</h5>
                                <p class="text-muted mb-0">Agende sessões de tutoria de forma simples e organize o seu tempo de estudo com nosso calendário integrado.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                                    <i class="bi bi-star text-white fs-4"></i>
                                </div>
                            </div>
                            <div class="ms-4">
                                <h5 class="fw-bold">Sistema de Avaliações</h5>
                                <p class="text-muted mb-0">Avalie tutores e projetos para ajudar outros utilizadores a fazer melhores escolhas académicas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                                    <i class="bi bi-cloud-upload text-white fs-4"></i>
                                </div>
                            </div>
                            <div class="ms-4">
                                <h5 class="fw-bold">Partilha de Ficheiros</h5>
                                <p class="text-muted mb-0">Faça upload e partilhe documentos, apresentações, vídeos e outros materiais académicos de forma segura.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(45deg, #ff7609, #ff9039);">
                                    <i class="bi bi-graph-up text-white fs-4"></i>
                                </div>
                            </div>
                            <div class="ms-4">
                                <h5 class="fw-bold">Acompanhamento de Progresso</h5>
                                <p class="text-muted mb-0">Monitore o seu desenvolvimento académico com relatórios de progresso e estatísticas personalizadas.</p>
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
                    <div class="col-12 text-center">
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

        <!-- Statistics Section -->
        <section class="py-5 bg-white">
            <div class="container py-4">
                <div class="row text-center mb-5">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="fw-bold">Tutorando em números</h2>
                        <p class="lead text-muted">Dados que comprovam o sucesso da nossa plataforma</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-3 col-sm-6">
                        <div class="card border-0 text-center h-100">
                            <div class="card-body">
                                <div class="features-icon mb-3">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <h3 class="fw-bold" style="color: #ff7609;">{{ number_format($stats['total_tutors']) }}{{ $stats['total_tutors'] > 0 ? '+' : '' }}</h3>
                                <p class="text-muted mb-0">Tutores ativos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card border-0 text-center h-100">
                            <div class="card-body">
                                <div class="features-icon mb-3">
                                    <i class="bi bi-mortarboard-fill"></i>
                                </div>
                                <h3 class="fw-bold" style="color: #ff7609;">{{ number_format($stats['total_students']) }}{{ $stats['total_students'] > 0 ? '+' : '' }}</h3>
                                <p class="text-muted mb-0">Tutorandos registados</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card border-0 text-center h-100">
                            <div class="card-body">
                                <div class="features-icon mb-3">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <h3 class="fw-bold" style="color: #ff7609;">{{ number_format($stats['total_projects']) }}{{ $stats['total_projects'] > 0 ? '+' : '' }}</h3>
                                <p class="text-muted mb-0">Projetos publicados</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card border-0 text-center h-100">
                            <div class="card-body">
                                <div class="features-icon mb-3">
                                    <i class="bi bi-book-fill"></i>
                                </div>
                                <h3 class="fw-bold" style="color: #ff7609;">{{ number_format($stats['total_publications']) }}{{ $stats['total_publications'] > 0 ? '+' : '' }}</h3>
                                <p class="text-muted mb-0">Publicações acadêmicas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Academic Areas Section -->
        <section class="py-5 bg-light">
            <div class="container py-4">
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="fw-bold">Áreas Acadêmicas</h2>
                        <p class="lead text-muted">Encontre tutores e projetos nas principais áreas do conhecimento</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm text-center">
                            <div class="card-body p-4">
                                <i class="bi bi-laptop features-icon"></i>
                                <h5 class="card-title">Tecnologia</h5>
                                <p class="card-text text-muted">Informática, Engenharia de Software, Sistemas de Informação</p>
                                <div class="mt-3">
                                    <span class="badge bg-light text-dark me-1">{{ $stats['tech_tutors'] }}{{ $stats['tech_tutors'] > 0 ? '+' : '' }} tutores</span>
                                    <span class="badge bg-light text-dark">{{ $stats['tech_projects'] }}{{ $stats['tech_projects'] > 0 ? '+' : '' }} projetos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm text-center">
                            <div class="card-body p-4">
                                <i class="bi bi-heart-pulse features-icon"></i>
                                <h5 class="card-title">Saúde</h5>
                                <p class="card-text text-muted">Medicina, Enfermagem, Fisioterapia, Farmácia</p>
                                <div class="mt-3">
                                    <span class="badge bg-light text-dark me-1">{{ $stats['health_tutors'] }}{{ $stats['health_tutors'] > 0 ? '+' : '' }} tutores</span>
                                    <span class="badge bg-light text-dark">{{ $stats['health_projects'] }}{{ $stats['health_projects'] > 0 ? '+' : '' }} projetos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm text-center">
                            <div class="card-body p-4">
                                <i class="bi bi-building features-icon"></i>
                                <h5 class="card-title">Engenharias</h5>
                                <p class="card-text text-muted">Civil, Mecânica, Elétrica, Química</p>
                                <div class="mt-3">
                                    <span class="badge bg-light text-dark me-1">{{ $stats['engineering_tutors'] }}{{ $stats['engineering_tutors'] > 0 ? '+' : '' }} tutores</span>
                                    <span class="badge bg-light text-dark">{{ $stats['engineering_projects'] }}{{ $stats['engineering_projects'] > 0 ? '+' : '' }} projetos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card h-100 border-0 shadow-sm text-center">
                            <div class="card-body p-4">
                                <i class="bi bi-calculator features-icon"></i>
                                <h5 class="card-title">Exatas</h5>
                                <p class="card-text text-muted">Matemática, Física, Química, Estatística</p>
                                <div class="mt-3">
                                    <span class="badge bg-light text-dark me-1">{{ $stats['exact_tutors'] }}{{ $stats['exact_tutors'] > 0 ? '+' : '' }} tutores</span>
                                    <span class="badge bg-light text-dark">{{ $stats['exact_projects'] }}{{ $stats['exact_projects'] > 0 ? '+' : '' }} projetos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-search me-2"></i>Explorar todas as áreas
                    </a>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-5 bg-white">
            <div class="container py-4">
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="fw-bold">O que dizem nossos utilizadores</h2>
                        <p class="lead text-muted">Depoimentos de tutores e tutorandos que já fazem parte da nossa comunidade</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </div>
                                <p class="card-text">"O Tutorando mudou a minha forma de estudar. Consegui encontrar tutores especializados na minha área e melhorar significativamente as minhas notas."</p>
                                <div class="d-flex align-items-center mt-3">
                                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Ana Silva">
                                    <div>
                                        <h6 class="mb-0">Ana Silva</h6>
                                        <small class="text-muted">Estudante de Medicina</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </div>
                                <p class="card-text">"Como tutor, esta plataforma permitiu-me partilhar o meu conhecimento e ajudar dezenas de estudantes. É muito gratificante!"</p>
                                <div class="d-flex align-items-center mt-3">
                                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Prof. João Santos">
                                    <div>
                                        <h6 class="mb-0">Prof. João Santos</h6>
                                        <small class="text-muted">Tutor de Engenharia</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </div>
                                <p class="card-text">"Publiquei o meu projeto de TCC aqui e recebi feedback valioso de outros estudantes e professores. Recomendo!"</p>
                                <div class="d-flex align-items-center mt-3">
                                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Maria Costa">
                                    <div>
                                        <h6 class="mb-0">Maria Costa</h6>
                                        <small class="text-muted">Estudante de Informática</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-5 bg-light">
            <div class="container py-4">
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center">
                        <h2 class="fw-bold">Perguntas Frequentes</h2>
                        <p class="lead text-muted">Tire as suas dúvidas sobre a plataforma Tutorando</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item border-0 shadow-sm mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        Como posso encontrar um tutor na minha área?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Após registar-se, pode pesquisar tutores por área de conhecimento, localização ou avaliações. Use os filtros para encontrar o tutor que melhor se adequa às suas necessidades.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 shadow-sm mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        A plataforma é gratuita?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Sim! O registo e uso básico da plataforma são totalmente gratuitos. Pode aceder a projetos, publicações e contactar tutores sem custos.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 shadow-sm mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        Como posso publicar o meu projeto?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Após o registo, aceda ao seu painel e clique em "Publicar Projeto". Preencha as informações, adicione ficheiros e publique para que outros utilizadores possam ver e comentar.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0 shadow-sm mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                        Posso ser tutor e tutorando ao mesmo tempo?
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Claro! Muitos utilizadores são tanto tutores em certas áreas quanto tutorandos noutras. Pode alternar entre os papéis conforme necessário.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-5" style="background: linear-gradient(135deg, #ff7609 0%, #ff9039 100%);">
            <div class="container py-4 text-center text-white">
                <h2 class="fw-bold mb-4">Pronto para começar sua jornada acadêmica?</h2>
                <p class="lead mb-4">Junte-se a milhares de estudantes e professores que já fazem parte da nossa comunidade.</p>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('register') }}" class="btn btn-light btn-lg w-100">
                                    <i class="bi bi-person-plus me-2"></i> Registar como Tutorando
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg w-100">
                                    <i class="bi bi-mortarboard me-2"></i> Registar como Tutor
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-5 bg-dark text-white">
            <div class="container">
                <div class="row py-4">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-book me-2" style="color: #ff7609;"></i>Tutorando
                        </h5>
                        <p class="mb-3">Plataforma de interação entre tutores e tutorandos, focada no apoio acadêmico e profissional.</p>
                        <div class="d-flex gap-3 mb-3">
                            <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="text-white fs-5"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-white fs-5"><i class="bi bi-linkedin"></i></a>
                        </div>
                        <p class="small text-muted mb-0">
                            <i class="bi bi-geo-alt me-1"></i>Portugal • Brasil • Angola
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-2 mb-4 mb-lg-0">
                        <h6 class="fw-bold mb-3">Plataforma</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ url('/sobre') }}" class="text-white-50 text-decoration-none">Sobre nós</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Como funciona</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Áreas acadêmicas</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Planos</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-2 mb-4 mb-lg-0">
                        <h6 class="fw-bold mb-3">Para Estudantes</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Encontrar tutor</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Projetos</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Publicações</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Recursos</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Comunidade</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-2 mb-4 mb-lg-0">
                        <h6 class="fw-bold mb-3">Suporte</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ url('/faq') }}" class="text-white-50 text-decoration-none">FAQ</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Central de ajuda</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Contato</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Reportar problema</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Status do sistema</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-2">
                        <h6 class="fw-bold mb-3">Legal</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Termos de uso</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Política de privacidade</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Cookies</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">LGPD</a></li>
                            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Direitos autorais</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="row py-3 border-top border-secondary">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <h6 class="fw-bold mb-3">Informações de Contato</h6>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <small class="text-white-50">
                                    <i class="bi bi-envelope me-2"></i>contato@tutorando.com
                                </small>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-white-50">
                                    <i class="bi bi-telephone me-2"></i>+351 123 456 789
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="fw-bold mb-3">Newsletter</h6>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Seu email" aria-label="Seu email">
                            <button class="btn" style="background: linear-gradient(45deg, #ff7609, #ff9039); color: white;" type="button">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                        <small class="text-white-50 mt-2 d-block">Receba novidades e dicas acadêmicas</small>
                    </div>
                </div>
                
                <hr class="my-4 border-secondary">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="small mb-0 text-white-50">&copy; {{ date('Y') }} Tutorando. Todos os direitos reservados.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                        <small class="text-white-50">
                            Feito com <i class="bi bi-heart-fill" style="color: #ff7609;"></i> para a comunidade acadêmica
                        </small>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        
        <script>
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Intersection Observer for scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, observerOptions);

            // Apply observer to cards and sections
            document.addEventListener('DOMContentLoaded', function() {
                const animatedElements = document.querySelectorAll('.card, .features-section, .testimonial-card');
                animatedElements.forEach(el => {
                    el.classList.add('animate-on-scroll');
                    observer.observe(el);
                });

                // Counter animation for statistics
                const counters = document.querySelectorAll('.stats-number');
                counters.forEach(counter => {
                    const target = parseInt(counter.textContent.replace(/[^0-9]/g, ''));
                    let current = 0;
                    const increment = target / 100;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        counter.textContent = Math.floor(current).toLocaleString() + '+';
                    }, 20);
                });

                // Newsletter form handling
                const newsletterForm = document.querySelector('.newsletter-form');
                if (newsletterForm) {
                    newsletterForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const email = this.querySelector('input[type="email"]').value;
                        if (email) {
                            // Show success message
                            const button = this.querySelector('button');
                            const originalText = button.innerHTML;
                            button.innerHTML = '<i class="bi bi-check"></i>';
                            button.classList.add('btn-success');
                            
                            setTimeout(() => {
                                button.innerHTML = originalText;
                                button.classList.remove('btn-success');
                                this.querySelector('input[type="email"]').value = '';
                            }, 2000);
                        }
                    });
                }
            });

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }
            });
        </script>
        
        <style>
            .navbar-scrolled {
                background-color: rgba(255, 255, 255, 0.95) !important;
                backdrop-filter: blur(10px);
                box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }
        </style>
    </body>
</html>
