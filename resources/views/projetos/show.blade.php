<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ $projeto->titulo }}</h1>
                    <div>
                        <a href="{{ route('projetos.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i> {{ __('Back to Projects') }}
                        </a>
                        @if(Auth::id() === $projeto->user_id || Auth::user()->role === 'admin')
                            <a href="{{ route('projetos.edit', $projeto) }}" class="btn btn-primary">
                                <i class="bi bi-pencil me-1"></i> {{ __('Edit') }}
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
                            <h5 class="mb-0">{{ __('Project Details') }}</h5>
                            <span class="badge bg-{{ $projeto->aprovado ? 'success' : 'warning' }}">
                                {{ $projeto->aprovado ? __('Approved') : __('Pending Approval') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{ $projeto->titulo }}</h3>
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <small class="text-muted">
                                            <i class="bi bi-person me-1"></i> {{ $projeto->user->name }}
                                        </small>
                                    </div>
                                    <div>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar me-1"></i> {{ $projeto->created_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <h5>{{ __('Description') }}</h5>
                                    <p>{{ $projeto->descricao }}</p>
                                </div>
                                
                                @if($projeto->youtube_link)
                                    <div class="mb-4">
                                        <h5>{{ __('Video') }}</h5>
                                        <div class="ratio ratio-16x9">
                                            <iframe 
                                                src="{{ str_replace('watch?v=', 'embed/', $projeto->youtube_link) }}" 
                                                title="YouTube video" 
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">{{ __('Author Information') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <img 
                                                src="https://ui-avatars.com/api/?name={{ urlencode($projeto->user->name) }}&background=007bff&color=fff" 
                                                class="rounded-circle me-2" 
                                                width="50" 
                                                height="50" 
                                                alt="{{ $projeto->user->name }}">
                                            <div>
                                                <h6 class="mb-0">{{ $projeto->user->name }}</h6>
                                                <span class="badge bg-{{ $projeto->user->role === 'tutor' ? 'success' : 'info' }}">
                                                    {{ ucfirst($projeto->user->role) }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-2">
                                            <strong>{{ __('Course') }}:</strong> {{ $projeto->user->curso }}
                                        </div>
                                        
                                        <div>
                                            <strong>{{ __('Institution') }}:</strong> {{ $projeto->user->instituicao->nome ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                
                                @if($projeto->arquivo_pdf)
                                    <div class="card mb-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">{{ __('PDF Document') }}</h6>
                                        </div>
                                        <div class="card-body text-center">
                                            <a href="{{ Storage::url($projeto->arquivo_pdf) }}" target="_blank" class="btn btn-danger">
                                                <i class="bi bi-file-pdf me-1"></i> {{ __('Download PDF') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($projeto->imagens)
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">{{ __('Project Images') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($projeto->imagens as $imagem)
                                    <div class="col-md-4 mb-3">
                                        <a href="{{ Storage::url($imagem) }}" data-lightbox="projeto-images" data-title="{{ $projeto->titulo }}">
                                            <img 
                                                src="{{ Storage::url($imagem) }}" 
                                                class="img-fluid rounded" 
                                                alt="{{ $projeto->titulo }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
                @if(Auth::user()->role === 'admin' && !$projeto->aprovado)
                    <div class="card">
                        <div class="card-body">
                            <h5>{{ __('Administrative Actions') }}</h5>
                            <form action="{{ route('admin.projetos.approve', $projeto) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i> {{ __('Approve Project') }}
                                </button>
                            </form>
                            
                            <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-1"></i> {{ __('Delete Project') }}
                            </button>
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
                                    {{ __('Are you sure you want to delete this project?') }}
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
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
