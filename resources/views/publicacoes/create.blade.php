<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">Criar Nova Publicação</h1>
                    <a href="{{ route('publicacoes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Voltar às Publicações
                    </a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('publicacoes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo de Publicação <span class="text-danger">*</span></label>
                                <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                                    <option value="">Seleccione um tipo</option>
                                    <option value="livro" {{ old('tipo') == 'livro' ? 'selected' : '' }}>Livro</option>
                                    <option value="artigo" {{ old('tipo') == 'artigo' ? 'selected' : '' }}>Artigo</option>
                                    <option value="vídeo" {{ old('tipo') == 'vídeo' ? 'selected' : '' }}>Vídeo</option>
                                    <option value="curso" {{ old('tipo') == 'curso' ? 'selected' : '' }}>Curso</option>
                                    <option value="sebenta" {{ old('tipo') == 'sebenta' ? 'selected' : '' }}>Sebenta</option>
                                </select>
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao') }}</textarea>
                                @error('descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Conteúdo <span class="text-danger">*</span></label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="content_type" id="file_upload" value="file" checked>
                                    <label class="form-check-label" for="file_upload">
                                        Carregar um Ficheiro
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="content_type" id="external_url" value="url">
                                    <label class="form-check-label" for="external_url">
                                        URL Externo
                                    </label>
                                </div>
                            </div>

                            <div id="file_upload_section" class="mb-3">
                                <label for="conteudo" class="form-label">Carregar Ficheiro</label>
                                <input type="file" class="form-control @error('conteudo') is-invalid @enderror" id="conteudo" name="conteudo">
                                <div class="form-text">Formatos aceites: PDF, DOC, DOCX, PPT, PPTX, ZIP. Máximo 10MB.</div>
                                @error('conteudo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="url_section" class="mb-3 d-none">
                                <label for="conteudo_url" class="form-label">URL Externo</label>
                                <input type="url" class="form-control @error('conteudo_url') is-invalid @enderror" id="conteudo_url" name="conteudo_url" value="{{ old('conteudo_url') }}">
                                <div class="form-text">Insira um URL para conteúdo externo (YouTube, Google Drive, Dropbox, etc.)</div>
                                @error('conteudo_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    @if(Auth::user()->role === 'admin')
                                        Como administrador, a sua publicação será publicada imediatamente.
                                    @else
                                        A sua publicação será submetida para aprovação por um administrador antes de ser publicada.
                                    @endif
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-secondary me-md-2">Limpar</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i>Guardar Publicação
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileUploadRadio = document.getElementById('file_upload');
            const externalUrlRadio = document.getElementById('external_url');
            const fileUploadSection = document.getElementById('file_upload_section');
            const urlSection = document.getElementById('url_section');
            
            fileUploadRadio.addEventListener('change', function() {
                if (this.checked) {
                    fileUploadSection.classList.remove('d-none');
                    urlSection.classList.add('d-none');
                }
            });
            
            externalUrlRadio.addEventListener('change', function() {
                if (this.checked) {
                    fileUploadSection.classList.add('d-none');
                    urlSection.classList.remove('d-none');
                }
            });
        });
    </script>
</x-app-layout>
