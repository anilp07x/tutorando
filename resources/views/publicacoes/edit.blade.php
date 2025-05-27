<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ __('Edit Publication') }}: {{ $publicacao->titulo }}</h1>
                    <div>
                        <a href="{{ route('publicacoes.show', $publicacao) }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i> {{ __('Back to Publication') }}
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('publicacoes.update', $publicacao) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="titulo" class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $publicacao->titulo) }}" required>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tipo" class="form-label">{{ __('Publication Type') }} <span class="text-danger">*</span></label>
                                <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                                    <option value="">{{ __('Select a type') }}</option>
                                    <option value="livro" {{ old('tipo', $publicacao->tipo) == 'livro' ? 'selected' : '' }}>{{ __('Book') }}</option>
                                    <option value="artigo" {{ old('tipo', $publicacao->tipo) == 'artigo' ? 'selected' : '' }}>{{ __('Article') }}</option>
                                    <option value="vídeo" {{ old('tipo', $publicacao->tipo) == 'vídeo' ? 'selected' : '' }}>{{ __('Video') }}</option>
                                    <option value="curso" {{ old('tipo', $publicacao->tipo) == 'curso' ? 'selected' : '' }}>{{ __('Course') }}</option>
                                    <option value="sebenta" {{ old('tipo', $publicacao->tipo) == 'sebenta' ? 'selected' : '' }}>{{ __('Study Guide') }}</option>
                                </select>
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao', $publicacao->descricao) }}</textarea>
                                @error('descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Current Content') }}</label>
                                <div class="card p-3 bg-light mb-3">
                                    @if(filter_var($publicacao->conteudo_url, FILTER_VALIDATE_URL))
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-link-45deg fs-4 me-2"></i>
                                            <div>
                                                <div>{{ __('External URL') }}</div>
                                                <a href="{{ $publicacao->conteudo_url }}" target="_blank">{{ $publicacao->conteudo_url }}</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex align-items-center">
                                            @php
                                                $extension = pathinfo($publicacao->conteudo_url, PATHINFO_EXTENSION);
                                                $icon = 'file';
                                                if ($extension == 'pdf') $icon = 'file-pdf';
                                                elseif (in_array($extension, ['doc', 'docx'])) $icon = 'file-word';
                                                elseif (in_array($extension, ['ppt', 'pptx'])) $icon = 'file-ppt';
                                                elseif ($extension == 'zip') $icon = 'file-zip';
                                            @endphp
                                            <i class="bi bi-{{ $icon }} fs-4 me-2"></i>
                                            <div>
                                                <div>{{ __('Uploaded File') }}</div>
                                                <a href="{{ Storage::url($publicacao->conteudo_url) }}" target="_blank">
                                                    {{ basename($publicacao->conteudo_url) }}
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Update Content') }}</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="content_type" id="keep_current" value="keep" checked>
                                    <label class="form-check-label" for="keep_current">
                                        {{ __('Keep Current Content') }}
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="content_type" id="file_upload" value="file">
                                    <label class="form-check-label" for="file_upload">
                                        {{ __('Upload a New File') }}
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="content_type" id="external_url" value="url">
                                    <label class="form-check-label" for="external_url">
                                        {{ __('Update External URL') }}
                                    </label>
                                </div>
                            </div>

                            <div id="file_upload_section" class="mb-3 d-none">
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
                                        {{ __('As an administrator, your changes will be published immediately.') }}
                                    @else
                                        {{ __('Your changes may require approval by an administrator before being published.') }}
                                    @endif
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('publicacoes.show', $publicacao) }}" class="btn btn-secondary me-md-2">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> {{ __('Update Publication') }}
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
            const keepCurrentRadio = document.getElementById('keep_current');
            const fileUploadRadio = document.getElementById('file_upload');
            const externalUrlRadio = document.getElementById('external_url');
            const fileUploadSection = document.getElementById('file_upload_section');
            const urlSection = document.getElementById('url_section');
            
            keepCurrentRadio.addEventListener('change', function() {
                if (this.checked) {
                    fileUploadSection.classList.add('d-none');
                    urlSection.classList.add('d-none');
                }
            });
            
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
