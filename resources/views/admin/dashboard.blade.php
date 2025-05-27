<x-app-layout>
    <x-slot name="title">
        Dashboard Administrativo
    </x-slot>
    
    <div class="container-fluid py-4">
        <!-- Quick Actions Sidebar and Main Content -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i class="bi bi-lightning-charge me-2"></i>
                            Ações Rápidas
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-grid gap-2">
                            <!-- Instituições -->
                            <h6 class="text-muted mb-2 mt-2">
                                <i class="bi bi-building me-1"></i> Instituições
                            </h6>
                            <a href="{{ route('admin.instituicoes.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-plus me-1"></i> Nova Instituição
                            </a>
                            <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-list me-1"></i> Listar Todas
                            </a>
                            
                            <!-- Projetos -->
                            <hr class="my-2">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-folder me-1"></i> Projetos
                            </h6>
                            <a href="{{ route('admin.projetos.index', ['status' => 'pendente']) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-clock me-1"></i> Pendentes ({{ \App\Models\Projeto::where('aprovado', false)->count() }})
                            </a>
                            <a href="{{ route('admin.projetos.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-list me-1"></i> Todos os Projetos
                            </a>
                            
                            <!-- Publicações -->
                            <hr class="my-2">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-book me-1"></i> Publicações
                            </h6>
                            <a href="{{ route('admin.publicacoes.index', ['status' => 'pendente']) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-clock me-1"></i> Pendentes ({{ \App\Models\Publicacao::where('aprovado', false)->count() }})
                            </a>
                            <a href="{{ route('admin.publicacoes.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-list me-1"></i> Todas as Publicações
                            </a>
                            
                            <!-- Usuários -->
                            <hr class="my-2">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-people me-1"></i> Usuários
                            </h6>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-person-lines-fill me-1"></i> Gerir Usuários
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- System Status Card -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">
                            <i class="bi bi-shield-check me-2"></i>
                            Status do Sistema
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Sistema</span>
                            <span class="badge bg-success">Online</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Database</span>
                            <span class="badge bg-success">Conectada</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Laravel</span>
                            <span class="badge bg-info">{{ app()->version() }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">PHP</span>
                            <span class="badge bg-info">{{ PHP_VERSION }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <!-- Status Cards -->
                <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-people text-primary fs-1"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Total de Usuários</h5>
                                <h3 class="mb-0 fw-bold">{{ \App\Models\User::count() }}</h3>
                                <p class="text-muted mb-0 small">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up"></i> 
                                        {{ \App\Models\User::where('created_at', '>=', now()->subDays(7))->count() }}
                                    </span> 
                                    novos esta semana
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-mortarboard text-success fs-1"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Tutores</h5>
                                <h3 class="mb-0 fw-bold">{{ \App\Models\User::where('role', 'tutor')->count() }}</h3>
                                <p class="text-muted mb-0 small">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up"></i> 
                                        {{ \App\Models\User::where('role', 'tutor')->where('created_at', '>=', now()->subDays(7))->count() }}
                                    </span> 
                                    novos esta semana
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-info bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-person-workspace text-info fs-1"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Tutorandos</h5>
                                <h3 class="mb-0 fw-bold">{{ \App\Models\User::where('role', 'tutorando')->count() }}</h3>
                                <p class="text-muted mb-0 small">
                                    <span class="text-success">
                                        <i class="bi bi-arrow-up"></i> 
                                        {{ \App\Models\User::where('role', 'tutorando')->where('created_at', '>=', now()->subDays(7))->count() }}
                                    </span> 
                                    novos esta semana
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-warning bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-folder text-warning fs-1"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Projetos</h5>
                                <h3 class="mb-0 fw-bold">{{ \App\Models\Projeto::count() }}</h3>
                                <p class="text-muted mb-0 small">
                                    <span class="text-danger">
                                        <i class="bi bi-exclamation-triangle"></i> 
                                        {{ \App\Models\Projeto::where('aprovado', false)->count() }}
                                    </span> 
                                    aguardando aprovação
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts Row -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Atividades Recentes</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="activityChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Distribuição de Usuários</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="userDistributionChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-building me-2 text-primary"></i>
                            Gestão de Instituições
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">Gerir todas as instituições do sistema</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-list me-1"></i> Ver Todas as Instituições
                            </a>
                            <a href="{{ route('admin.instituicoes.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Nova Instituição
                            </a>
                        </div>
                        <hr class="my-3">
                        <div class="row text-center">
                            <div class="col">
                                <h6 class="fw-bold text-primary">{{ \App\Models\Instituicao::count() }}</h6>
                                <small class="text-muted">Total</small>
                            </div>
                            <div class="col">
                                <h6 class="fw-bold text-success">{{ \App\Models\Instituicao::where('tipo', 'superior')->count() }}</h6>
                                <small class="text-muted">Superior</small>
                            </div>
                            <div class="col">
                                <h6 class="fw-bold text-info">{{ \App\Models\Instituicao::where('tipo', 'técnico')->count() }}</h6>
                                <small class="text-muted">Técnico</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-folder me-2 text-success"></i>
                            Gestão de Projetos
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">Aprovar e gerir projetos de utilizadores</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.projetos.index') }}" class="btn btn-outline-success">
                                <i class="bi bi-list me-1"></i> Ver Todos os Projetos
                            </a>
                            <a href="{{ route('admin.projetos.index', ['status' => 'pendente']) }}" class="btn btn-warning">
                                <i class="bi bi-clock me-1"></i> Projetos Pendentes
                            </a>
                        </div>
                        <hr class="my-3">
                        <div class="row text-center">
                            <div class="col">
                                <h6 class="fw-bold text-primary">{{ \App\Models\Projeto::count() }}</h6>
                                <small class="text-muted">Total</small>
                            </div>
                            <div class="col">
                                <h6 class="fw-bold text-success">{{ \App\Models\Projeto::where('aprovado', true)->count() }}</h6>
                                <small class="text-muted">Aprovados</small>
                            </div>
                            <div class="col">
                                <h6 class="fw-bold text-warning">{{ \App\Models\Projeto::where('aprovado', false)->count() }}</h6>
                                <small class="text-muted">Pendentes</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-book me-2 text-info"></i>
                            Gestão de Publicações
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">Aprovar e gerir publicações de utilizadores</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.publicacoes.index') }}" class="btn btn-outline-info">
                                <i class="bi bi-list me-1"></i> Ver Todas as Publicações
                            </a>
                            <a href="{{ route('admin.publicacoes.index', ['status' => 'pendente']) }}" class="btn btn-warning">
                                <i class="bi bi-clock me-1"></i> Publicações Pendentes
                            </a>
                        </div>
                        <hr class="my-3">
                        <div class="row text-center">
                            <div class="col">
                                <h6 class="fw-bold text-primary">{{ \App\Models\Publicacao::count() }}</h6>
                                <small class="text-muted">Total</small>
                            </div>
                            <div class="col">
                                <h6 class="fw-bold text-success">{{ \App\Models\Publicacao::where('aprovado', true)->count() }}</h6>
                                <small class="text-muted">Aprovadas</small>
                            </div>
                            <div class="col">
                                <h6 class="fw-bold text-warning">{{ \App\Models\Publicacao::where('aprovado', false)->count() }}</h6>
                                <small class="text-muted">Pendentes</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Sidebar -->
        <div class="row g-4 mb-4">
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i class="bi bi-lightning-charge me-2"></i>
                            Ações Rápidas
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-grid gap-2">
                            <!-- Instituições -->
                            <div class="dropdown-divider"></div>
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-building me-1"></i> Instituições
                            </h6>
                            <a href="{{ route('admin.instituicoes.create') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-plus me-1"></i> Nova Instituição
                            </a>
                            <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-list me-1"></i> Listar Todas
                            </a>
                            
                            <!-- Projetos -->
                            <div class="dropdown-divider mt-3"></div>
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-folder me-1"></i> Projetos
                            </h6>
                            <a href="{{ route('admin.projetos.index', ['status' => 'pendente']) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-clock me-1"></i> Pendentes ({{ \App\Models\Projeto::where('aprovado', false)->count() }})
                            </a>
                            <a href="{{ route('admin.projetos.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-list me-1"></i> Todos os Projetos
                            </a>
                            
                            <!-- Publicações -->
                            <div class="dropdown-divider mt-3"></div>
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-book me-1"></i> Publicações
                            </h6>
                            <a href="{{ route('admin.publicacoes.index', ['status' => 'pendente']) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-clock me-1"></i> Pendentes ({{ \App\Models\Publicacao::where('aprovado', false)->count() }})
                            </a>
                            <a href="{{ route('admin.publicacoes.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-list me-1"></i> Todas as Publicações
                            </a>
                            
                            <!-- Usuários -->
                            <div class="dropdown-divider mt-3"></div>
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-people me-1"></i> Usuários
                            </h6>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-person-lines-fill me-1"></i> Gerir Usuários
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- System Status Card -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">
                            <i class="bi bi-shield-check me-2"></i>
                            Status do Sistema
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Sistema</span>
                            <span class="badge bg-success">Online</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Database</span>
                            <span class="badge bg-success">Conectada</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Laravel</span>
                            <span class="badge bg-info">{{ app()->version() }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">PHP</span>
                            <span class="badge bg-info">{{ PHP_VERSION }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <!-- Existing dashboard content continues here... -->
                <!-- Latest Activity -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Projetos Recentes</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Ações
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.projetos.index') }}">
                                            <i class="bi bi-list me-1"></i> Ver Todos
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.projetos.index', ['status' => 'pendente']) }}">
                                            <i class="bi bi-clock me-1"></i> Pendentes
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.projetos.index', ['status' => 'aprovado']) }}">
                                            <i class="bi bi-check-circle me-1"></i> Aprovados
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Título</th>
                                                <th>Autor</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(\App\Models\Projeto::with('user')->latest()->take(5)->get() as $projeto)
                                            <tr>
                                                <td>{{ Str::limit($projeto->titulo, 25) }}</td>
                                                <td>{{ Str::limit($projeto->user->name, 15) }}</td>
                                                <td>
                                                    @if($projeto->aprovado)
                                                        <span class="badge bg-success">Aprovado</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pendente</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('admin.projetos.show', $projeto) }}" 
                                                           class="btn btn-outline-primary btn-sm" 
                                                           title="Ver">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        @if(!$projeto->aprovado)
                                                        <form action="{{ route('admin.projetos.approve', $projeto) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-outline-success btn-sm" title="Aprovar">
                                                                <i class="bi bi-check"></i>
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Publicações Recentes</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Ações
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.publicacoes.index') }}">
                                            <i class="bi bi-list me-1"></i> Ver Todas
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.publicacoes.index', ['status' => 'pendente']) }}">
                                            <i class="bi bi-clock me-1"></i> Pendentes
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.publicacoes.index', ['status' => 'aprovado']) }}">
                                            <i class="bi bi-check-circle me-1"></i> Aprovadas
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Título</th>
                                                <th>Tipo</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(\App\Models\Publicacao::with('user')->latest()->take(5)->get() as $publicacao)
                                            <tr>
                                                <td>{{ Str::limit($publicacao->titulo, 25) }}</td>
                                                <td>
                                                    <span class="badge bg-{{ 
                                                        $publicacao->tipo == 'livro' ? 'primary' : 
                                                        ($publicacao->tipo == 'artigo' ? 'info' : 
                                                        ($publicacao->tipo == 'video' ? 'danger' : 
                                                        ($publicacao->tipo == 'curso' ? 'success' : 'warning')))
                                                    }}">
                                                        {{ ucfirst($publicacao->tipo) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($publicacao->aprovado)
                                                        <span class="badge bg-success">Aprovada</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pendente</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('admin.publicacoes.show', $publicacao) }}" 
                                                           class="btn btn-outline-primary btn-sm" 
                                                           title="Ver">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        @if(!$publicacao->aprovado)
                                                        <form action="{{ route('admin.publicacoes.approve', $publicacao) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-outline-success btn-sm" title="Aprovar">
                                                                <i class="bi bi-check"></i>
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Latest Institutions -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-building me-2"></i>
                                    Instituições Mais Recentes
                                </h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Ações
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.instituicoes.index') }}">
                                            <i class="bi bi-list me-1"></i> Ver Todas
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.instituicoes.create') }}">
                                            <i class="bi bi-plus-circle me-1"></i> Nova Instituição
                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.instituicoes.index', ['tipo' => 'superior']) }}">
                                            <i class="bi bi-mortarboard me-1"></i> Ensino Superior
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.instituicoes.index', ['tipo' => 'técnico']) }}">
                                            <i class="bi bi-gear me-1"></i> Ensino Técnico
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nome</th>
                                                <th>Tipo</th>
                                                <th>Localização</th>
                                                <th>Usuários</th>
                                                <th>Criada em</th>
                                                <th class="text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(\App\Models\Instituicao::with('users')->latest()->take(5)->get() as $instituicao)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-initial bg-primary bg-opacity-10 rounded me-2">
                                                            <i class="bi bi-building text-primary"></i>
                                                        </div>
                                                        <strong>{{ Str::limit($instituicao->nome, 40) }}</strong>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $instituicao->tipo == 'superior' ? 'primary' : ($instituicao->tipo == 'técnico' ? 'success' : 'info') }}">
                                                        <i class="bi bi-{{ $instituicao->tipo == 'superior' ? 'mortarboard' : ($instituicao->tipo == 'técnico' ? 'gear' : 'book') }} me-1"></i>
                                                        {{ ucfirst($instituicao->tipo) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <i class="bi bi-geo-alt text-muted me-1"></i>
                                                    {{ Str::limit($instituicao->localizacao, 25) }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        {{ $instituicao->users->count() }} usuários
                                                    </span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $instituicao->created_at->format('d/m/Y') }}</small>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('admin.instituicoes.show', $instituicao) }}" 
                                                           class="btn btn-outline-info btn-sm" 
                                                           title="Ver Detalhes">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.instituicoes.edit', $instituicao) }}" 
                                                           class="btn btn-outline-primary btn-sm"
                                                           title="Editar">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button type="button" 
                                                                class="btn btn-outline-danger btn-sm" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#deleteModal-{{ $instituicao->id }}"
                                                                title="Excluir">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                    
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal-{{ $instituicao->id }}" tabindex="-1">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title">Confirmar Exclusão</h6>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="mb-0">Excluir <strong>{{ $instituicao->nome }}</strong>?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                    <form action="{{ route('admin.instituicoes.destroy', $instituicao) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Activity Chart
            const activityCtx = document.getElementById('activityChart').getContext('2d');
            const activityChart = new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
                    datasets: [
                        {
                            label: 'Projetos',
                            data: [12, 19, 15, 28, 25, 30],
                            borderColor: '#ffc107',
                            backgroundColor: 'rgba(255, 193, 7, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Publicações',
                            data: [7, 11, 8, 15, 21, 25],
                            borderColor: '#0dcaf0',
                            backgroundColor: 'rgba(13, 202, 240, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Usuários',
                            data: [5, 9, 13, 17, 24, 35],
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13, 110, 253, 0.1)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
            // User Distribution Chart
            const userDistributionCtx = document.getElementById('userDistributionChart').getContext('2d');
            const userDistributionChart = new Chart(userDistributionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Administradores', 'Tutores', 'Tutorandos'],
                    datasets: [{
                        data: [
                            {{ \App\Models\User::where('role', 'admin')->count() }}, 
                            {{ \App\Models\User::where('role', 'tutor')->count() }}, 
                            {{ \App\Models\User::where('role', 'tutorando')->count() }}
                        ],
                        backgroundColor: [
                            '#dc3545',
                            '#198754',
                            '#0dcaf0'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const value = context.raw;
                                    const percentage = Math.round((value / total) * 100);
                                    return `${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
