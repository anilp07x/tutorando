<x-app-layout>
    <x-slot name="title">
        Gestão de Instituições
    </x-slot>
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">
                        <i class="bi bi-building me-2"></i>
                        Gestão de Instituições
                    </h1>
                    <a href="{{ route('admin.instituicoes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Nova Instituição
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Statistics Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-building text-primary fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Total</h6>
                                        <h4 class="mb-0 fw-bold">{{ $instituicoes->total() }}</h4>
                                        <p class="text-muted mb-0 small">instituições</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-mortarboard text-success fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Ensino Superior</h6>
                                        <h4 class="mb-0 fw-bold">{{ \App\Models\Instituicao::where('tipo', 'superior')->count() }}</h4>
                                        <p class="text-muted mb-0 small">instituições</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-gear text-primary fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Técnico</h6>
                                        <h4 class="mb-0 fw-bold">{{ \App\Models\Instituicao::where('tipo', 'técnico')->count() }}</h4>
                                        <p class="text-muted mb-0 small">instituições</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                                            <i class="bi bi-people text-warning fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Total Usuários</h6>
                                        <h4 class="mb-0 fw-bold">{{ \App\Models\User::whereNotNull('instituicao_id')->count() }}</h4>
                                        <p class="text-muted mb-0 small">vinculados</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-table me-2"></i>
                            Lista de Instituições
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3">ID</th>
                                        <th class="py-3">Nome</th>
                                        <th class="py-3">Tipo</th>
                                        <th class="py-3">Localização</th>
                                        <th class="py-3 text-center">Usuários</th>
                                        <th class="py-3">Criada em</th>
                                        <th class="py-3 text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($instituicoes as $instituicao)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <span class="badge bg-light text-dark">{{ $instituicao->id }}</span>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-initial bg-primary bg-opacity-10 rounded me-3">
                                                        <i class="bi bi-building text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $instituicao->nome }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <span class="badge bg-{{ $instituicao->tipo == 'superior' ? 'primary' : ($instituicao->tipo == 'técnico' ? 'success' : 'info') }}">
                                                    <i class="bi bi-{{ $instituicao->tipo == 'superior' ? 'mortarboard' : ($instituicao->tipo == 'técnico' ? 'gear' : 'book') }} me-1"></i>
                                                    {{ ucfirst($instituicao->tipo) }}
                                                </span>
                                            </td>
                                            <td class="py-3">
                                                <i class="bi bi-geo-alt text-muted me-1"></i>
                                                {{ $instituicao->localizacao }}
                                            </td>
                                            <td class="py-3 text-center">
                                                <span class="badge bg-light text-dark">
                                                    {{ $instituicao->users->count() }}
                                                </span>
                                            </td>
                                            <td class="py-3">
                                                <small class="text-muted">{{ $instituicao->created_at->format('d/m/Y H:i') }}</small>
                                            </td>
                                            <td class="py-3 text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.instituicoes.show', $instituicao) }}" 
                                                       class="btn btn-sm btn-outline-primary" 
                                                       data-bs-toggle="tooltip" 
                                                       title="Ver Detalhes">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.instituicoes.edit', $instituicao) }}" 
                                                       class="btn btn-sm btn-outline-primary"
                                                       data-bs-toggle="tooltip" 
                                                       title="Editar">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteModal-{{ $instituicao->id }}"
                                                            title="Excluir">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                                
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal-{{ $instituicao->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $instituicao->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel-{{ $instituicao->id }}">Confirmar Exclusão</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Tem certeza que deseja excluir a instituição <strong>{{ $instituicao->nome }}</strong>?</p>
                                                                
                                                                @if($instituicao->users->count() > 0)
                                                                    <div class="alert alert-warning">
                                                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                                                        Esta instituição possui usuários associados. A exclusão pode não ser possível.
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                <form action="{{ route('admin.instituicoes.destroy', $instituicao) }}" method="POST" class="d-inline">
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
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="d-flex justify-content-center">
                            {{ $instituicoes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
