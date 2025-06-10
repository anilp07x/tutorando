<x-app-layout>
    <x-slot name="title">
        Gestão de Projetos
    </x-slot>
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">Gestão de Projetos</h1>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <form action="{{ route('admin.projetos.index') }}" method="GET" class="row g-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="search" placeholder="Buscar por título" value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="status">
                                    <option value="">Todos os Status</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aprovado</option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pendente</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="user_id">
                                    <option value="">Todos os Usuários</option>
                                    @foreach(App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="d-grid gap-2 d-md-block">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <a href="{{ route('admin.projetos.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Lista de Projetos</h5>
                        <span class="badge bg-primary">{{ $projetos->total() }} projetos</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <form id="bulkActionForm" method="POST">
                                @csrf
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                        <label for="selectAll" class="form-check-label">Selecionar Todos</label>
                                    </div>
                                    <div class="btn-group" id="bulkActions" style="display: none;">
                                        <button type="button" class="btn btn-success btn-sm" onclick="bulkAction('approve')">
                                            <i class="bi bi-check-lg"></i> Aprovar em Massa
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="bulkAction('reject')">
                                            <i class="bi bi-x-lg"></i> Rejeitar em Massa
                                        </button>
                                    </div>
                                </div>
                                
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="40">
                                                <input type="checkbox" id="selectAllTable" class="form-check-input">
                                            </th>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Autor</th>
                                            <th>Criado em</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($projetos as $projeto)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="projeto_ids[]" value="{{ $projeto->id }}" class="form-check-input projeto-checkbox">
                                                </td>
                                                <td>{{ $projeto->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            @if($projeto->imagens && count($projeto->imagens) > 0)
                                                                <img src="{{ asset('storage/' . $projeto->imagens[0]) }}" class="rounded" width="50" height="50" alt="{{ $projeto->titulo }}">
                                                            @else
                                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                                    <i class="bi bi-file-earmark-text text-secondary fs-4"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ms-3">
                                                            <h6 class="mb-0">{{ Str::limit($projeto->titulo, 40) }}</h6>
                                                            <small class="text-muted">{{ Str::limit($projeto->descricao, 60) }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-{{ $projeto->user->role == 'admin' ? 'danger' : ($projeto->user->role == 'tutor' ? 'success' : 'info') }} me-2">
                                                            {{ ucfirst($projeto->user->role) }}
                                                        </span>
                                                        {{ $projeto->user->name }}
                                                    </div>
                                                </td>
                                                <td>{{ $projeto->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    @if($projeto->aprovado)
                                                        <span class="badge bg-success">{{ __('Approved') }}</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.projetos.show', $projeto) }}" class="btn btn-sm btn-primary" title="Ver Detalhes">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        
                                                        @if(!$projeto->aprovado)
                                                            <form action="{{ route('admin.projetos.approve', $projeto) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm btn-success" title="Aprovar">
                                                                    <i class="bi bi-check-lg"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('admin.projetos.reject', $projeto) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm btn-warning" title="Rejeitar">
                                                                    <i class="bi bi-x-lg"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        
                                                        <a href="{{ route('projetos.show', $projeto) }}" class="btn btn-sm btn-outline-primary" title="Ver Público" target="_blank">
                                                            <i class="bi bi-box-arrow-up-right"></i>
                                                        </a>
                                                        
                                                        <button type="button" class="btn btn-sm btn-danger" title="Excluir" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $projeto->id }}">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                    
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal-{{ $projeto->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $projeto->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $projeto->id }}">Confirmar Exclusão</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Tem certeza que deseja excluir este projeto?</p>
                                                                    <div class="alert alert-warning">
                                                                        <strong>{{ $projeto->titulo }}</strong><br>
                                                                        <small>Autor: {{ $projeto->user->name }}</small>
                                                                    </div>
                                                                    <p class="text-danger"><small>Esta ação não pode ser desfeita.</small></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <form action="{{ route('admin.projetos.destroy', $projeto) }}" method="POST" class="d-inline">
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
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <i class="bi bi-folder-x text-secondary" style="font-size: 3rem;"></i>
                                                        <h5 class="mt-3">Nenhum projeto encontrado</h5>
                                                        <p class="text-muted">Nenhum projeto corresponde aos seus critérios de busca.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4 mb-2">
                            {{ $projetos->links() }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Action Confirmation Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1" aria-labelledby="bulkActionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkActionModalLabel">Confirmar Ação em Massa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="bulkActionMessage"></p>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Esta ação afetará os projetos selecionados e enviará emails de notificação aos autores.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="confirmBulkAction">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Bulk selection functionality
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.projeto-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    toggleBulkActions();
});

document.getElementById('selectAllTable').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.projeto-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    toggleBulkActions();
});

document.querySelectorAll('.projeto-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', toggleBulkActions);
});

function toggleBulkActions() {
    const checked = document.querySelectorAll('.projeto-checkbox:checked');
    const bulkActions = document.getElementById('bulkActions');
    bulkActions.style.display = checked.length > 0 ? 'block' : 'none';
}

function bulkAction(action) {
    const checked = document.querySelectorAll('.projeto-checkbox:checked');
    if (checked.length === 0) {
        alert('{{ __("Please select at least one project.") }}');
        return;
    }

    const actionText = action === 'approve' ? '{{ __("approve") }}' : '{{ __("reject") }}';
    document.getElementById('bulkActionMessage').textContent = 
        `{{ __("Are you sure you want to") }} ${actionText} ${checked.length} {{ __("selected projects?") }}`;
    
    document.getElementById('confirmBulkAction').onclick = function() {
        const form = document.getElementById('bulkActionForm');
        form.action = `{{ route('admin.projetos.bulk-action') }}`;
        form.method = 'POST';
        
        // Add action input
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = action;
        form.appendChild(actionInput);
        
        form.submit();
    };
    
    new bootstrap.Modal(document.getElementById('bulkActionModal')).show();
}
</script>
</x-app-layout>
