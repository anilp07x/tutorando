<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FAQ - Perguntas Frequentes - Tutorando</title>
        
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
            .faq-category {
                border-left: 4px solid #ff7609;
                padding-left: 1rem;
                margin-bottom: 2rem;
            }
            .search-box {
                border-radius: 50px;
                border: 2px solid rgba(255, 118, 9, 0.2);
                padding: 0.75rem 1.5rem;
            }
            .search-box:focus {
                border-color: #ff7609;
                box-shadow: 0 0 0 0.25rem rgba(255, 118, 9, 0.1);
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
                        <h1 class="display-4 fw-bold mb-4">Perguntas Frequentes</h1>
                        <p class="lead mb-4">Encontre respostas para as dúvidas mais comuns sobre a plataforma Tutorando.</p>
                        
                        <!-- Search Box -->
                        <div class="col-lg-6 mx-auto">
                            <div class="input-group mb-4">
                                <input type="text" class="form-control search-box border-end-0" placeholder="Pesquisar por questão..." id="faqSearch">
                                <button class="btn btn-light border-start-0" type="button" style="border-radius: 0 50px 50px 0;">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Links -->
        <section class="py-4 bg-white border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="#geral" class="btn btn-outline-primary btn-sm">Questões Gerais</a>
                            <a href="#conta" class="btn btn-outline-primary btn-sm">Conta e Perfil</a>
                            <a href="#tutores" class="btn btn-outline-primary btn-sm">Para Tutores</a>
                            <a href="#tutorandos" class="btn btn-outline-primary btn-sm">Para Tutorandos</a>
                            <a href="#projetos" class="btn btn-outline-primary btn-sm">Projetos</a>
                            <a href="#pagamentos" class="btn btn-outline-primary btn-sm">Pagamentos</a>
                            <a href="#tecnico" class="btn btn-outline-primary btn-sm">Suporte Técnico</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Content -->
        <section class="py-5">
            <div class="container py-4">
                <!-- Questões Gerais -->
                <div id="geral" class="faq-category">
                    <h3 class="fw-bold">Questões Gerais</h3>
                </div>
                
                <div class="accordion mb-5" id="geralAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#geral1">
                                O que é o Tutorando?
                            </button>
                        </h2>
                        <div id="geral1" class="accordion-collapse collapse show" data-bs-parent="#geralAccordion">
                            <div class="accordion-body">
                                O Tutorando é uma plataforma digital que conecta tutores e tutorandos, facilitando o partilha de conhecimento, projetos académicos e materiais educacionais. A nossa missão é democratizar o acesso ao apoio académico de qualidade.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#geral2">
                                A plataforma é gratuita?
                            </button>
                        </h2>
                        <div id="geral2" class="accordion-collapse collapse" data-bs-parent="#geralAccordion">
                            <div class="accordion-body">
                                Sim! O registo e uso básico da plataforma são completamente gratuitos. Pode criar conta, procurar tutores, publicar projetos e aceder a materiais sem qualquer custo. Algumas funcionalidades premium poderão ter custos associados no futuro.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#geral3">
                                Em que países está disponível?
                            </button>
                        </h2>
                        <div id="geral3" class="accordion-collapse collapse" data-bs-parent="#geralAccordion">
                            <div class="accordion-body">
                                Atualmente, o Tutorando está disponível em Portugal, Brasil e Angola. Planeamos expandir para todos os países de língua portuguesa nos próximos meses.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conta e Perfil -->
                <div id="conta" class="faq-category">
                    <h3 class="fw-bold">Conta e Perfil</h3>
                </div>
                
                <div class="accordion mb-5" id="contaAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#conta1">
                                Como criar uma conta?
                            </button>
                        </h2>
                        <div id="conta1" class="accordion-collapse collapse" data-bs-parent="#contaAccordion">
                            <div class="accordion-body">
                                Para criar conta, clique em "Cadastrar" no topo da página, preencha o formulário com os seus dados pessoais, escolha se é tutor ou tutorando, e confirme o seu email. O processo demora apenas alguns minutos!
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#conta2">
                                Posso alterar o meu tipo de conta (tutor/tutorando)?
                            </button>
                        </h2>
                        <div id="conta2" class="accordion-collapse collapse" data-bs-parent="#contaAccordion">
                            <div class="accordion-body">
                                Sim! Pode alterar o tipo de conta nas configurações do perfil. Muitos utilizadores são tanto tutores numa área quanto tutorandos noutra. Também pode ter ambos os papéis simultaneamente.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#conta3">
                                Como eliminar a minha conta?
                            </button>
                        </h2>
                        <div id="conta3" class="accordion-collapse collapse" data-bs-parent="#contaAccordion">
                            <div class="accordion-body">
                                Pode eliminar a sua conta nas configurações do perfil. Tenha em atenção que esta ação é irreversível e todos os seus dados serão permanentemente removidos da plataforma.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Para Tutores -->
                <div id="tutores" class="faq-category">
                    <h3 class="fw-bold">Para Tutores</h3>
                </div>
                
                <div class="accordion mb-5" id="tutoresAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tutores1">
                                Que qualificações preciso para ser tutor?
                            </button>
                        </h2>
                        <div id="tutores1" class="accordion-collapse collapse" data-bs-parent="#tutoresAccordion">
                            <div class="accordion-body">
                                Não há requisitos formais rígidos. Valorizamos experiência, conhecimento demonstrável na área e capacidade de transmitir conhecimento. Estudantes avançados, profissionais e académicos são bem-vindos como tutores.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tutores2">
                                Como posso ser encontrado por tutorandos?
                            </button>
                        </h2>
                        <div id="tutores2" class="accordion-collapse collapse" data-bs-parent="#tutoresAccordion">
                            <div class="accordion-body">
                                Complete o seu perfil com informações detalhadas sobre a sua experiência, áreas de especialização e disponibilidade. Publique conteúdo relevante e mantenha-se ativo na plataforma para aumentar a sua visibilidade.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tutores3">
                                Posso cobrar pelos meus serviços?
                            </button>
                        </h2>
                        <div id="tutores3" class="accordion-collapse collapse" data-bs-parent="#tutoresAccordion">
                            <div class="accordion-body">
                                Sim, pode definir preços para as suas sessões de tutoria. A plataforma facilita o contacto entre tutores e tutorandos, mas os acordos financeiros são feitos diretamente entre as partes.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Para Tutorandos -->
                <div id="tutorandos" class="faq-category">
                    <h3 class="fw-bold">Para Tutorandos</h3>
                </div>
                
                <div class="accordion mb-5" id="tutorandosAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tutorandos1">
                                Como encontrar o tutor ideal?
                            </button>
                        </h2>
                        <div id="tutorandos1" class="accordion-collapse collapse" data-bs-parent="#tutorandosAccordion">
                            <div class="accordion-body">
                                Use os filtros de pesquisa para encontrar tutores por área de conhecimento, localização, preço e avaliações. Leia os perfis detalhadamente e verifique as avaliações de outros tutorandos antes de fazer contacto.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tutorandos2">
                                As sessões são presenciais ou online?
                            </button>
                        </h2>
                        <div id="tutorandos2" class="accordion-collapse collapse" data-bs-parent="#tutorandosAccordion">
                            <div class="accordion-body">
                                Ambas! Os tutores podem oferecer sessões presenciais, online ou híbridas. Esta informação está disponível no perfil de cada tutor. A modalidade é acordada diretamente entre tutor e tutorando.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tutorandos3">
                                Como avaliar um tutor?
                            </button>
                        </h2>
                        <div id="tutorandos3" class="accordion-collapse collapse" data-bs-parent="#tutorandosAccordion">
                            <div class="accordion-body">
                                Após uma sessão de tutoria, receberá um convite para avaliar o tutor. As avaliações ajudam outros tutorandos a fazer melhores escolhas e contribuem para a qualidade geral da plataforma.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projetos -->
                <div id="projetos" class="faq-category">
                    <h3 class="fw-bold">Projetos e Publicações</h3>
                </div>
                
                <div class="accordion mb-5" id="projetosAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#projetos1">
                                Como publicar um projeto?
                            </button>
                        </h2>
                        <div id="projetos1" class="accordion-collapse collapse" data-bs-parent="#projetosAccordion">
                            <div class="accordion-body">
                                Após fazer login, vá ao seu painel e clique em "Publicar Projeto". Preencha as informações do projeto, adicione ficheiros se necessário, e publique para que outros utilizadores possam ver e comentar.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#projetos2">
                                Que tipos de ficheiros posso enviar?
                            </button>
                        </h2>
                        <div id="projetos2" class="accordion-collapse collapse" data-bs-parent="#projetosAccordion">
                            <div class="accordion-body">
                                Suportamos documentos PDF, Word, PowerPoint, imagens (JPG, PNG), vídeos (MP4) e ficheiros comprimidos (ZIP). O tamanho máximo por ficheiro é de 50MB.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#projetos3">
                                Os meus projetos ficam públicos?
                            </button>
                        </h2>
                        <div id="projetos3" class="accordion-collapse collapse" data-bs-parent="#projetosAccordion">
                            <div class="accordion-body">
                                Pode escolher se o projeto fica público (visível para todos) ou privado (apenas para si). Projetos públicos recebem mais feedback e interação da comunidade.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Suporte Técnico -->
                <div id="tecnico" class="faq-category">
                    <h3 class="fw-bold">Suporte Técnico</h3>
                </div>
                
                <div class="accordion mb-5" id="tecnicoAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tecnico1">
                                Como contactar o suporte?
                            </button>
                        </h2>
                        <div id="tecnico1" class="accordion-collapse collapse" data-bs-parent="#tecnicoAccordion">
                            <div class="accordion-body">
                                Pode contactar-nos através do email contato@tutorando.com, pelo telefone +351 123 456 789, ou através do formulário de contacto na plataforma. O nosso suporte está disponível 24/7.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tecnico2">
                                A plataforma é segura?
                            </button>
                        </h2>
                        <div id="tecnico2" class="accordion-collapse collapse" data-bs-parent="#tecnicoAccordion">
                            <div class="accordion-body">
                                Sim! Utilizamos encriptação SSL, proteção de dados conforme RGPD/LGPD, e sistemas de backup regulares. Os seus dados pessoais e académicos estão seguros connosco.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tecnico3">
                                Que browsers são suportados?
                            </button>
                        </h2>
                        <div id="tecnico3" class="accordion-collapse collapse" data-bs-parent="#tecnicoAccordion">
                            <div class="accordion-body">
                                A plataforma funciona em todos os browsers modernos: Chrome, Firefox, Safari, Edge. Recomendamos manter o browser atualizado para a melhor experiência.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-5 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <h3 class="fw-bold mb-3">Não encontrou a resposta?</h3>
                        <p class="text-muted mb-4">A nossa equipa de suporte está aqui para ajudar!</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="mailto:contato@tutorando.com" class="btn btn-primary">
                                <i class="bi bi-envelope me-2"></i>Enviar Email
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                <i class="bi bi-person-plus me-2"></i>Criar Conta
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
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Search functionality
                const searchInput = document.getElementById('faqSearch');
                const faqItems = document.querySelectorAll('.faq-item');
                
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    
                    faqItems.forEach(item => {
                        const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                        const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
                        
                        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = searchTerm === '' ? 'block' : 'none';
                        }
                    });
                });
                
                // Smooth scrolling for quick links
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
            });
        </script>
    </body>
</html>
