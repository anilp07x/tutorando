<x-app-layout>
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">
                        <i class="bi bi-person-gear me-2"></i>Editar Perfil
                    </h1>
                    <a href="{{ route('profile.show') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-1"></i>Voltar ao Perfil
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-person-circle me-2"></i>Informações do Perfil
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0 text-primary">
                            <i class="bi bi-shield-lock me-2"></i>Alterar Palavra-passe
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card border-danger border-2">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>Zona Perigosa
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
