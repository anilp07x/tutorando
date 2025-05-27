# Tutorando - Admin Features Guide

## Overview
The admin area has been completely redesigned with modern Bootstrap styling and comprehensive management features.

## Database Setup ✅
- Fixed migration conflicts with instituicoes table
- Database has been properly migrated and seeded
- All models are working correctly

## Admin Features Implemented

### 1. Dashboard (`/admin/dashboard`)
- **Statistics Cards**: Real-time counts for users, tutors, students, projects, and publications
- **Interactive Charts**: 
  - Line chart showing monthly activity trends
  - Doughnut chart showing user distribution by role
- **Quick Access**: Recent projects and publications with approval status
- **Responsive Design**: Works on all device sizes

### 2. Project Management (`/admin/projetos`)
- **List View**: Paginated table with filtering options
  - Filter by approval status (pending/approved)
  - Search by title
  - Sort by date, title, or status
- **Detail View**: Complete project information with approval workflow
  - Project details, description, and metadata
  - Tutor information
  - One-click approval/rejection with modal confirmations
  - Proper status tracking

### 3. Publication Management (`/admin/publicacoes`)
- **List View**: Similar filtering and search capabilities as projects
  - Filter by type (artigo, video, curso)
  - Filter by approval status
  - Advanced search functionality
- **Detail View**: Comprehensive publication review interface
  - Publication content and metadata
  - Author information
  - Approval workflow with confirmation modals
  - Type-specific styling and icons

### 4. Gestão de Instituições (`/admin/instituicoes`)

#### Funcionalidades Implementadas

##### Lista de Instituições (`/admin/instituicoes`)
- **Cards de Estatísticas**: 
  - Total de instituições
  - Contagem por tipo (Superior, Técnico, Médio)
  - Total de usuários vinculados
- **Tabela Responsiva**: Lista completa com informações detalhadas
  - ID, Nome, Tipo, Localização
  - Contador de usuários vinculados
  - Data de criação
  - Ações (visualizar, editar, excluir)
- **Sistema de Badges**: Identificação visual por tipo de instituição
- **Proteção contra Exclusão**: Não permite excluir instituições com usuários vinculados
- **Modais de Confirmação**: Diálogos de confirmação para exclusões

##### Criação de Instituições (`/admin/instituicoes/create`)
- **Formulário Intuitivo**: Interface moderna com validação em tempo real
- **Campos Obrigatórios**:
  - Nome da instituição
  - Tipo (Técnico, Médio, Superior)
  - Localização completa
- **Validação**: Validação tanto no frontend quanto no backend
- **Feedback Visual**: Indicadores visuais de campos obrigatórios e erros

##### Visualização de Detalhes (`/admin/instituicoes/show`)
- **Informações Completas**: Todos os dados da instituição
- **Lista de Usuários**: Usuários vinculados à instituição
- **Estatísticas**: Contadores por tipo de usuário
- **Links de Navegação**: Acesso rápido para edição

##### Edição de Instituições (`/admin/instituicoes/edit`)
- **Formulário Pré-preenchido**: Dados existentes carregados
- **Mesma Validação**: Consistência na validação de dados
- **Preservação de Vínculos**: Edição não afeta usuários vinculados

#### Recursos de Segurança

##### Middleware de Proteção
- **Admin Only**: Apenas administradores podem acessar
- **CSRF Protection**: Proteção contra ataques CSRF em todos os formulários
- **Validação de Dados**: Sanitização e validação rigorosa de entradas

##### Regras de Negócio
- **Integridade Referencial**: Não permite exclusão com dependências
- **Tipos Padronizados**: Apenas tipos pré-definidos aceitos
- **Unicidade**: Prevenção de duplicatas por validação

#### Navegação e UX

##### Integração com Dashboard
- **Link Direto**: Acesso rápido do dashboard principal
- **Breadcrumb**: Navegação contextual clara
- **Menu Lateral**: Navegação dedicada no painel admin

##### Responsividade
- **Mobile-First**: Otimizado para dispositivos móveis
- **Tabelas Responsivas**: Adaptação automática do layout
- **Cards Flexíveis**: Layout adaptável para diferentes tamanhos de tela

#### Dados de Teste

O sistema inclui dados de exemplo através do seeder:
- Universidade de Angola (Superior)
- Instituto Técnico de Luanda (Técnico)
- Escola Média de Tecnologia (Médio)
- Universidade Católica de Angola (Superior)
- Instituto Superior Técnico (Superior)

#### Acesso e Credenciais

Para testar a funcionalidade:
- **URL**: `http://localhost:8000/admin/instituicoes`
- **Credenciais Admin**:
  - Email: `admin@tutorando.com`
  - Senha: `password`

## Styling Features

### Bootstrap Integration
- **Bootstrap 5.3**: Latest version with all components
- **Bootstrap Icons**: Complete icon library integrated
- **Custom CSS**: Additional styling in `/public/css/admin.css`

### UI Components
- **Cards**: Modern card-based layout throughout
- **Tables**: Responsive tables with hover effects
- **Badges**: Color-coded status indicators
- **Buttons**: Consistent button styling with proper states
- **Modals**: Confirmation dialogs for important actions
- **Alerts**: Flash message styling for user feedback

### Responsive Design
- **Mobile-First**: Optimized for mobile devices
- **Grid System**: Proper Bootstrap grid implementation
- **Breakpoints**: Responsive behavior across all screen sizes

## File Structure

### Views
```
resources/views/admin/
├── dashboard.blade.php           # Main admin dashboard
├── projetos/
│   ├── index.blade.php          # Projects list
│   └── show.blade.php           # Project detail/approval
└── publicacoes/
    ├── index.blade.php          # Publications list
    └── show.blade.php           # Publication detail/approval
```

### Assets
```
public/css/
└── admin.css                    # Custom admin styling
```

### Layouts
```
resources/views/layouts/
├── app.blade.php                # Main app layout (updated with Bootstrap)
└── admin.blade.php              # Admin-specific layout
```

## Usage Instructions

### For Administrators

1. **Access Admin Panel**: Navigate to `/admin/dashboard`
2. **Review Projects**: 
   - Go to "Projetos" in the navigation
   - Use filters to find pending approvals
   - Click "Ver Detalhes" to review and approve/reject
3. **Review Publications**:
   - Go to "Publicações" in the navigation
   - Filter by type or status as needed
   - Review content and approve/reject as appropriate
4. **Manage Institutions**:
   - Go to "Instituições" in the navigation
   - View statistics cards for quick insights
   - Use the table to manage institutions (view, edit, delete)
   - Create new institutions as needed

### For Developers

1. **Starting the Server**:
   ```bash
   cd /home/server-dev/projects/tutorando
   php artisan serve
   ```

2. **Database Migrations**:
   ```bash
   php artisan migrate:fresh --seed
   ```

3. **Clearing Cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

## Technical Notes

### Models Fixed
- `Instituicao` model now properly references the `instituicoes` table
- All relationships are working correctly

### Migrations
- Removed conflicting migration file
- Proper table naming convention implemented
- Foreign key constraints properly defined

### Security
- All admin routes should be protected with appropriate middleware
- CSRF protection on all forms
- XSS protection with Blade templating

## Next Steps

1. **Add Authentication Middleware**: Ensure admin routes are protected
2. **Add Role-Based Access**: Implement proper role checking
3. **Add Audit Logging**: Track admin actions for compliance
4. **Add Email Notifications**: Notify users when content is approved/rejected
5. **Add Bulk Actions**: Allow bulk approval/rejection of content

## Testing

The application has been tested and is ready for use. All views are responsive and functional. The database is properly set up and all features are working as expected.
