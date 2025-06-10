<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                                                                 <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-primary">
                                                                <i class="bi bi-eye me-1"></i> Ver
                                                            </a>        <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ $instituicao->nome }}</h1>
                    <div>
                        <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i> {{ __('Back to Institutions') }}
                        </a>
                        <a href="{{ route('admin.instituicoes.edit', $instituicao) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-1"></i> {{ __('Edit') }}
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">{{ __('Institution Details') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <div class="p-3 bg-light rounded-circle d-inline-block mb-3">
                                        @if($instituicao->tipo == 'superior')
                                            <i class="bi bi-building text-primary" style="font-size: 3rem;"></i>
                                        @elseif($instituicao->tipo == 'técnico')
                                            <i class="bi bi-tools text-success" style="font-size: 3rem;"></i>
                                        @else
                                            <i class="bi bi-book text-primary" style="font-size: 3rem;"></i>
                                        @endif
                                    </div>
                                    <h4>{{ $instituicao->nome }}</h4>
                                    <span class="badge bg-{{ $instituicao->tipo == 'superior' ? 'primary' : ($instituicao->tipo == 'técnico' ? 'success' : 'info') }}">
                                        {{ ucfirst($instituicao->tipo) }}
                                    </span>
                                </div>
                                
                                <hr>
                                
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">{{ __('Location') }}</h6>
                                    <p class="mb-0"><i class="bi bi-geo-alt me-2"></i> {{ $instituicao->localizacao }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">{{ __('Created') }}</h6>
                                    <p class="mb-0"><i class="bi bi-calendar me-2"></i> {{ $instituicao->created_at->format('d/m/Y') }}</p>
                                </div>
                                
                                <div>
                                    <h6 class="text-muted mb-1">{{ __('Last Updated') }}</h6>
                                    <p class="mb-0"><i class="bi bi-clock me-2"></i> {{ $instituicao->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">{{ __('Statistics') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <h3 class="mb-0">{{ $instituicao->users->count() }}</h3>
                                        <small class="text-muted">{{ __('Users') }}</small>
                                    </div>
                                    <div class="col-4">
                                        <h3 class="mb-0">{{ $instituicao->users->where('role', 'tutor')->count() }}</h3>
                                        <small class="text-muted">{{ __('Tutors') }}</small>
                                    </div>
                                    <div class="col-4">
                                        <h3 class="mb-0">{{ $instituicao->users->where('role', 'tutorando')->count() }}</h3>
                                        <small class="text-muted">{{ __('Tutorandos') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">{{ __('Users from this Institution') }}</h5>
                            </div>
                            <div class="card-body">
                                @if($instituicao->users->isEmpty())
                                    <div class="text-center py-4">
                                        <i class="bi bi-people text-muted display-4"></i>
                                        <p class="mt-3">{{ __('No users registered from this institution yet.') }}</p>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Email') }}</th>
                                                    <th>{{ __('Role') }}</th>
                                                    <th>{{ __('Course') }}</th>
                                                    <th>{{ __('Actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($instituicao->users->take(10) as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'tutor' ? 'success' : 'info') }}">
                                                                {{ ucfirst($user->role) }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $user->curso }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-primary">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    @if($instituicao->users->count() > 10)
                                        <div class="text-center mt-3">
                                            <a href="{{ route('admin.users.index', ['instituicao_id' => $instituicao->id]) }}" class="btn btn-outline-primary">
                                                {{ __('View All Users') }}
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
