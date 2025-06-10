# Diagramas de Sequência - Sistema Tutorando

Este documento apresenta os diagramas de sequência para os principais fluxos do sistema Tutorando, mostrando as interações entre os diferentes atores, controladores e modelos.

## 1. Sequência de Autenticação de Usuário

```mermaid
sequenceDiagram
    participant U as Usuário
    participant B as Browser
    participant WEB as Web Router
    participant AC as AuthenticatedSessionController
    participant M as Middleware
    participant AUTH as Auth Facade
    participant DB as Database
    participant R as Redirect

    U->>B: Acessa página de login
    B->>WEB: GET /login
    WEB->>AC: create()
    AC->>B: view('auth.login')
    B->>U: Formulário de login

    U->>B: Submete credenciais
    B->>WEB: POST /login
    WEB->>M: guest middleware
    M->>AC: store(LoginRequest)
    AC->>AUTH: attempt($credentials)
    AUTH->>DB: SELECT * FROM users WHERE email=?
    
    alt Credenciais válidas
        DB-->>AUTH: User data
        AUTH-->>AC: Authentication success
        AC->>AUTH: login($user)
        AC->>R: redirect()->intended('/dashboard')
        R->>B: HTTP 302 Location: /dashboard
        B->>U: Redirecionamento para dashboard
    else Credenciais inválidas
        AUTH-->>AC: Authentication failed
        AC->>B: back()->withErrors()
        B->>U: Erro de autenticação
    end
```

## 2. Sequência de Registro de Usuário

```mermaid
sequenceDiagram
    participant U as Usuário
    participant B as Browser
    participant WEB as Web Router
    participant RC as RegisteredUserController
    participant M as Middleware
    participant V as Validator
    participant USER as User Model
    participant DB as Database
    participant MAIL as Mail System
    participant AUTH as Auth Facade

    U->>B: Acessa página de registro
    B->>WEB: GET /register
    WEB->>RC: create()
    RC->>B: view('auth.register')
    B->>U: Formulário de registro

    U->>B: Submete dados de registro
    B->>WEB: POST /register
    WEB->>M: guest middleware
    M->>RC: store(Request)
    RC->>V: validate($request)
    
    alt Dados válidos
        V-->>RC: Validation passed
        RC->>USER: create($userData)
        USER->>DB: INSERT INTO users
        DB-->>USER: User created
        USER-->>RC: $user object
        
        RC->>MAIL: event(new Registered($user))
        MAIL->>U: Email de confirmação
        
        RC->>AUTH: login($user)
        RC->>B: redirect('/dashboard')
        B->>U: Redirecionamento para dashboard
    else Dados inválidos
        V-->>RC: Validation failed
        RC->>B: back()->withErrors()
        B->>U: Erros de validação
    end
```

## 3. Sequência de Criação de Projeto

```mermaid
sequenceDiagram
    participant T as Tutor/Tutorando
    participant B as Browser
    participant WEB as Web Router
    participant AM as Auth Middleware
    participant PC as ProjetoController
    participant V as Validator
    participant PM as Projeto Model
    parameter FS as File Storage
    participant DB as Database
    participant CACHE as Cache
    participant ADMIN as Admin System

    T->>B: Acessa criação de projeto
    B->>WEB: GET /projetos/create
    WEB->>AM: auth middleware
    AM->>PC: create()
    PC->>B: view('projetos.create')
    B->>T: Formulário de criação

    T->>B: Submete dados do projeto
    B->>WEB: POST /projetos
    WEB->>AM: auth middleware
    AM->>PC: store(Request)
    PC->>V: validate($request)
    
    alt Dados válidos
        V-->>PC: Validation passed
        PC->>PM: new Projeto()
        PC->>PM: set project data
        
        alt Usuário é Admin
            PC->>PM: aprovado = true
        else Usuário comum
            PC->>PM: aprovado = false
        end
        
        alt Tem arquivo PDF
            PC->>FS: store('projetos/pdfs')
            FS-->>PC: file path
            PC->>PM: arquivo_pdf = path
        end
        
        alt Tem imagens
            loop Para cada imagem
                PC->>FS: store('projetos/imagens')
                FS-->>PC: image path
            end
            PC->>PM: imagens = paths
        end
        
        PC->>PM: save()
        PM->>DB: INSERT INTO projetos
        DB-->>PM: Project saved
        PM-->>PC: Success
        
        alt Usuário não é Admin
            PC->>ADMIN: Notificar projeto pendente
        end
        
        PC->>B: redirect()->with('success')
        B->>T: Confirmação de criação
    else Dados inválidos
        V-->>PC: Validation failed
        PC->>B: back()->withErrors()
        B->>T: Erros de validação
    end
```

## 4. Sequência de Aprovação de Projeto (Admin)

```mermaid
sequenceDiagram
    participant A as Admin
    participant B as Browser
    participant WEB as Web Router
    participant AM as Admin Middleware
    participant APC as Admin::ProjetoController
    participant PM as Projeto Model
    participant DB as Database
    participant MAIL as Mail System
    participant CACHE as Cache System
    participant AL as AuditLog

    A->>B: Acessa dashboard admin
    B->>WEB: GET /admin/projetos
    WEB->>AM: admin middleware
    AM->>APC: index()
    APC->>DB: SELECT projetos WHERE aprovado=false
    DB-->>APC: Projetos pendentes
    APC->>B: view with pending projects
    B->>A: Lista de projetos pendentes

    A->>B: Clica em aprovar projeto
    B->>WEB: PATCH /admin/projetos/{id}/approve
    WEB->>AM: admin middleware
    AM->>APC: approve(Projeto)
    APC->>PM: update(['aprovado' => true])
    PM->>DB: UPDATE projetos SET aprovado=1
    DB-->>PM: Success
    PM-->>APC: Project approved
    
    APC->>MAIL: sendNotificationEmail($project, 'approve')
    MAIL->>APC: Email enviado ao tutor
    
    APC->>AL: logAuditAction('approve')
    AL->>DB: INSERT INTO audit_logs
    
    APC->>CACHE: forget('projeto-'.$id)
    APC->>CACHE: forget('admin-dashboard-stats')
    
    APC->>B: redirect()->with('success')
    B->>A: Confirmação de aprovação
```

## 5. Sequência de Busca de Tutores

```mermaid
sequenceDiagram
    participant TU as Tutorando
    participant B as Browser
    participant WEB as Web Router
    participant AM as Auth Middleware
    participant SC as SearchController
    participant UM as User Model
    participant PM as Projeto Model
    participant PUM as Publicacao Model
    participant DB as Database
    participant CACHE as Cache

    TU->>B: Acessa busca de tutores
    B->>WEB: GET /tutores
    WEB->>AM: auth middleware
    AM->>B: Formulário de busca
    B->>TU: Interface de busca

    TU->>B: Submete critérios de busca
    B->>WEB: GET /search?query=...
    WEB->>AM: auth middleware
    AM->>SC: search(Request)
    
    SC->>CACHE: remember('search-' + query)
    
    alt Cache exists
        CACHE-->>SC: Cached results
    else Cache miss
        SC->>PM: WHERE titulo LIKE %query%
        PM->>DB: SELECT projetos
        DB-->>PM: Project results
        PM-->>SC: Projects found
        
        SC->>PUM: WHERE titulo LIKE %query%
        PUM->>DB: SELECT publicacoes
        DB-->>PUM: Publication results
        PUM-->>SC: Publications found
        
        SC->>UM: WHERE name LIKE %query% AND role='tutor'
        UM->>DB: SELECT users
        DB-->>UM: Tutor results
        UM-->>SC: Tutors found
        
        SC->>CACHE: store results
    end
    
    SC->>B: view('search.results')
    B->>TU: Resultados da busca

    TU->>B: Seleciona tutor
    B->>WEB: GET /tutores/{id}
    WEB->>B: Perfil do tutor
    B->>TU: Detalhes do tutor
```

## 6. Sequência de Publicação de Conteúdo

```mermaid
sequenceDiagram
    participant T as Tutor
    participant B as Browser
    participant WEB as Web Router
    participant TM as Tutor Middleware
    participant PC as PublicacaoController
    participant V as Validator
    participant FS as FileValidationService
    participant ST as Storage
    participant PU as Publicacao Model
    participant DB as Database
    participant ADMIN as Admin Notification

    T->>B: Acessa criação de publicação
    B->>WEB: GET /publicacoes/create
    WEB->>TM: tutor middleware
    TM->>PC: create()
    PC->>B: view('publicacoes.create')
    B->>T: Formulário de publicação

    T->>B: Submete publicação
    B->>WEB: POST /publicacoes
    WEB->>TM: tutor middleware
    TM->>PC: store(Request)
    PC->>V: validate($request)
    
    alt Dados válidos
        V-->>PC: Validation passed
        PC->>PU: new Publicacao()
        
        alt Tem arquivo
            PC->>FS: validate($file)
            FS->>FS: check file type/size
            alt Arquivo válido
                FS-->>PC: File valid
                PC->>FS: storeSecurely($file)
                FS->>ST: store in secure location
                ST-->>FS: file path
                FS-->>PC: file info
                PC->>PU: set file data
            else Arquivo inválido
                FS-->>PC: Validation error
                PC->>B: back()->withErrors()
                B->>T: Erro de arquivo
            end
        else Tem URL
            PC->>PU: conteudo_url = $url
        end
        
        alt Usuário é Admin
            PC->>PU: aprovado = true
        else Usuário comum
            PC->>PU: aprovado = false
        end
        
        PC->>PU: save()
        PU->>DB: INSERT INTO publicacoes
        DB-->>PU: Publication saved
        PU-->>PC: Success
        
        alt Usuário não é Admin
            PC->>ADMIN: Notificar publicação pendente
        end
        
        PC->>B: redirect()->with('success')
        B->>T: Confirmação de criação
    else Dados inválidos
        V-->>PC: Validation failed
        PC->>B: back()->withErrors()
        B->>T: Erros de validação
    end
```

## 7. Sequência de Aprovação em Massa (Admin)

```mermaid
sequenceDiagram
    participant A as Admin
    participant B as Browser
    participant WEB as Web Router
    participant AM as Admin Middleware
    participant APC as Admin::ProjetoController
    participant PM as Projeto Model
    participant DB as Database
    participant MAIL as Mail System
    participant CACHE as Cache System
    participant AL as AuditLog

    A->>B: Seleciona múltiplos projetos
    B->>A: Checkboxes selecionados
    A->>B: Clica "Aprovar em Massa"
    B->>WEB: POST /admin/projetos/bulk-action
    WEB->>AM: admin middleware
    AM->>APC: bulkAction(Request)
    APC->>APC: validate(['action', 'projeto_ids'])
    
    APC->>DB: SELECT projetos WHERE id IN (...)
    DB-->>APC: Selected projects
    
    loop Para cada projeto
        APC->>PM: update(['aprovado' => true])
        PM->>DB: UPDATE projetos
        DB-->>PM: Success
        
        APC->>AL: logAuditAction('bulk_approve')
        AL->>DB: INSERT INTO audit_logs
        
        APC->>MAIL: sendNotificationEmail($projeto, 'approve')
        MAIL->>APC: Email sent
        
        APC->>CACHE: forget('projeto-' + $id)
    end
    
    APC->>CACHE: forget('admin-dashboard-stats')
    APC->>B: redirect()->with('success', '10 projetos aprovados')
    B->>A: Confirmação de aprovação em massa
```

## 8. Sequência de Edição de Projeto

```mermaid
sequenceDiagram
    participant U as Usuário
    participant B as Browser
    participant WEB as Web Router
    participant AM as Auth Middleware
    participant PC as ProjetoController
    participant V as Validator
    participant PM as Projeto Model
    participant FS as File Storage
    participant DB as Database

    U->>B: Acessa edição de projeto
    B->>WEB: GET /projetos/{id}/edit
    WEB->>AM: auth middleware
    AM->>PC: edit(Projeto)
    PC->>PC: check ownership/admin
    
    alt Autorizado
        PC->>B: view('projetos.edit', $projeto)
        B->>U: Formulário de edição preenchido
        
        U->>B: Submete alterações
        B->>WEB: PUT /projetos/{id}
        WEB->>AM: auth middleware
        AM->>PC: update(Request, Projeto)
        PC->>PC: check ownership/admin
        PC->>V: validate($request)
        
        alt Dados válidos
            V-->>PC: Validation passed
            
            alt Remove PDF
                PC->>FS: delete($projeto->arquivo_pdf)
                PC->>PM: arquivo_pdf = null
            end
            
            alt Upload novo PDF
                PC->>FS: store('projetos/pdfs')
                FS-->>PC: new file path
                PC->>PM: arquivo_pdf = path
            end
            
            alt Remove imagens específicas
                loop Para cada imagem a remover
                    PC->>FS: delete($image_path)
                end
                PC->>PM: update imagens array
            end
            
            alt Upload novas imagens
                loop Para cada nova imagem
                    PC->>FS: store('projetos/imagens')
                    FS-->>PC: image path
                end
                PC->>PM: add to imagens array
            end
            
            alt Usuário não é Admin
                PC->>PM: aprovado = false
            end
            
            PC->>PM: save()
            PM->>DB: UPDATE projetos
            DB-->>PM: Success
            PM-->>PC: Project updated
            
            PC->>B: redirect()->with('success')
            B->>U: Confirmação de atualização
        else Dados inválidos
            V-->>PC: Validation failed
            PC->>B: back()->withErrors()
            B->>U: Erros de validação
        end
    else Não autorizado
        PC->>B: abort(403)
        B->>U: Erro de autorização
    end
```

## 9. Sequência de Dashboard Admin

```mermaid
sequenceDiagram
    participant A as Admin
    participant B as Browser
    participant WEB as Web Router
    participant AM as Admin Middleware
    participant DC as Admin::DashboardController
    participant CACHE as Cache Service
    participant UM as User Model
    participant PM as Projeto Model
    participant PU as Publicacao Model
    participant IM as Instituicao Model
    participant DB as Database

    A->>B: Acessa dashboard admin
    B->>WEB: GET /admin/dashboard
    WEB->>AM: admin middleware
    AM->>DC: index()
    DC->>CACHE: getDashboardStats()
    
    alt Cache exists
        CACHE-->>DC: Cached statistics
    else Cache miss
        CACHE->>UM: count()
        UM->>DB: SELECT COUNT(*) FROM users
        DB-->>UM: Total users
        UM-->>CACHE: User stats
        
        CACHE->>PM: count()
        PM->>DB: SELECT COUNT(*) FROM projetos
        DB-->>PM: Total projects
        PM-->>CACHE: Project stats
        
        CACHE->>PM: where('aprovado', false)->count()
        PM->>DB: SELECT COUNT(*) WHERE aprovado=0
        DB-->>PM: Pending projects
        PM-->>CACHE: Pending stats
        
        CACHE->>PU: count()
        PU->>DB: SELECT COUNT(*) FROM publicacoes
        DB-->>PU: Total publications
        PU-->>CACHE: Publication stats
        
        CACHE->>IM: count()
        IM->>DB: SELECT COUNT(*) FROM instituicoes
        DB-->>IM: Total institutions
        IM-->>CACHE: Institution stats
        
        CACHE->>CACHE: store('admin-dashboard-stats', $stats, 300)
    end
    
    DC->>B: view('admin.dashboard', $stats)
    B->>A: Dashboard com estatísticas
```

## 10. Sequência de Exclusão de Conteúdo

```mermaid
sequenceDiagram
    participant U as Usuário
    participant B as Browser
    participant WEB as Web Router
    participant AM as Auth Middleware
    participant PC as ProjetoController
    participant PM as Projeto Model
    participant FS as File Storage
    participant DB as Database
    participant AL as AuditLog

    U->>B: Clica em excluir projeto
    B->>U: Modal de confirmação
    U->>B: Confirma exclusão
    B->>WEB: DELETE /projetos/{id}
    WEB->>AM: auth middleware
    AM->>PC: destroy(Projeto)
    PC->>PC: check ownership/admin
    
    alt Autorizado
        alt Tem arquivo PDF
            PC->>FS: delete($projeto->arquivo_pdf)
        end
        
        alt Tem imagens
            loop Para cada imagem
                PC->>FS: delete($image_path)
            end
        end
        
        PC->>AL: logAuditAction('delete')
        AL->>DB: INSERT INTO audit_logs
        
        PC->>PM: delete()
        PM->>DB: DELETE FROM projetos WHERE id=?
        DB-->>PM: Success
        PM-->>PC: Project deleted
        
        PC->>B: redirect()->with('success')
        B->>U: Confirmação de exclusão
    else Não autorizado
        PC->>B: abort(403)
        B->>U: Erro de autorização
    end
```

## Observações sobre os Diagramas

### Componentes Principais:
- **Controllers**: Gerenciam a lógica de negócio
- **Middleware**: Validam autenticação e autorização
- **Models**: Interagem com o banco de dados
- **Services**: Fornecem funcionalidades específicas (cache, arquivos)
- **Mail System**: Gerencia notificações por email

### Fluxos de Segurança:
- Verificação de autenticação em todas as rotas protegidas
- Verificação de autorização para ações específicas
- Validação de arquivos antes do upload
- Logs de auditoria para ações administrativas

### Otimizações:
- Uso de cache para melhorar performance
- Paginação para listas grandes
- Validação de arquivos para segurança
- Limpeza de cache após alterações

### Estados de Aprovação:
- Conteúdo criado por admins é aprovado automaticamente
- Conteúdo de usuários comuns precisa de aprovação
- Sistema de notificações por email para mudanças de status
