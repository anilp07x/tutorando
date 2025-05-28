<x-guest-layout>
    <div class="mb-4 alert alert-warning">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Obrigado por se cadastrar! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link que acabamos de enviar para você? Se você não recebeu o e-mail, teremos prazer em enviar outro.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 alert alert-success">
            <i class="bi bi-check-circle me-2"></i>
            Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o cadastro.
        </div>
    @endif

    <div class="mt-4 d-flex justify-content-between align-items-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-envelope me-2"></i> Reenviar e-mail de verificação
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-link text-decoration-none text-muted">
                <i class="bi bi-box-arrow-right me-1"></i> Sair
            </button>
        </form>
    </div>
</x-guest-layout>
