<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center py-3">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-person-circle me-2 text-primary"></i>
                Perfil do Tutor
            </h2>
            <a href="{{ route('tutores.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i>Voltar à Lista
            </a>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row">
            <!-- Coluna Principal - Perfil do Tutor -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <!-- Avatar -->
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}&size=120&background=007bff&color=fff" 
                             class="rounded-circle mb-3" width="120" height="120" alt="{{ $tutor->name }}">
                        
                        <!-- Informações Básicas -->
                        <h4 class="fw-bold mb-2">{{ $tutor->name }}</h4>
                        <p class="text-muted mb-3">{{ $tutor->curso }}</p>
                        
                        @if($tutor->instituicao)
                            <div class="mb-3">
                                <i class="bi bi-building me-2 text-primary"></i>
                                <span class="fw-medium">{{ $tutor->instituicao->nome }}</span>
                            </div>
                        @endif

                        <!-- Informações de Contato -->
                        <div class="border-top pt-3 mb-3">
                            <div class="row text-center">
                                <div class="col-12 mb-2">
                                    <i class="bi bi-envelope me-2 text-muted"></i>
                                    <span class="small">{{ $tutor->email }}</span>
                                </div>
                                @if($tutor->telefone)
                                    <div class="col-12 mb-2">
                                        <i class="bi bi-telephone me-2 text-muted"></i>
                                        <span class="small">{{ $tutor->telefone }}</span>
                                    </div>
                                @endif
                                @if($tutor->pais)
                                    <div class="col-12">
                                        <i class="bi bi-geo-alt me-2 text-muted"></i>
                                        <span class="small">{{ $tutor->pais }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Estatísticas -->
                        <div class="border-top pt-3">
                            <div class="row">
                                <div class="col-4">
                                    <div class="text-center">
                                        <div class="h5 mb-0 text-primary">{{ $stats['total_projetos'] }}</div>
                                        <small class="text-muted">Projetos</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-center border-start border-end">
                                        <div class="h5 mb-0 text-success">{{ $stats['total_publicacoes'] }}</div>
                                        <small class="text-muted">Publicações</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="text-center">
                                        <div class="h5 mb-0 text-info">{{ $stats['membro_desde']->diffInMonths(now()) }}</div>
                                        <small class="text-muted">Meses ativo</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Membro desde -->
                        <div class="border-top pt-3 mt-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>
                                Membro desde {{ $stats['membro_desde']->format('F \\d\\e Y') }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Bio do Tutor -->
                @if($tutor->bio)
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-info-circle me-2 text-primary"></i>
                                Sobre o Tutor
                            </h6>
                            <p class="text-muted mb-0">{{ $tutor->bio }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Coluna Secundária - Projetos e Publicações -->
            <div class="col-lg-8">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs border-0 mb-4" id="tutorTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-medium" id="projetos-tab" data-bs-toggle="tab" 
                                data-bs-target="#projetos" type="button" role="tab">
                            <i class="bi bi-folder me-2"></i>
                            Projetos ({{ $stats['total_projetos'] }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-medium" id="publicacoes-tab" data-bs-toggle="tab" 
                                data-bs-target="#publicacoes" type="button" role="tab">
                            <i class="bi bi-journal-text me-2"></i>
                            Publicações ({{ $stats['total_publicacoes'] }})
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="tutorTabsContent">
                    <!-- Projetos Tab -->
                    <div class="tab-pane fade show active" id="projetos" role="tabpanel" aria-labelledby="projetos-tab">
                        @if($projetos->count() > 0)
                            <div class="row g-4">
                                @foreach($projetos as $projeto)
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-2">{{ $projeto->titulo }}</h6>
                                                <p class="text-muted small mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                    {{ $projeto->descricao }}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        <i class="bi bi-calendar me-1"></i>
                                                        {{ $projeto->created_at->format('d/m/Y') }}
                                                    </small>
                                                    <a href="{{ route('projetos.show', $projeto) }}" class="btn btn-sm btn-outline-primary">
                                                        Ver Detalhes
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Paginação Projetos -->
                            @if($projetos->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $projetos->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-folder display-1 text-muted mb-3"></i>
                                <h5 class="text-muted">Nenhum projeto publicado</h5>
                                <p class="text-muted">Este tutor ainda não publicou nenhum projeto.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Publicações Tab -->
                    <div class="tab-pane fade" id="publicacoes" role="tabpanel" aria-labelledby="publicacoes-tab">
                        @if($publicacoes->count() > 0)
                            <div class="row g-4">
                                @foreach($publicacoes as $publicacao)
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h6 class="fw-bold mb-0">{{ $publicacao->titulo }}</h6>
                                                    <span class="badge bg-primary">{{ ucfirst($publicacao->tipo) }}</span>
                                                </div>
                                                <p class="text-muted small mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                    {{ $publicacao->descricao }}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        <i class="bi bi-calendar me-1"></i>
                                                        {{ $publicacao->created_at->format('d/m/Y') }}
                                                    </small>
                                                    <a href="{{ route('publicacoes.show', $publicacao) }}" class="btn btn-sm btn-outline-success">
                                                        Ver Detalhes
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Paginação Publicações -->
                            @if($publicacoes->hasPages())
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $publicacoes->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-journal-text display-1 text-muted mb-3"></i>
                                <h5 class="text-muted">Nenhuma publicação disponível</h5>
                                <p class="text-muted">Este tutor ainda não publicou nenhum conteúdo académico.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .nav-tabs .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            background: none;
            color: #6c757d;
            padding: 0.75rem 1rem;
        }
        
        .nav-tabs .nav-link.active {
            color: #007bff;
            border-bottom-color: #007bff;
            background: none;
        }
        
        .nav-tabs .nav-link:hover {
            color: #007bff;
            border-bottom-color: #007bff;
        }
        
        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
    </style>
</x-app-layout>
