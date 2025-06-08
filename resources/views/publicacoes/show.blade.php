<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ $publicacao->titulo }}</h1>
                    <div>
                        <a href="{{ route('publicacoes.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i> Voltar às Publicações
                        </a>
                        @if(Auth::id() === $publicacao->user_id || Auth::user()->role === 'admin')
                            <a href="{{ route('publicacoes.edit', $publicacao) }}" class="btn btn-primary">
                                <i class="bi bi-pencil me-1"></i> Editar
                            </a>
                        @endif
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Detalhes da Publicação</h5>
                            <span class="badge bg-{{ $publicacao->aprovado ? 'success' : 'warning' }}">
                                {{ $publicacao->aprovado ? 'Aprovado' : 'Pendente de Aprovação' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{ $publicacao->titulo }}</h3>
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <span class="badge bg-primary">{{ ucfirst($publicacao->tipo) }}</span>
                                    </div>
                                    <div class="me-3">
                                        <small class="text-muted">
                                            <i class="bi bi-person me-1"></i> {{ $publicacao->user->name }}
                                        </small>
                                    </div>
                                    <div>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar me-1"></i> {{ $publicacao->created_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <h5>Descrição</h5>
                                    <p>{{ $publicacao->descricao }}</p>
                                </div>
                                
                                <div class="mb-4">
                                    <h5>Aceder ao Conteúdo</h5>
                                    @if(filter_var($publicacao->conteudo_url, FILTER_VALIDATE_URL))
                                        <!-- External URL Content -->
                                        @if(str_contains($publicacao->conteudo_url, 'youtube.com') || str_contains($publicacao->conteudo_url, 'youtu.be'))
                                            <div class="ratio ratio-16x9 mb-3">
                                                <iframe 
                                                    src="{{ str_replace(['watch?v=', 'youtu.be/'], ['embed/', 'youtube.com/embed/'], $publicacao->conteudo_url) }}" 
                                                    title="YouTube video" 
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                        @endif
                                        <a href="{{ $publicacao->conteudo_url }}" target="_blank" class="btn btn-primary">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Abrir Conteúdo Externo
                                        </a>
                                    @else
                                        <!-- File Content -->
                                        @php
                                            $extension = pathinfo($publicacao->conteudo_url, PATHINFO_EXTENSION);
                                        @endphp
                                        
                                        @if($extension == 'pdf')
                                            <div class="ratio ratio-16x9 mb-3">
                                                <embed src="{{ Storage::url($publicacao->conteudo_url) }}" type="application/pdf">
                                            </div>
                                        @endif
                                        
                                        <a href="{{ Storage::url($publicacao->conteudo_url) }}" target="_blank" class="btn btn-primary">
                                            <i class="bi bi-download me-1"></i> Descarregar Conteúdo
                                        </a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Informações do Autor</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <img 
                                                src="https://ui-avatars.com/api/?name={{ urlencode($publicacao->user->name) }}&background=007bff&color=fff" 
                                                class="rounded-circle me-2" 
                                                width="50" 
                                                height="50" 
                                                alt="{{ $publicacao->user->name }}">
                                            <div>
                                                <h6 class="mb-0">{{ $publicacao->user->name }}</h6>
                                                <span class="badge bg-{{ $publicacao->user->role === 'tutor' ? 'success' : 'info' }}">
                                                    {{ ucfirst($publicacao->user->role) }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-2">
                                            <strong>Curso:</strong> {{ $publicacao->user->curso }}
                                        </div>
                                        
                                        <div>
                                            <strong>Instituição:</strong> {{ $publicacao->user->instituicao->nome ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Tipo de Publicação</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($publicacao->tipo == 'livro')
                                                    <i class="bi bi-book text-primary fs-1"></i>
                                                @elseif($publicacao->tipo == 'artigo')
                                                    <i class="bi bi-file-text text-info fs-1"></i>
                                                @elseif($publicacao->tipo == 'vídeo')
                                                    <i class="bi bi-camera-video text-danger fs-1"></i>
                                                @elseif($publicacao->tipo == 'curso')
                                                    <i class="bi bi-mortarboard text-success fs-1"></i>
                                                @else
                                                    <i class="bi bi-journal-text text-warning fs-1"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h5 class="mb-0">{{ ucfirst($publicacao->tipo) }}</h5>
                                                <p class="text-muted mb-0">
                                                    @if($publicacao->tipo == 'livro')
                                                        Livro académico ou e-book
                                                    @elseif($publicacao->tipo == 'artigo')
                                                        Artigo de investigação ou académico
                                                    @elseif($publicacao->tipo == 'vídeo')
                                                        Conteúdo de vídeo educacional
                                                    @elseif($publicacao->tipo == 'curso')
                                                        Material de curso online
                                                    @else
                                                        Guia de estudo ou apontamentos
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if(Auth::user()->role === 'admin' && !$publicacao->aprovado)
                    <div class="card">
                        <div class="card-body">
                            <h5>Ações Administrativas</h5>
                            <form action="{{ route('admin.publicacoes.approve', $publicacao) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i> Aprovar Publicação
                                </button>
                            </form>
                            
                            <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-1"></i> Excluir Publicação
                            </button>
                        </div>
                    </div>
                    
                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de que deseja excluir esta publicação?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('publicacoes.destroy', $publicacao) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
