<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ __('My Projects') }}</h1>
                    <a href="{{ route('projetos.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> {{ __('New Project') }}
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($projetos->isEmpty())
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-folder-x display-1 text-muted"></i>
                            <h3 class="mt-3">{{ __('No projects yet') }}</h3>
                            <p class="text-muted">{{ __('Start by creating your first project') }}</p>
                            <a href="{{ route('projetos.create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-plus-circle me-1"></i> {{ __('Create Project') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="row">
                        @foreach($projetos as $projeto)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">{{ $projeto->titulo }}</h5>
                                        <span class="badge bg-{{ $projeto->aprovado ? 'success' : 'warning' }}">
                                            {{ $projeto->aprovado ? __('Approved') : __('Pending') }}
                                        </span>
                                    </div>
                                    
                                    @if($projeto->imagens)
                                        <div id="carousel-{{ $projeto->id }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($projeto->imagens as $index => $imagem)
                                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                        <img src="{{ Storage::url($imagem) }}" class="d-block w-100" 
                                                             style="height: 200px; object-fit: cover;" alt="{{ $projeto->titulo }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                            @if(count($projeto->imagens) > 1)
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $projeto->id }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $projeto->id }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            @endif
                                        </div>
                                    @else
                                        <div class="bg-light text-center py-5">
                                            <i class="bi bi-image text-muted display-4"></i>
                                        </div>
                                    @endif
                                    
                                    <div class="card-body">
                                        <p class="card-text">{{ Str::limit($projeto->descricao, 100) }}</p>
                                        <div class="d-flex mt-3">
                                            @if($projeto->youtube_link)
                                                <a href="{{ $projeto->youtube_link }}" target="_blank" class="btn btn-sm btn-danger me-2">
                                                    <i class="bi bi-youtube"></i>
                                                </a>
                                            @endif
                                            
                                            @if($projeto->arquivo_pdf)
                                                <a href="{{ Storage::url($projeto->arquivo_pdf) }}" target="_blank" class="btn btn-sm btn-danger me-2">
                                                    <i class="bi bi-file-pdf"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer bg-white">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">{{ $projeto->created_at->format('d/m/Y') }}</small>
                                            <div class="btn-group">
                                                <a href="{{ route('projetos.show', $projeto) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('projetos.edit', $projeto) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $projeto->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal-{{ $projeto->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $projeto->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-{{ $projeto->id }}">{{ __('Confirm Deletion') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ __('Are you sure you want to delete this project?') }} <strong>{{ $projeto->titulo }}</strong>?
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
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $projetos->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
