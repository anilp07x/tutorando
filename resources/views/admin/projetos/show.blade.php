<x-app-layout>
    <x-slot name="title">
        Detalhes do Projeto
    </x-slot>
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <a href="{{ route('admin.projetos.index') }}" class="btn btn-outline-secondary mb-3">
                            <i class="bi bi-arrow-left me-1"></i> Voltar para Projetos
                        </a>
                        <h1 class="fw-bold text-primary">{{ $projeto->titulo }}</h1>
                    </div>
                    <div>
                        @if(!$projeto->aprovado)
                            <form action="{{ route('admin.projetos.approve', $projeto) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="approved" value="1">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg me-1"></i> {{ __('Approve Project') }}
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.projetos.approve', $projeto) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="approved" value="0">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-x-lg me-1"></i> {{ __('Disapprove Project') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">{{ __('Project Details') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h3>{{ __('Description') }}</h3>
                                    <p class="text-muted">{{ $projeto->descricao }}</p>
                                </div>
                                
                                @if($projeto->imagens && count($projeto->imagens) > 0)
                                    <div class="mb-4">
                                        <h5>{{ __('Project Images') }}</h5>
                                        <div class="row g-3">
                                            @foreach($projeto->imagens as $imagem)
                                                <div class="col-6 col-md-4">
                                                    <a href="{{ asset('storage/' . $imagem) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $imagem) }}" alt="Imagem do projeto" class="img-fluid rounded">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                @if($projeto->youtube_link)
                                    <div class="mb-4">
                                        <h5>{{ __('Video Demo') }}</h5>
                                        <div class="ratio ratio-16x9">
                                            <iframe src="{{ str_replace('watch?v=', 'embed/', $projeto->youtube_link) }}" title="YouTube video" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($projeto->arquivo_pdf)
                                    <div>
                                        <h5>{{ __('Documentation (PDF)') }}</h5>
                                        <a href="{{ asset('storage/' . $projeto->arquivo_pdf) }}" target="_blank" class="btn btn-outline-primary">
                                            <i class="bi bi-file-earmark-pdf me-1"></i> {{ __('View PDF') }}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">{{ __('Author Information') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                        <i class="bi bi-person-circle text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">{{ $projeto->user->name }}</h5>
                                        <p class="text-muted mb-0">
                                            <span class="badge bg-{{ $projeto->user->role == 'admin' ? 'danger' : ($projeto->user->role == 'tutor' ? 'success' : 'info') }}">
                                                {{ ucfirst($projeto->user->role) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="mb-1"><strong>{{ __('Email') }}:</strong></p>
                                    <p class="text-muted">{{ $projeto->user->email }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="mb-1"><strong>{{ __('Course') }}:</strong></p>
                                    <p class="text-muted">{{ $projeto->user->curso ?? 'N/A' }}</p>
                                </div>
                                
                                <div>
                                    <p class="mb-1"><strong>{{ __('Institution') }}:</strong></p>
                                    <p class="text-muted">{{ $projeto->user->instituicao->nome ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">{{ __('Project Status') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <p class="mb-1"><strong>{{ __('Status') }}:</strong></p>
                                    <p>
                                        @if($projeto->aprovado)
                                            <span class="badge bg-success">{{ __('Approved') }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ __('Pending Approval') }}</span>
                                        @endif
                                    </p>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="mb-1"><strong>{{ __('Created on') }}:</strong></p>
                                    <p class="text-muted">{{ $projeto->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                
                                <div>
                                    <p class="mb-1"><strong>{{ __('Last updated') }}:</strong></p>
                                    <p class="text-muted">{{ $projeto->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                                
                                <div class="mt-4">
                                    <a href="{{ route('projetos.edit', $projeto) }}" class="btn btn-primary w-100 mb-2">
                                        <i class="bi bi-pencil me-1"></i> {{ __('Edit Project') }}
                                    </a>
                                    
                                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="bi bi-trash me-1"></i> {{ __('Delete Project') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Confirm Deletion') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure you want to delete this project?') }}</p>
                    <p><strong>{{ $projeto->titulo }}</strong></p>
                    
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ __('This action cannot be undone. All files associated with this project will be permanently deleted.') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <form action="{{ route('projetos.destroy', $projeto) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
