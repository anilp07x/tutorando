<x-app-layout>
    <x-slot name="title">
        Detalhes da Publicação
    </x-slot>
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <a href="{{ route('admin.publicacoes.index') }}" class="btn btn-outline-secondary mb-3">
                            <i class="bi bi-arrow-left me-1"></i> Voltar para Publicações
                        </a>
                        <h1 class="fw-bold text-primary">{{ $publicacao->titulo }}</h1>
                    </div>
                    <div>
                        @if(!$publicacao->aprovado)
                            <form action="{{ route('admin.publicacoes.approve', $publicacao) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="approved" value="1">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg me-1"></i> {{ __('Approve Publication') }}
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.publicacoes.approve', $publicacao) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="approved" value="0">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-x-lg me-1"></i> {{ __('Disapprove Publication') }}
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
                            <div class="card-header bg-white d-flex align-items-center">
                                <div class="bg-{{ 
                                    $publicacao->tipo == 'livro' ? 'primary' : 
                                    ($publicacao->tipo == 'artigo' ? 'info' : 
                                    ($publicacao->tipo == 'video' ? 'danger' : 
                                    ($publicacao->tipo == 'curso' ? 'success' : 'warning'))) 
                                }} bg-opacity-10 p-2 rounded me-2">
                                    <i class="bi bi-{{ 
                                        $publicacao->tipo == 'livro' ? 'book' : 
                                        ($publicacao->tipo == 'artigo' ? 'file-text' : 
                                        ($publicacao->tipo == 'video' ? 'camera-video' : 
                                        ($publicacao->tipo == 'curso' ? 'mortarboard' : 'journal-text'))) 
                                    }} text-{{ 
                                        $publicacao->tipo == 'livro' ? 'primary' : 
                                        ($publicacao->tipo == 'artigo' ? 'info' : 
                                        ($publicacao->tipo == 'video' ? 'danger' : 
                                        ($publicacao->tipo == 'curso' ? 'success' : 'warning'))) 
                                    }} fs-4"></i>
                                </div>
                                <h5 class="mb-0">{{ __('Publication Details') }} - 
                                    <span class="badge bg-{{ 
                                        $publicacao->tipo == 'livro' ? 'primary' : 
                                        ($publicacao->tipo == 'artigo' ? 'info' : 
                                        ($publicacao->tipo == 'video' ? 'danger' : 
                                        ($publicacao->tipo == 'curso' ? 'success' : 'warning'))) 
                                    }}">
                                        {{ ucfirst($publicacao->tipo) }}
                                    </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h5>{{ __('Description') }}</h5>
                                    <p class="text-muted">{{ $publicacao->descricao }}</p>
                                </div>
                                
                                @if($publicacao->conteudo_url)
                                    <div>
                                        <h5>{{ __('Content') }}</h5>
                                        @if(Str::startsWith($publicacao->conteudo_url, 'http'))
                                            <!-- External URL -->
                                            @if($publicacao->tipo == 'video' && (Str::contains($publicacao->conteudo_url, 'youtube') || Str::contains($publicacao->conteudo_url, 'youtu.be')))
                                                <div class="ratio ratio-16x9 mb-3">
                                                    <iframe src="{{ str_replace(['watch?v=', 'youtu.be/'], ['embed/', 'youtube.com/embed/'], $publicacao->conteudo_url) }}" title="YouTube video" allowfullscreen></iframe>
                                                </div>
                                            @endif
                                            <a href="{{ $publicacao->conteudo_url }}" target="_blank" class="btn btn-primary">
                                                <i class="bi bi-box-arrow-up-right me-1"></i> {{ __('Access Content') }}
                                            </a>
                                        @else
                                            <!-- Local file -->
                                            @php
                                                $extension = pathinfo(storage_path('app/public/' . $publicacao->conteudo_url), PATHINFO_EXTENSION);
                                                $icon = match($extension) {
                                                    'pdf' => 'file-earmark-pdf',
                                                    'doc', 'docx' => 'file-earmark-word',
                                                    'ppt', 'pptx' => 'file-earmark-slides',
                                                    'zip', 'rar' => 'file-earmark-zip',
                                                    default => 'file-earmark'
                                                };
                                            @endphp
                                            <a href="{{ asset('storage/' . $publicacao->conteudo_url) }}" target="_blank" class="btn btn-primary">
                                                <i class="bi bi-{{ $icon }} me-1"></i> {{ __('Download File') }}
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        {{ __('No content file or URL provided for this publication.') }}
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
                                        <h5 class="mb-0">{{ $publicacao->user->name }}</h5>
                                        <p class="text-muted mb-0">
                                            <span class="badge bg-{{ $publicacao->user->role == 'admin' ? 'danger' : ($publicacao->user->role == 'tutor' ? 'success' : 'info') }}">
                                                {{ ucfirst($publicacao->user->role) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="mb-1"><strong>{{ __('Email') }}:</strong></p>
                                    <p class="text-muted">{{ $publicacao->user->email }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="mb-1"><strong>{{ __('Course') }}:</strong></p>
                                    <p class="text-muted">{{ $publicacao->user->curso ?? 'N/A' }}</p>
                                </div>
                                
                                <div>
                                    <p class="mb-1"><strong>{{ __('Institution') }}:</strong></p>
                                    <p class="text-muted">{{ $publicacao->user->instituicao->nome ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">{{ __('Publication Status') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <p class="mb-1"><strong>{{ __('Status') }}:</strong></p>
                                    <p>
                                        @if($publicacao->aprovado)
                                            <span class="badge bg-success">{{ __('Approved') }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark">{{ __('Pending Approval') }}</span>
                                        @endif
                                    </p>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="mb-1"><strong>{{ __('Created on') }}:</strong></p>
                                    <p class="text-muted">{{ $publicacao->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                
                                <div>
                                    <p class="mb-1"><strong>{{ __('Last updated') }}:</strong></p>
                                    <p class="text-muted">{{ $publicacao->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                                
                                <div class="mt-4">
                                    <a href="{{ route('publicacoes.edit', $publicacao) }}" class="btn btn-primary w-100 mb-2">
                                        <i class="bi bi-pencil me-1"></i> {{ __('Edit Publication') }}
                                    </a>
                                    
                                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="bi bi-trash me-1"></i> {{ __('Delete Publication') }}
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
                    <p>{{ __('Are you sure you want to delete this publication?') }}</p>
                    <p><strong>{{ $publicacao->titulo }}</strong></p>
                    
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ __('This action cannot be undone. All files associated with this publication will be permanently deleted.') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <form action="{{ route('publicacoes.destroy', $publicacao) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
