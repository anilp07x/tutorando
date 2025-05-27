<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ __('Create New Publication') }}</h1>
                    <a href="{{ route('publicacoes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> {{ __('Back to Publications') }}
                    </a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('publicacoes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="titulo" class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tipo" class="form-label">{{ __('Publication Type') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                                    <option value="">{{ __('Select a type') }}</option>
                                    <option value="livro" {{ old('tipo') == 'livro' ? 'selected' : '' }}>{{ __('Book') }}</option>
                                    <option value="artigo" {{ old('tipo') == 'artigo' ? 'selected' : '' }}>{{ __('Article') }}</option>
                                    <option value="vídeo" {{ old('tipo') == 'vídeo' ? 'selected' : '' }}>{{ __('Video') }}</option>
                                    <option value="curso" {{ old('tipo') == 'curso' ? 'selected' : '' }}>{{ __('Course') }}</option>
                                    <option value="sebenta" {{ old('tipo') == 'sebenta' ? 'selected' : '' }}>{{ __('Study Guide') }}</option>
                                </select>
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao') }}</textarea>
                                @error('descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Content') }} <span class="text-danger">*</span></label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="content_type" id="file_upload" value="file" checked>
                                    <label class="form-check-label" for="file_upload">
                                        {{ __('Upload a File') }}
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="content_type" id="external_url" value="url">
                                    <label class="form-check-label" for="external_url">
                                        {{ __('External URL') }}
                                    </label>
                                </div>
                            </div>

                            <div id="file_upload_section" class="mb-3">
                                <label for="conteudo" class="form-label">{{ __('Upload File') }}</label>
                                <input type="file" class="form-control @error('conteudo') is-invalid @enderror" id="conteudo" name="conteudo">
                                <div class="form-text">{{ __('Accepted formats: PDF, DOC, DOCX, PPT, PPTX, ZIP. Maximum 10MB.') }}</div>
                                @error('conteudo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="url_section" class="mb-3 d-none">
                                <label for="conteudo_url" class="form-label">{{ __('External URL') }}</label>
                                <input type="url" class="form-control @error('conteudo_url') is-invalid @enderror" id="conteudo_url" name="conteudo_url" value="{{ old('conteudo_url') }}">
                                <div class="form-text">{{ __('Enter a URL for external content (YouTube, Google Drive, Dropbox, etc.)') }}</div>
                                @error('conteudo_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    @if(Auth::user()->role === 'admin')
                                        {{ __('As an administrator, your publication will be published immediately.') }}
                                    @else
                                        {{ __('Your publication will be submitted for approval by an administrator before being published.') }}
                                    @endif
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-secondary me-md-2">{{ __('Reset') }}</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> {{ __('Save Publication') }}
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
