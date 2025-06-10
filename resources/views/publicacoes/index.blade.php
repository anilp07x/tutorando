<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">Minhas Publicações</h1>
                    <a href="{{ route('publicacoes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Nova Publicação
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
                            <h3 class="mt-3">Nenhuma publicação ainda</h3>
                            <p class="text-muted">Comece criando sua primeira publicação académica</p>
                            <a href="{{ route('publicacoes.create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-plus-circle me-1"></i> Criar Publicação
                            </a>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Tipo</th>
                                            <th>Data</th>
                                            <th>Estado</th>
                                            <th>Ações</th>
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
                                                                <i class="bi bi-file-text text-primary fs-4"></i>
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
                                                        {{ $publicacao->aprovado ? 'Aprovado' : 'Pendente' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('publicacoes.show', $publicacao) }}" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('publicacoes.edit', $publicacao) }}" class="btn btn-sm btn-outline-primary">
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
                                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $publicacao->id }}">Confirmar Exclusão</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Tem certeza de que deseja excluir esta publicação? <strong>{{ $publicacao->titulo }}</strong>?
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
