<x-app-layout>
    <x-slot name="title">
        Dashboard Administrativo
    </x-slot>
    
    <div class="container-fluid py-4">
        <!-- Header Welcome Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
                    <div class="card-body py-4">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div>
                                <h2 class="fw-bold text-primary mb-1">Olá, {{ Auth::user()->name }}!</h2>
                                <p class="mb-0">Bem-vindo ao painel administrativo do Tutorando. Aqui você gerencia todos os aspectos da plataforma.</p>
                            </div>
                            <div class="mt-3 mt-md-0">
                                <span class="badge bg-primary px-3 py-2">
                                    <i class="bi bi-code-slash me-1"></i> Laravel {{ app()->version() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary w-100">
                            <i class="bi bi-people-fill me-1"></i> Gerenciar Usuários
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-building text-success fs-1"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Instituições</h5>
                                <h3 class="mb-0 fw-bold">{{ \App\Models\Instituicao::count() }}</h3>
                                <p class="text-muted mb-0 small">
                                    <span class="text-primary">
                                        {{ \App\Models\Instituicao::where('tipo', 'superior')->count() }} Ensino Superior
                                    </span> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-sm btn-outline-success w-100">
                            <i class="bi bi-building-fill me-1"></i> Gerenciar Instituições
                        </a>
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
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('admin.projetos.index', ['status' => 'pendente']) }}" class="btn btn-sm btn-outline-warning w-100">
                            <i class="bi bi-hourglass-split me-1"></i> Ver Pendentes
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 p-3 rounded">
                                    <i class="bi bi-book text-primary fs-1"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Publicações</h5>
                                <h3 class="mb-0 fw-bold">{{ \App\Models\Publicacao::count() }}</h3>
                                <p class="text-muted mb-0 small">
                                    <span class="text-danger">
                                        <i class="bi bi-exclamation-triangle"></i> 
                                        {{ \App\Models\Publicacao::where('aprovado', false)->count() }}
                                    </span> 
                                    aguardando aprovação
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('admin.publicacoes.index', ['status' => 'pendente']) }}" class="btn btn-sm btn-outline-primary w-100">
                            <i class="bi bi-hourglass-split me-1"></i> Ver Pendentes
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content and Sidebar -->
        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Charts Row -->
                <div class="row g-4 mb-4">
                    <div class="col-md-7">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Atividades Recentes</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-calendar-range me-1"></i> Período
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#">Últimos 7 dias</a></li>
                                        <li><a class="dropdown-item" href="#">Último mês</a></li>
                                        <li><a class="dropdown-item" href="#">Último trimestre</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="activityChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-3">
                                <h5 class="card-title mb-0">Distribuição de Usuários</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="userDistributionChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Recent Activities Tables -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-folder text-warning me-2"></i>
                                    Projetos Recentes
                                </h5>
                                <a href="{{ route('admin.projetos.index') }}" class="btn btn-sm btn-outline-warning">
                                    Ver Todos
                                </a>
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
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-book text-primary me-2"></i>
                                    Publicações Recentes
                                </h5>
                                <a href="{{ route('admin.publicacoes.index') }}" class="btn btn-sm btn-outline-primary">
                                    Ver Todas
                                </a>
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
                
                <!-- Institutions Table -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-building text-success me-2"></i>
                            Instituições Mais Recentes
                        </h5>
                        <div>
                            <a href="{{ route('admin.instituicoes.create') }}" class="btn btn-sm btn-success me-1">
                                <i class="bi bi-plus-circle me-1"></i> Nova
                            </a>
                            <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-sm btn-outline-success">
                                Ver Todas
                            </a>
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
                                                   class="btn btn-outline-primary btn-sm" 
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
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Approval Summary -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-warning bg-opacity-75 text-dark py-3">
                        <h5 class="mb-0">
                            <i class="bi bi-clock-history me-2"></i>
                            Pendências
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="mb-0">Projetos pendentes</h6>
                                <span class="badge bg-warning text-dark">
                                    {{ \App\Models\Projeto::where('aprovado', false)->count() }}
                                </span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                @php
                                    $totalProjetos = \App\Models\Projeto::count();
                                    $projetosPendentes = \App\Models\Projeto::where('aprovado', false)->count();
                                    $percentualProjetos = $totalProjetos > 0 ? ($projetosPendentes / $totalProjetos) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percentualProjetos }}%"></div>
                            </div>
                        </div>
                        
                        <div class="mb-0">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="mb-0">Publicações pendentes</h6>
                                <span class="badge bg-primary text-white">
                                    {{ \App\Models\Publicacao::where('aprovado', false)->count() }}
                                </span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                @php
                                    $totalPublicacoes = \App\Models\Publicacao::count();
                                    $publicacoesPendentes = \App\Models\Publicacao::where('aprovado', false)->count();
                                    $percentualPublicacoes = $totalPublicacoes > 0 ? ($publicacoesPendentes / $totalPublicacoes) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $percentualPublicacoes }}%"></div>
                            </div>
                        </div>
                        
                        @if($projetosPendentes > 0 || $publicacoesPendentes > 0)
                        <div class="mt-3 d-grid">
                            @if($projetosPendentes > 0)
                            <a href="{{ route('admin.projetos.index', ['status' => 'pendente']) }}" class="btn btn-sm btn-outline-warning mb-2">
                                <i class="bi bi-folder-check me-1"></i> Aprovar Projetos
                            </a>
                            @endif
                            
                            @if($publicacoesPendentes > 0)
                            <a href="{{ route('admin.publicacoes.index', ['status' => 'pendente']) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-journal-check me-1"></i> Aprovar Publicações
                            </a>
                            @endif
                        </div>
                        @else
                        <div class="alert alert-success mt-3 mb-0 d-flex align-items-center">
                            <i class="bi bi-check-circle me-2 fs-5"></i>
                            <div>Não há itens pendentes de aprovação!</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar se o Chart.js está carregado
            if (typeof Chart === 'undefined') {
                console.error('Chart.js não está carregado');
                return;
            }
            
            // Activity Chart
            const activityCanvas = document.getElementById('activityChart');
            if (activityCanvas) {
                try {
                    const activityCtx = activityCanvas.getContext('2d');
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
                            maintainAspectRatio: false,
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
                } catch (error) {
                    console.error('Erro ao criar gráfico de atividade:', error);
                }
            } else {
                console.error('Canvas activityChart não encontrado');
            }
            
            // User Distribution Chart
            const distributionCanvas = document.getElementById('userDistributionChart');
            if (distributionCanvas) {
                try {
                    const userDistributionCtx = distributionCanvas.getContext('2d');
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
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const value = context.raw;
                                            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                            return `${context.label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                } catch (error) {
                    console.error('Erro ao criar gráfico de distribuição:', error);
                }
            } else {
                console.error('Canvas userDistributionChart não encontrado');
            }
            
            // Efeito hover para os cards de ação rápida
            document.querySelectorAll('.hover-shadow').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.classList.add('shadow-sm', 'bg-light');
                });
                card.addEventListener('mouseleave', function() {
                    this.classList.remove('shadow-sm', 'bg-light');
                });
            });
        });
    </script>
    
    <style>
        .hover-shadow {
            transition: all 0.3s ease;
        }
        
        .hover-shadow:hover {
            transform: translateY(-3px);
            background-color: #f8f9fa !important;
        }
    </style>
</x-app-layout>
