<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ __('Edit Project') }}: {{ $projeto->titulo }}</h1>
                    <div>
                        <a href="{{ route('projetos.show', $projeto) }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left me-1"></i> {{ __('Back to Project') }}
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('projetos.update', $projeto) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="titulo" class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $projeto->titulo) }}" required>
                                @error('titulo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="descricao" class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="5" required>{{ old('descricao', $projeto->descricao) }}</textarea>
                                @error('descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="youtube_link" class="form-label">{{ __('YouTube Link') }}</label>
                                <input type="url" class="form-control @error('youtube_link') is-invalid @enderror" id="youtube_link" name="youtube_link" value="{{ old('youtube_link', $projeto->youtube_link) }}">
                                <div class="form-text">{{ __('Enter a YouTube video URL related to your project (optional)') }}</div>
                                @error('youtube_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if($projeto->imagens)
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Current Images') }}</label>
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
                                <label for="imagens" class="form-label">{{ __('Replace Images') }}</label>
                                <input type="file" class="form-control @error('imagens') is-invalid @enderror" id="imagens" name="imagens[]" multiple accept="image/*">
                                <div class="form-text">{{ __('Upload new images to replace the existing ones (optional). Maximum 2MB per image.') }}</div>
                                @error('imagens')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if($projeto->arquivo_pdf)
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Current PDF') }}</label>
                                    <div>
                                        <a href="{{ Storage::url($projeto->arquivo_pdf) }}" target="_blank" class="btn btn-sm btn-danger">
                                            <i class="bi bi-file-pdf me-1"></i> {{ __('View Current PDF') }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="arquivo_pdf" class="form-label">{{ __('Replace PDF File') }}</label>
                                <input type="file" class="form-control @error('arquivo_pdf') is-invalid @enderror" id="arquivo_pdf" name="arquivo_pdf" accept=".pdf">
                                <div class="form-text">{{ __('Upload a new PDF to replace the existing one (optional). Maximum 5MB.') }}</div>
                                @error('arquivo_pdf')
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
                                <a href="{{ route('projetos.show', $projeto) }}" class="btn btn-secondary me-md-2">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> {{ __('Update Project') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
