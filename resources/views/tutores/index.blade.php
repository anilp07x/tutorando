<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold py-3">
            <i class="bi bi-people me-2 text-primary"></i>
            Encontrar Tutores
        </h2>
    </x-slot>

    <div class="container py-4">
        <!-- Filtros de Pesquisa -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('tutores.index') }}" class="row g-3">
                    <div class="col-md-5">
                        <label for="search" class="form-label">Pesquisar por nome ou área</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ $search }}" placeholder="Digite nome ou área de especialização">
                    </div>
                    <div class="col-md-4">
                        <label for="curso" class="form-label">Filtrar por curso</label>
                        <select class="form-select" id="curso" name="curso">
                            <option value="">Todos os cursos</option>
                            @foreach($cursos as $cursoItem)
                                <option value="{{ $cursoItem }}" {{ $curso == $cursoItem ? 'selected' : '' }}>
                                    {{ $cursoItem }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-search me-1"></i>Pesquisar
                        </button>
                        <a href="{{ route('tutores.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise me-1"></i>Limpar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Resultados -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        {{ $tutors->total() }} tutores encontrados
                        @if($search || $curso)
                            <small class="text-muted">
                                - Filtros aplicados: 
                                @if($search)<strong>{{ $search }}</strong>@endif
                                @if($search && $curso), @endif
                                @if($curso)<strong>{{ $curso }}</strong>@endif
                            </small>
                        @endif
                    </h5>
                    <div class="small text-muted">
                        Página {{ $tutors->currentPage() }} de {{ $tutors->lastPage() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Tutores -->
        @if($tutors->count() > 0)
            <div class="row g-4">
                @foreach($tutors as $tutor)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 tutor-card">
                            <div class="card-body p-4">
                                <!-- Avatar e Info Básica -->
                                <div class="text-center mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}&size=80&background=007bff&color=fff" 
                                         class="rounded-circle mb-3" width="80" height="80" alt="{{ $tutor->name }}">
                                    <h5 class="card-title mb-1">{{ $tutor->name }}</h5>
                                    <p class="text-muted small mb-2">{{ $tutor->curso }}</p>
                                    @if($tutor->instituicao)
                                        <p class="text-muted small mb-0">
                                            <i class="bi bi-building me-1"></i>{{ $tutor->instituicao->nome }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Estatísticas -->
                                <div class="row text-center mb-3">
                                    <div class="col-6">
                                        <div class="border-end">
                                            <div class="h6 mb-0 text-primary">{{ $tutor->projetos_count ?? 0 }}</div>
                                            <small class="text-muted">Projetos</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="h6 mb-0 text-success">{{ $tutor->publicacoes_count ?? 0 }}</div>
                                        <small class="text-muted">Publicações</small>
                                    </div>
                                </div>

                                <!-- Bio (se disponível) -->
                                @if($tutor->bio)
                                    <p class="text-muted small mb-3" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ $tutor->bio }}
                                    </p>
                                @endif

                                <!-- Ações -->
                                <div class="d-grid gap-2">
                                    <a href="{{ route('tutores.show', $tutor) }}" class="btn btn-primary">
                                        <i class="bi bi-person-lines-fill me-1"></i>Ver Perfil Completo
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Rodapé do Card -->
                            <div class="card-footer bg-light border-0 text-center">
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>Membro desde {{ $tutor->created_at->format('M/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="d-flex justify-content-center mt-5">
                {{ $tutors->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Estado Vazio -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-search display-1 text-muted"></i>
                </div>
                <h4 class="text-muted">Nenhum tutor encontrado</h4>
                <p class="text-muted mb-4">
                    @if($search || $curso)
                        Tente ajustar os filtros de pesquisa para encontrar mais tutores.
                    @else
                        Não há tutores disponíveis no momento.
                    @endif
                </p>
                @if($search || $curso)
                    <a href="{{ route('tutores.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-clockwise me-1"></i>Ver Todos os Tutores
                    </a>
                @endif
            </div>
        @endif
    </div>

    <style>
        .tutor-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        
        .tutor-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #0056b3, #004085);
        }
    </style>
</x-app-layout>