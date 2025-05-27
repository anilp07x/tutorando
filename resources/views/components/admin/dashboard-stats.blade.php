<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h6 class="card-title mb-1">Publicações</h6>
                        <h2 class="mb-0 fw-bold text-primary">{{ $stats['publicacoes']['total'] }}</h2>
                        <div class="small text-muted mt-2">
                            <span class="badge bg-success">{{ $stats['publicacoes']['aprovadas'] }} aprovadas</span>
                            <span class="badge bg-warning text-dark ms-1">{{ $stats['publicacoes']['pendentes'] }} pendentes</span>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-journals fs-3 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h6 class="card-title mb-1">Projetos</h6>
                        <h2 class="mb-0 fw-bold text-success">{{ $stats['projetos']['total'] }}</h2>
                        <div class="small text-muted mt-2">
                            <span class="badge bg-success">{{ $stats['projetos']['aprovados'] }} aprovados</span>
                            <span class="badge bg-warning text-dark ms-1">{{ $stats['projetos']['pendentes'] }} pendentes</span>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-kanban fs-3 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h6 class="card-title mb-1">Usuários</h6>
                        <h2 class="mb-0 fw-bold text-info">{{ $stats['users']['total'] }}</h2>
                        <div class="small text-muted mt-2">
                            <span class="badge bg-danger">{{ $stats['users']['admin'] }} admin</span>
                            <span class="badge bg-success ms-1">{{ $stats['users']['tutor'] }} tutores</span>
                            <span class="badge bg-info ms-1">{{ $stats['users']['aluno'] }} alunos</span>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-people fs-3 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h6 class="card-title mb-1">Instituições</h6>
                        <h2 class="mb-0 fw-bold text-warning">{{ $stats['instituicoes']['total'] }}</h2>
                        <div class="small text-muted mt-2">
                            <span class="badge bg-secondary">{{ $stats['instituicoes']['tecnico'] }} técnico</span>
                            <span class="badge bg-secondary ms-1">{{ $stats['instituicoes']['medio'] }} médio</span>
                            <span class="badge bg-secondary ms-1">{{ $stats['instituicoes']['superior'] }} superior</span>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-building fs-3 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
