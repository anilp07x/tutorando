<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ __('Edit Institution') }}: {{ $instituicao->nome }}</h1>
                    <div>
                        <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i> {{ __('Back to Institutions') }}
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.instituicoes.update', $instituicao) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nome" class="form-label">{{ __('Institution Name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $instituicao->nome) }}" required>
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tipo" class="form-label">{{ __('Institution Type') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                                    <option value="">{{ __('Select a type') }}</option>
                                    <option value="técnico" {{ old('tipo', $instituicao->tipo) == 'técnico' ? 'selected' : '' }}>{{ __('Technical') }}</option>
                                    <option value="médio" {{ old('tipo', $instituicao->tipo) == 'médio' ? 'selected' : '' }}>{{ __('Middle') }}</option>
                                    <option value="superior" {{ old('tipo', $instituicao->tipo) == 'superior' ? 'selected' : '' }}>{{ __('Higher Education') }}</option>
                                </select>
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="localizacao" class="form-label">{{ __('Location') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('localizacao') is-invalid @enderror" id="localizacao" name="localizacao" value="{{ old('localizacao', $instituicao->localizacao) }}" required placeholder="City, Province, Country">
                                @error('localizacao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-secondary me-md-2">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> {{ __('Update Institution') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
