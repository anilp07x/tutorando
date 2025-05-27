# Guia de Acesso - Sistema Tutorando

## 🚀 Como Acessar o Sistema

### 1. Iniciar o Servidor
```bash
cd /home/server-dev/projects/tutorando
php artisan serve --host=0.0.0.0 --port=8000
```

### 2. Acessar a Aplicação
- **URL Principal**: http://localhost:8000
- **Dashboard**: http://localhost:8000/dashboard
- **Painel Admin**: http://localhost:8000/admin/dashboard

## 👥 Credenciais de Teste

### Administrador
- **Email**: admin@tutorando.com
- **Senha**: password
- **Acesso**: Todas as funcionalidades administrativas

### Tutor
- **Email**: joao@tutorando.com
- **Senha**: password
- **Acesso**: Criação de projetos e publicações

### Tutorando
- **Email**: pedro@example.com
- **Senha**: password
- **Acesso**: Visualização e criação de projetos

## 🛠️ Funcionalidades Administrativas

### Gestão de Instituições
- **Lista**: `/admin/instituicoes`
- **Criar**: `/admin/instituicoes/create`
- **Visualizar**: `/admin/instituicoes/{id}`
- **Editar**: `/admin/instituicoes/{id}/edit`

### Gestão de Usuários
- **Lista**: `/admin/users`
- **Criar**: `/admin/users/create`
- **Visualizar**: `/admin/users/{id}`
- **Editar**: `/admin/users/{id}/edit`

### Aprovação de Projetos
- **Lista**: `/admin/projetos`
- **Aprovar/Rejeitar**: Através da interface de detalhes

### Aprovação de Publicações
- **Lista**: `/admin/publicacoes`
- **Aprovar/Rejeitar**: Através da interface de detalhes

## 📊 Dashboard Features

### Para Administradores
- Estatísticas gerais do sistema
- Gráficos de atividade (Chart.js)
- Acesso rápido às funcionalidades administrativas
- Links diretos para aprovações pendentes

### Para Usuários Regulares
- Visão dos próprios projetos e publicações
- Acesso a conteúdo público
- Funcionalidades de busca

## 🔧 Comandos Úteis

### Banco de Dados
```bash
# Migrar e popular banco
php artisan migrate:fresh --seed

# Apenas popular (se já migrado)
php artisan db:seed

# Verificar status das migrações
php artisan migrate:status
```

### Cache e Configuração
```bash
# Limpar cache
php artisan config:clear
php artisan cache:clear

# Otimizar para produção
php artisan optimize
```

### Rotas
```bash
# Listar todas as rotas
php artisan route:list

# Apenas rotas administrativas
php artisan route:list | grep admin
```

## 📱 Responsividade

O sistema foi desenvolvido com Bootstrap 5.3 e é totalmente responsivo:
- **Desktop**: Interface completa com todos os recursos
- **Tablet**: Layout adaptado com navegação otimizada
- **Mobile**: Interface condensada com menus colapsáveis

## 🎨 Styling

### Bootstrap Components
- Cards com shadow e bordas arredondadas
- Tabelas responsivas com hover effects
- Modais para confirmações
- Badges para status e categorização
- Botões com estados e ícones

### Bootstrap Icons
- Biblioteca completa de ícones
- Consistência visual em toda a aplicação
- Ícones contextuais para cada funcionalidade

## 🔐 Segurança

### Middleware Implementado
- **Admin**: Proteção de rotas administrativas
- **Tutor**: Restrição de funcionalidades específicas
- **Auth**: Autenticação obrigatória

### Validação
- Validação server-side em todos os formulários
- Proteção CSRF em formulários
- Sanitização de dados de entrada

## 🚨 Troubleshooting

### Problemas Comuns

1. **Erro de Conexão com Banco**
   - Verificar configuração em `.env`
   - Confirmar se MySQL está rodando
   
2. **Erro 500**
   - Verificar logs em `storage/logs/laravel.log`
   - Limpar cache: `php artisan config:clear`

3. **Rotas não Encontradas**
   - Executar: `php artisan route:clear`
   - Verificar se middleware está aplicado

### Logs
```bash
# Visualizar logs em tempo real
tail -f storage/logs/laravel.log
```

## 📝 Próximos Passos

1. **Implementar notificações por email**
2. **Adicionar sistema de relatórios**
3. **Criar API para mobile**
4. **Implementar sistema de arquivos**
5. **Adicionar testes automatizados**

---

**Sistema desenvolvido com Laravel 11 + Bootstrap 5.3**
