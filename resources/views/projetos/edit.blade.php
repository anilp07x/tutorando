<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">Editar Projeto: {{ $projeto->titulo }}</h1>
                    <div>
                        <a href="{{ route('projetos.show', $projeto) }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i> Voltar ao Projeto
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('projetos.update', $projeto) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $projeto->titulo) }}" required>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao', $projeto->descricao) }}</textarea>
                                @error('descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="youtube_link" class="form-label">Link do YouTube</label>
                                <input type="url" class="form-control @error('youtube_link') is-invalid @enderror" id="youtube_link" name="youtube_link" value="{{ old('youtube_link', $projeto->youtube_link) }}">
                                <div class="form-text">Insira um URL de vídeo do YouTube relacionado ao seu projeto (opcional)</div>
                                @error('youtube_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if($projeto->imagens)
                                <div class="mb-3">
                                    <label class="form-label">Imagens Atuais</label>
                                    <div class="row">
                                        @foreach(json_decode($projeto->imagens) as $index => $imagem)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <img src="{{ Storage::url($imagem) }}" class="card-img-top" alt="Project image {{ $index + 1 }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="imagens" class="form-label">Substituir Imagens</label>
                                <input type="file" class="form-control @error('imagens') is-invalid @enderror" id="imagens" name="imagens[]" multiple accept="image/*">
                                <div class="form-text">Carregue novas imagens para substituir as existentes (opcional). Máximo 2MB por imagem.</div>
                                @error('imagens')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if($projeto->arquivo_pdf)
                                <div class="mb-3">
                                    <label class="form-label">PDF Atual</label>
                                    <div>
                                        <a href="{{ Storage::url($projeto->arquivo_pdf) }}" target="_blank" class="btn btn-sm btn-danger">
                                            <i class="bi bi-file-pdf me-1"></i> Ver PDF Atual
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="arquivo_pdf" class="form-label">Substituir Arquivo PDF</label>
                                <input type="file" class="form-control @error('arquivo_pdf') is-invalid @enderror" id="arquivo_pdf" name="arquivo_pdf" accept=".pdf">
                                <div class="form-text">Carregue um novo PDF para substituir o existente (opcional). Máximo 5MB.</div>
                                @error('arquivo_pdf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    @if(Auth::user()->role === 'admin')
                                        Como administrador, suas alterações serão publicadas imediatamente.
                                    @else
                                        Suas alterações podem exigir aprovação de um administrador antes de serem publicadas.
                                    @endif
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('projetos.show', $projeto) }}" class="btn btn-secondary me-md-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Atualizar Projeto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
