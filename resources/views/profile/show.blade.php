<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Header do Perfil -->
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-body p-0">
                        <div class="bg-gradient-primary text-white p-4 rounded-top">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xl bg-white text-primary rounded-circle me-4 d-flex align-items-center justify-content-center">
                                            @if($user->role === 'tutor')
                                                <i class="bi bi-mortarboard fs-2"></i>
                                            @elseif($user->role === 'tutorando')
                                                <i class="bi bi-person-circle fs-2"></i>
                                            @else
                                                <i class="bi bi-person fs-2"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h2 class="mb-1 fw-bold">{{ $user->name }}</h2>
                                            <p class="mb-1 opacity-75">
                                                @if($user->role === 'tutor')
                                                    <i class="bi bi-star-fill me-2"></i>Tutor
                                                @elseif($user->role === 'tutorando')
                                                    <i class="bi bi-book me-2"></i>Tutorando
                                                @else
                                                    <i class="bi bi-person me-2"></i>{{ ucfirst($user->role) }}
                                                @endif
                                            </p>
                                            @if($user->curso)
                                                <p class="mb-0 opacity-75">
                                                    <i class="bi bi-graduation-cap me-2"></i>{{ $user->curso }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-light btn-lg">
                                        <i class="bi bi-pencil-square me-2"></i>Editar Perfil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Informações Pessoais -->
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom-0">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-info-circle text-primary me-2"></i>Informações Pessoais
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="info-item mb-3">
                                    <label class="form-label text-muted small">Email</label>
                                    <p class="mb-0 fw-medium">{{ $user->email }}</p>
                                </div>

                                @if($user->curso)
                                    <div class="info-item mb-3">
                                        <label class="form-label text-muted small">Curso</label>
                                        <p class="mb-0 fw-medium">{{ $user->curso }}</p>
                                    </div>
                                @endif

                                @if($user->instituicao)
                                    <div class="info-item mb-3">
                                        <label class="form-label text-muted small">Instituição</label>
                                        <p class="mb-0 fw-medium">{{ $user->instituicao->nome }}</p>
                                        @if($user->instituicao->localizacao)
                                            <small class="text-muted">
                                                <i class="bi bi-geo-alt me-1"></i>{{ $user->instituicao->localizacao }}
                                            </small>
                                        @endif
                                    </div>
                                @endif

                                <div class="info-item mb-3">
                                    <label class="form-label text-muted small">Função no Sistema</label>
                                    <p class="mb-0">
                                        @if($user->role === 'tutor')
                                            <span class="badge bg-success-soft text-success">
                                                <i class="bi bi-star-fill me-1"></i>Tutor
                                            </span>
                                        @elseif($user->role === 'tutorando')
                                            <span class="badge bg-info-soft text-info">
                                                <i class="bi bi-book me-1"></i>Tutorando
                                            </span>
                                        @elseif($user->role === 'admin')
                                            <span class="badge bg-warning-soft text-warning">
                                                <i class="bi bi-shield-check me-1"></i>Administrador
                                            </span>
                                        @endif
                                    </p>
                                </div>

                                <div class="info-item">
                                    <label class="form-label text-muted small">Membro desde</label>
                                    <p class="mb-0 fw-medium">
                                        <i class="bi bi-calendar3 me-2"></i>
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estatísticas -->
                    <div class="col-md-8">
                        @if($user->role === 'tutor' || $user->role === 'tutorando')
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom-0">
                                    <h5 class="card-title mb-0">
                                        <i class="bi bi-bar-chart text-primary me-2"></i>Estatísticas de Atividade
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Projetos -->
                                        <div class="col-md-6 mb-4">
                                            <div class="stat-card bg-primary-soft p-4 rounded-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h3 class="mb-1 text-primary fw-bold">{{ $stats['total_projetos'] ?? 0 }}</h3>
                                                        <p class="mb-0 text-muted">Projetos Criados</p>
                                                    </div>
                                                    <div class="stat-icon">
                                                        <i class="bi bi-folder-plus text-primary fs-1"></i>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="row text-center">
                                                        <div class="col-6">
                                                            <small class="text-success">
                                                                <i class="bi bi-check-circle me-1"></i>
                                                                {{ $stats['projetos_aprovados'] ?? 0 }} Aprovados
                                                            </small>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-warning">
                                                                <i class="bi bi-clock me-1"></i>
                                                                {{ $stats['projetos_pendentes'] ?? 0 }} Pendentes
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($user->role === 'tutor' && isset($stats['total_publicacoes']))
                                            <!-- Publicações (apenas para tutores) -->
                                            <div class="col-md-6 mb-4">
                                                <div class="stat-card bg-success-soft p-4 rounded-3">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h3 class="mb-1 text-success fw-bold">{{ $stats['total_publicacoes'] ?? 0 }}</h3>
                                                            <p class="mb-0 text-muted">Publicações Criadas</p>
                                                        </div>
                                                        <div class="stat-icon">
                                                            <i class="bi bi-journal-text text-success fs-1"></i>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="row text-center">
                                                            <div class="col-6">
                                                                <small class="text-success">
                                                                    <i class="bi bi-check-circle me-1"></i>
                                                                    {{ $stats['publicacoes_aprovadas'] ?? 0 }} Aprovadas
                                                                </small>
                                                            </div>
                                                            <div class="col-6">
                                                                <small class="text-warning">
                                                                    <i class="bi bi-clock me-1"></i>
                                                                    {{ $stats['publicacoes_pendentes'] ?? 0 }} Pendentes
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($user->role === 'tutorando')
                                            <!-- Taxa de Aprovação para Tutorandos -->
                                            <div class="col-md-6 mb-4">
                                                <div class="stat-card bg-info-soft p-4 rounded-3">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            @php
                                                                $total = $stats['total_projetos'] ?? 0;
                                                                $aprovados = $stats['projetos_aprovados'] ?? 0;
                                                                $taxa = $total > 0 ? round(($aprovados / $total) * 100) : 0;
                                                            @endphp
                                                            <h3 class="mb-1 text-info fw-bold">{{ $taxa }}%</h3>
                                                            <p class="mb-0 text-muted">Taxa de Aprovação</p>
                                                        </div>
                                                        <div class="stat-icon">
                                                            <i class="bi bi-graph-up text-info fs-1"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Ações Rápidas -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h6 class="mb-3 text-muted">Ações Rápidas</h6>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ route('projetos.index') }}" class="btn btn-outline-primary">
                                                    <i class="bi bi-folder me-2"></i>Meus Projetos
                                                </a>
                                                
                                                <a href="{{ route('projetos.create') }}" class="btn btn-outline-success">
                                                    <i class="bi bi-plus-circle me-2"></i>Novo Projeto
                                                </a>

                                                @if($user->role === 'tutor')
                                                    <a href="{{ route('publicacoes.index') }}" class="btn btn-outline-info">
                                                        <i class="bi bi-journal-text me-2"></i>Minhas Publicações
                                                    </a>
                                                    
                                                    <a href="{{ route('publicacoes.create') }}" class="btn btn-outline-warning">
                                                        <i class="bi bi-plus-circle me-2"></i>Nova Publicação
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Para usuários admin ou outros roles -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-bottom-0">
                                    <h5 class="card-title mb-0">
                                        <i class="bi bi-gear text-primary me-2"></i>Painel de Controle
                                    </h5>
                                </div>
                                <div class="card-body text-center py-5">
                                    <i class="bi bi-shield-check text-muted fs-1 mb-3"></i>
                                    <h5 class="text-muted">Acesso Administrativo</h5>
                                    <p class="text-muted mb-4">Como administrador, você tem acesso ao painel de gestão completo do sistema.</p>
                                    @if($user->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                                            <i class="bi bi-speedometer2 me-2"></i>Ir para Admin Dashboard
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-primary-soft {
            background-color: rgba(102, 126, 234, 0.1) !important;
        }

        .bg-success-soft {
            background-color: rgba(40, 167, 69, 0.1) !important;
        }

        .bg-info-soft {
            background-color: rgba(23, 162, 184, 0.1) !important;
        }

        .bg-warning-soft {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }

        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .avatar {
            width: 80px;
            height: 80px;
        }

        .info-item {
            border-bottom: 1px solid #f1f3f4;
            padding-bottom: 0.75rem;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .stat-icon {
            opacity: 0.7;
        }

        .card {
            border-radius: 15px;
        }

        .btn {
            border-radius: 8px;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
    </style>
</x-app-layout>
