<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <h1 class="fw-bold text-primary">Painel de Controlo</h1>
                <p class="text-muted">Bem-vindo de volta, {{ Auth::user()->name }}!</p>
            </div>
        </div>

        @if(Auth::user()->role == 'admin')
            <!-- Admin Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-shield-lock me-2"></i>
                                Painel Administrativo
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-2 col-sm-4 col-6">
                                    <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center text-decoration-none">
                                        <i class="bi bi-building fs-3 mb-2"></i>
                                        <span class="small">Instituições</span>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center text-decoration-none">
                                        <i class="bi bi-people fs-3 mb-2"></i>
                                        <span class="small">Utilizadores</span>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6">
                                    <a href="{{ route('admin.projetos.index') }}" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center text-decoration-none">
                                        <i class="bi bi-folder fs-3 mb-2"></i>
                                        <span class="small">Projectos</span>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6">
                                    <a href="{{ route('admin.publicacoes.index') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center text-decoration-none">
                                        <i class="bi bi-journal-text fs-3 mb-2"></i>
                                        <span class="small">Publicações</span>
                                    </a>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6">
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary w-100 h-100 d-flex flex-column align-items-center justify-content-center text-decoration-none">
                                        <i class="bi bi-speedometer2 fs-3 mb-2"></i>
                                        <span class="small">Painel Admin</span>
                                    </a>
                                </div>
                                </div>
                                <div class="col-md-2 col-sm-4 col-6">
                                    <a href="#" class="btn btn-outline-dark w-100 h-100 d-flex flex-column align-items-center justify-content-center text-decoration-none">
                                        <i class="bi bi-gear fs-3 mb-2"></i>
                                        <span class="small">Configurações</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Dashboard -->
            <div class="row mb-4">
                <div class="col-md-3 mb-4">
                    <div class="card stats-card-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total de Utilizadores</h5>
                            <h2 class="display-4">{{ \App\Models\User::count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Tutores</h5>
                            <h2 class="display-4">{{ \App\Models\User::where('role', 'tutor')->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Tutorandos</h5>
                            <h2 class="display-4">{{ \App\Models\User::where('role', 'tutorando')->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Projectos</h5>
                            <h2 class="display-4">{{ \App\Models\Projeto::count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Utilizadores Recentes</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Função</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'tutor' ? 'success' : 'primary') }}">
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                </td>
                                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Aprovações Pendentes</h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="approvalsTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="projects-tab" data-bs-toggle="tab" data-bs-target="#projects-tab-pane" type="button" role="tab" aria-controls="projects-tab-pane" aria-selected="true">Projectos</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="publications-tab" data-bs-toggle="tab" data-bs-target="#publications-tab-pane" type="button" role="tab" aria-controls="publications-tab-pane" aria-selected="false">Publicações</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="approvalsTabContent">
                                <div class="tab-pane fade show active" id="projects-tab-pane" role="tabpanel" aria-labelledby="projects-tab" tabindex="0">
                                    <div class="table-responsive mt-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Título</th>
                                                    <th>Autor</th>
                                                    <th>Data</th>
                                                    <th>Acções</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(\App\Models\Projeto::where('aprovado', false)->latest()->take(5)->get() as $projeto)
                                                    <tr>
                                                        <td>{{ $projeto->titulo }}</td>
                                                        <td>{{ $projeto->user->name }}</td>
                                                        <td>{{ $projeto->created_at->format('d/m/Y') }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="#" class="btn btn-sm btn-success">Aprovar</a>
                                                                <a href="#" class="btn btn-sm btn-danger">Rejeitar</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="publications-tab-pane" role="tabpanel" aria-labelledby="publications-tab" tabindex="0">
                                    <div class="table-responsive mt-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Título</th>
                                                    <th>Tipo</th>
                                                    <th>Autor</th>
                                                    <th>Acções</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(\App\Models\Publicacao::where('aprovado', false)->latest()->take(5)->get() as $publicacao)
                                                    <tr>
                                                        <td>{{ $publicacao->titulo }}</td>
                                                        <td>{{ ucfirst($publicacao->tipo) }}</td>
                                                        <td>{{ $publicacao->user->name }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="#" class="btn btn-sm btn-success">Aprovar</a>
                                                                <a href="#" class="btn btn-sm btn-danger">Rejeitar</a>
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
        @elseif(Auth::user()->role == 'tutor')
            <!-- Painel do Tutor -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <h5 class="card-title">Os Meus Projectos</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h2 class="display-6">{{ \App\Models\Projeto::where('user_id', Auth::id())->count() }}</h2>
                                <a href="#" class="btn btn-primary">Ver Todos</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <h5 class="card-title">As Minhas Publicações</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h2 class="display-6">{{ \App\Models\Publicacao::where('user_id', Auth::id())->count() }}</h2>
                                <a href="#" class="btn btn-primary">Ver Todas</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <h5 class="card-title">Acções Rápidas</h5>
                            <div class="d-grid gap-2 mt-3 quick-actions">
                                <a href="#" class="btn btn-outline-primary">Novo Projecto</a>
                                <a href="#" class="btn btn-outline-primary">Nova Publicação</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Projectos Recentes</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Data</th>
                                            <th>Estado</th>
                                            <th>Acções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\Projeto::where('user_id', Auth::id())->latest()->take(5)->get() as $projeto)
                                            <tr>
                                                <td>{{ $projeto->titulo }}</td>
                                                <td>{{ $projeto->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $projeto->aprovado ? 'success' : 'warning' }}">
                                                        {{ $projeto->aprovado ? 'Aprovado' : 'Pendente' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="#" class="btn btn-sm btn-outline-primary">Ver</a>
                                                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
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
        @else
            <!-- Painel do Tutorando -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <h5 class="card-title">Os Meus Projectos</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h2 class="display-6">{{ \App\Models\Projeto::where('user_id', Auth::id())->count() }}</h2>
                                <a href="#" class="btn btn-primary">Ver Todos</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card dashboard-panel">
                        <div class="card-body">
                            <h5 class="card-title">Acções Rápidas</h5>
                            <div class="d-grid gap-2 mt-3 quick-actions">
                                <a href="{{ route('projetos.create') }}" class="btn btn-outline-primary">Novo Projecto</a>
                                <a href="{{ route('tutores.index') }}" class="btn btn-outline-primary">Encontrar Tutores</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Projectos Recentes</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Data</th>
                                            <th>Estado</th>
                                            <th>Acções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\Projeto::where('user_id', Auth::id())->latest()->take(5)->get() as $projeto)
                                            <tr>
                                                <td>{{ $projeto->titulo }}</td>
                                                <td>{{ $projeto->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $projeto->aprovado ? 'success' : 'warning' }}">
                                                        {{ $projeto->aprovado ? 'Aprovado' : 'Pendente' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="#" class="btn btn-sm btn-outline-primary">Ver</a>
                                                        <a href="#" class="btn btn-sm btn-primary">Editar</a>
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

            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Tutores em Destaque</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach(\App\Models\User::where('role', 'tutor')->inRandomOrder()->take(4)->get() as $tutor)
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100 featured-tutor-card">
                                            <div class="card-body text-center">
                                                <div class="mb-3">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($tutor->name) }}&background=ff7906&color=fff" class="rounded-circle" width="80" height="80" alt="{{ $tutor->name }}">
                                                </div>
                                                <h5 class="card-title">{{ $tutor->name }}</h5>
                                                <p class="card-text text-muted">{{ $tutor->curso }}</p>
                                                <a href="{{ route('tutores.show', $tutor) }}" class="btn btn-sm btn-outline-primary">Ver Perfil</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
