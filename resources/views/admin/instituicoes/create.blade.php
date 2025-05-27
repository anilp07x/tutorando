<x-app-layout>
    <x-slot name="title">
        Criar Nova Instituição
    </x-slot>
    
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">
                        <i class="bi bi-plus-circle me-2"></i>
                        Criar Nova Instituição
                    </h1>
                    <a href="{{ route('admin.instituicoes.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Voltar
                    </a>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-building me-2"></i>
                            Dados da Instituição
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.instituicoes.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="nome" class="form-label fw-semibold">Nome da Instituição <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-building text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('nome') is-invalid @enderror" 
                                           id="nome" 
                                           name="nome" 
                                           value="{{ old('nome') }}" 
                                           placeholder="Ex: Universidade de Angola"
                                           required>
                                </div>
                                @error('nome')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="tipo" class="form-label fw-semibold">Tipo de Instituição <span class="text-danger">*</span></label>
                                <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                                    <option value="">Selecione um tipo</option>
                                    <option value="técnico" {{ old('tipo') == 'técnico' ? 'selected' : '' }}>
                                        <i class="bi bi-gear"></i> Técnico
                                    </option>
                                    <option value="médio" {{ old('tipo') == 'médio' ? 'selected' : '' }}>
                                        <i class="bi bi-book"></i> Ensino Médio
                                    </option>
                                    <option value="superior" {{ old('tipo') == 'superior' ? 'selected' : '' }}>
                                        <i class="bi bi-mortarboard"></i> Ensino Superior
                                    </option>
                                </select>
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="localizacao" class="form-label fw-semibold">Localização <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-geo-alt text-muted"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control border-start-0 @error('localizacao') is-invalid @enderror" 
                                           id="localizacao" 
                                           name="localizacao" 
                                           value="{{ old('localizacao') }}" 
                                           placeholder="Ex: Luanda, Angola"
                                           required>
                                </div>
                                @error('localizacao')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Limpar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Salvar Instituição
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
