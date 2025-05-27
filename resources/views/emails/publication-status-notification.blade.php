<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status da Publicação - Tutorando</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 0;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 300;
        }
        .content {
            padding: 30px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
            font-size: 14px;
        }
        .status-approved {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .publication-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            border-left: 4px solid #ff6b6b;
        }
        .publication-info h3 {
            margin: 0 0 10px 0;
            color: #495057;
        }
        .publication-info p {
            margin: 5px 0;
            color: #6c757d;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 12px;
            border-top: 1px solid #e9ecef;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #ff6b6b;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
            font-weight: 500;
        }
        .btn:hover {
            background-color: #ee5a52;
        }
        .file-info {
            background-color: #e3f2fd;
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
            border-left: 3px solid #2196f3;
        }
        @media (max-width: 600px) {
            .container {
                margin: 10px;
                max-width: calc(100% - 20px);
            }
            .header, .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 Tutorando</h1>
            <p>Atualização sobre sua publicação</p>
        </div>
        
        <div class="content">
            <h2>Olá, {{ $user->name }}!</h2>
            
            <p>Temos uma atualização importante sobre sua publicação:</p>
            
            <div class="publication-info">
                <h3>{{ $publicacao->titulo }}</h3>
                <p><strong>Status:</strong> 
                    <span class="status-badge {{ $isApproved ? 'status-approved' : 'status-rejected' }}">
                        {{ $isApproved ? '✅ APROVADA' : '❌ REJEITADA' }}
                    </span>
                </p>
                <p><strong>Tipo:</strong> {{ ucfirst($publicacao->tipo) }}</p>
                @if($publicacao->area)
                    <p><strong>Área:</strong> {{ $publicacao->area }}</p>
                @endif
                @if($publicacao->resumo)
                    <p><strong>Resumo:</strong> {{ Str::limit($publicacao->resumo, 150) }}</p>
                @endif
                @if($publicacao->arquivo_path)
                    <div class="file-info">
                        <p style="margin: 0;"><strong>📎 Arquivo:</strong> {{ basename($publicacao->arquivo_path) }}</p>
                    </div>
                @endif
                <p><strong>Data de submissão:</strong> {{ $publicacao->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            @if($isApproved)
                <div style="background-color: #d4edda; padding: 15px; border-radius: 6px; border-left: 4px solid #28a745;">
                    <h4 style="color: #155724; margin: 0 0 10px 0;">🎉 Parabéns!</h4>
                    <p style="color: #155724; margin: 0;">
                        Sua publicação foi aprovada e agora está disponível na biblioteca da plataforma. 
                        Outros usuários poderão acessar e baixar seu conteúdo!
                    </p>
                </div>
            @else
                <div style="background-color: #f8d7da; padding: 15px; border-radius: 6px; border-left: 4px solid #dc3545;">
                    <h4 style="color: #721c24; margin: 0 0 10px 0;">📝 Revisão necessária</h4>
                    <p style="color: #721c24; margin: 0;">
                        Sua publicação não foi aprovada nesta revisão. Verifique se o conteúdo atende às diretrizes 
                        da plataforma, se o arquivo está legível e se todas as informações estão completas. 
                        Você pode editar e reenviar sua publicação.
                    </p>
                </div>
            @endif
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/publicacoes') }}" class="btn">
                    Ver minhas publicações
                </a>
            </div>
            
            <p style="color: #6c757d; font-size: 14px;">
                Se você tiver dúvidas sobre esta decisão ou precisar de orientações sobre as diretrizes 
                de publicação, entre em contato conosco através do suporte.
            </p>
        </div>
        
        <div class="footer">
            <p>Esta é uma mensagem automática do sistema Tutorando.</p>
            <p>© {{ date('Y') }} Tutorando - Conectando estudantes e orientadores</p>
        </div>
    </div>
</body>
</html>
