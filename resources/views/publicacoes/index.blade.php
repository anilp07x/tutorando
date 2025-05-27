<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ __('My Publications') }}</h1>
                    <a href="{{ route('publicacoes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> {{ __('New Publication') }}
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($publicacoes->isEmpty())
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-journal-x display-1 text-muted"></i>
                            <h3 class="mt-3">{{ __('No publications yet') }}</h3>
                            <p class="text-muted">{{ __('Start by creating your first academic publication') }}</p>
                            <a href="{{ route('publicacoes.create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-plus-circle me-1"></i> {{ __('Create Publication') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Type') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($publicacoes as $publicacao)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3">
                                                            @if($publicacao->tipo == 'livro')
                                                                <i class="bi bi-book text-primary fs-4"></i>
                                                            @elseif($publicacao->tipo == 'artigo')
                                                                <i class="bi bi-file-text text-info fs-4"></i>
                                                            @elseif($publicacao->tipo == 'vídeo')
                                                                <i class="bi bi-camera-video text-danger fs-4"></i>
                                                            @elseif($publicacao->tipo == 'curso')
                                                                <i class="bi bi-mortarboard text-success fs-4"></i>
                                                            @else
                                                                <i class="bi bi-journal-text text-warning fs-4"></i>
                                                            @endif
                                                        </div>
                                                        <div>{{ $publicacao->titulo }}</div>
                                                    </div>
                                                </td>
                                                <td>{{ ucfirst($publicacao->tipo) }}</td>
                                                <td>{{ $publicacao->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $publicacao->aprovado ? 'success' : 'warning' }}">
                                                        {{ $publicacao->aprovado ? __('Approved') : __('Pending') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('publicacoes.show', $publicacao) }}" class="btn btn-sm btn-info">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('publicacoes.edit', $publicacao) }}" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $publicacao->id }}">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                    
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal-{{ $publicacao->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $publicacao->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $publicacao->id }}">{{ __('Confirm Deletion') }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{ __('Are you sure you want to delete this publication?') }} <strong>{{ $publicacao->titulo }}</strong>?
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
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-center mt-4">
                                {{ $publicacoes->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
