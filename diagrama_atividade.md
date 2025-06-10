# Diagrama de Atividade - Sistema Tutorando

## Visão Geral do Sistema

O sistema Tutorando é uma plataforma de interação entre tutores e tutorandos com três tipos principais de usuários:
- **Admin**: Administra instituições, aprova conteúdo, gerencia usuários
- **Tutor**: Cria projetos e publicações, visualiza conteúdo, gerencia perfil
- **Tutorando**: Cria projetos, visualiza tutores e conteúdo, gerencia perfil

## Diagrama de Atividade Principal

```mermaid
flowchart TB
    A[Usuário Acessa Sistema] --> B{Usuário Autenticado?}
    
    B -->|Não| C[Página Inicial Pública]
    C --> D[Login/Registro]
    D --> E{Tipo de Registro}
    E -->|Tutor| F[Registro como Tutor]
    E -->|Tutorando| G[Registro como Tutorando]
    F --> H[Seleciona Instituição]
    G --> H
    H --> I[Validação de Dados]
    I --> J[Conta Criada]
    J --> K[Dashboard]
    
    B -->|Sim| L{Qual o Papel?}
    
    L -->|Admin| M[Dashboard Admin]
    L -->|Tutor| N[Dashboard Tutor]
    L -->|Tutorando| O[Dashboard Tutorando]
    
    %% Fluxo Admin
    M --> P[Gerenciar Sistema]
    P --> Q{Ação Admin}
    Q -->|Instituições| R[CRUD Instituições]
    Q -->|Usuários| S[Gerenciar Usuários]
    Q -->|Aprovações| T[Aprovar/Rejeitar Conteúdo]
    Q -->|Relatórios| U[Visualizar Estatísticas]
    
    T --> V{Tipo de Conteúdo}
    V -->|Projeto| W[Revisar Projeto]
    V -->|Publicação| X[Revisar Publicação]
    W --> Y{Decisão}
    X --> Y
    Y -->|Aprovar| Z[Conteúdo Aprovado]
    Y -->|Rejeitar| AA[Conteúdo Rejeitado]
    Z --> BB[Notificar Usuário]
    AA --> BB
    
    %% Fluxo Tutor
    N --> CC[Ações do Tutor]
    CC --> DD{Ação Tutor}
    DD -->|Criar Projeto| EE[Formulário Projeto]
    DD -->|Criar Publicação| FF[Formulário Publicação]
    DD -->|Ver Projetos| GG[Lista Meus Projetos]
    DD -->|Ver Publicações| HH[Lista Minhas Publicações]
    DD -->|Perfil| II[Gerenciar Perfil]
    DD -->|Explorar| JJ[Ver Conteúdo Público]
    
    EE --> KK[Preencher Dados do Projeto]
    KK --> LL[Upload de Arquivos]
    LL --> MM[Submeter para Aprovação]
    MM --> NN[Aguardar Aprovação Admin]
    NN --> OO{Status}
    OO -->|Aprovado| Z
    OO -->|Rejeitado| AA
    
    FF --> PP[Preencher Dados da Publicação]
    PP --> QQ[Upload de Arquivos/Links]
    QQ --> RR[Submeter para Aprovação]
    RR --> SS[Aguardar Aprovação Admin]
    SS --> TT{Status}
    TT -->|Aprovado| Z
    TT -->|Rejeitado| AA
    
    %% Fluxo Tutorando
    O --> UU[Ações do Tutorando]
    UU --> VV{Ação Tutorando}
    VV -->|Criar Projeto| EE
    VV -->|Procurar Tutores| WW[Lista de Tutores]
    VV -->|Ver Projetos| XX[Projetos Públicos]
    VV -->|Ver Publicações| YY[Publicações Públicas]
    VV -->|Perfil| II
    
    WW --> ZZ[Filtrar/Pesquisar Tutores]
    ZZ --> AAA[Ver Perfil do Tutor]
    AAA --> BBB[Contatar Tutor]
    
    XX --> CCC[Filtrar Projetos]
    CCC --> DDD[Ver Detalhes do Projeto]
    
    YY --> EEE[Filtrar Publicações]
    EEE --> FFF[Ver Detalhes da Publicação]
    
    %% Ações Comuns
    II --> GGG[Editar Informações Pessoais]
    GGG --> HHH[Atualizar Dados]
    HHH --> III[Dados Salvos]
    
    JJ --> XXX{Tipo de Conteúdo}
    XXX -->|Projetos| XX
    XXX -->|Publicações| YY
    XXX -->|Tutores| WW
    
    %% Fim dos fluxos
    BB --> JJJ[Retornar ao Dashboard]
    III --> JJJ
    BBB --> JJJ
    DDD --> JJJ
    FFF --> JJJ
    
    style A fill:#e1f5fe
    style M fill:#ffebee
    style N fill:#e8f5e8
    style O fill:#fff3e0
    style Z fill:#c8e6c9
    style AA fill:#ffcdd2
```

## Diagramas de Atividade Específicos

### 1. Processo de Registro de Usuário

```mermaid
flowchart TB
    A[Usuário Acessa Registro] --> B[Seleciona Tipo de Conta]
    B --> C{Tutor ou Tutorando?}
    
    C -->|Tutor| D[Formulário Registro Tutor]
    C -->|Tutorando| E[Formulário Registro Tutorando]
    
    D --> F[Preencher Dados Pessoais]
    E --> F
    F --> G[Selecionar Instituição]
    G --> H[Definir Curso/Área]
    H --> I[Upload Documento Opcional]
    I --> J[Submeter Formulário]
    
    J --> K[Validação de Dados]
    K --> L{Dados Válidos?}
    L -->|Não| M[Mostrar Erros]
    M --> F
    L -->|Sim| N[Criar Conta]
    N --> O[Enviar Email de Verificação]
    O --> P[Login Automático]
    P --> Q[Redirecionar para Dashboard]
    
    style N fill:#c8e6c9
    style M fill:#ffcdd2
```

### 2. Processo de Aprovação de Conteúdo (Admin)

```mermaid
flowchart TB
    A[Admin Acessa Painel] --> B{Tipo de Conteúdo}
    B -->|Projetos| C[Lista Projetos Pendentes]
    B -->|Publicações| D[Lista Publicações Pendentes]
    
    C --> E[Selecionar Projeto]
    D --> F[Selecionar Publicação]
    
    E --> G[Visualizar Detalhes do Projeto]
    F --> H[Visualizar Detalhes da Publicação]
    
    G --> I[Revisar Conteúdo]
    H --> I
    I --> J[Verificar Qualidade]
    J --> K[Verificar Adequação]
    K --> L{Decisão de Aprovação}
    
    L -->|Aprovar| M[Clicar em Aprovar]
    L -->|Rejeitar| N[Clicar em Rejeitar]
    L -->|Solicitar Alterações| O[Adicionar Comentários]
    
    M --> P[Confirmar Aprovação]
    N --> Q[Confirmar Rejeição]
    O --> R[Enviar de Volta para Autor]
    
    P --> S[Conteúdo Torna-se Público]
    Q --> T[Conteúdo Permanece Privado]
    R --> U[Autor Recebe Notificação]
    
    S --> V[Notificar Autor - Aprovado]
    T --> W[Notificar Autor - Rejeitado]
    U --> X[Aguardar Reenvio]
    
    style S fill:#c8e6c9
    style T fill:#ffcdd2
    style U fill:#fff3e0
```

### 3. Criação de Projeto (Tutor/Tutorando)

```mermaid
flowchart TB
    A[Usuário Quer Criar Projeto] --> B[Acessar Formulário de Projeto]
    B --> C[Preencher Título]
    C --> D[Preencher Descrição]
    D --> E[Definir Categoria/Tags]
    E --> F{Tem Arquivos?}
    
    F -->|Sim| G[Upload de Arquivos]
    F -->|Não| H[Preencher Links Externos]
    G --> H
    
    H --> I{Tem Vídeo YouTube?}
    I -->|Sim| J[Adicionar Link do YouTube]
    I -->|Não| K[Revisar Informações]
    J --> K
    
    K --> L[Submeter Projeto]
    L --> M[Validação de Dados]
    M --> N{Dados Válidos?}
    
    N -->|Não| O[Mostrar Erros]
    O --> C
    N -->|Sim| P[Salvar Projeto]
    P --> Q[Status: Pendente Aprovação]
    Q --> R[Notificar Admin]
    R --> S[Aguardar Aprovação]
    
    S --> T{Resultado da Aprovação}
    T -->|Aprovado| U[Projeto Publicado]
    T -->|Rejeitado| V[Projeto Rejeitado]
    T -->|Alterações Solicitadas| W[Editar e Reenviar]
    
    style U fill:#c8e6c9
    style V fill:#ffcdd2
    style W fill:#fff3e0
```

### 4. Busca e Contato com Tutores

```mermaid
flowchart TB
    A[Tutorando Busca Tutores] --> B[Acessar Lista de Tutores]
    B --> C[Aplicar Filtros]
    C --> D{Tem Filtros?}
    
    D -->|Sim| E[Filtrar por Curso]
    D -->|Não| F[Ver Todos os Tutores]
    E --> G[Filtrar por Área]
    G --> H[Pesquisar por Nome]
    H --> F
    
    F --> I[Visualizar Lista de Tutores]
    I --> J[Selecionar Tutor de Interesse]
    J --> K[Ver Perfil Completo]
    K --> L[Ver Projetos do Tutor]
    L --> M[Ver Publicações do Tutor]
    M --> N[Ver Informações de Contato]
    
    N --> O{Decidir Contato}
    O -->|Sim| P[Copiar Informações de Contato]
    O -->|Não| Q[Voltar à Lista]
    O -->|Ver Outro| R[Voltar ao Perfil]
    
    P --> S[Contatar Externamente]
    Q --> I
    R --> K
    
    style P fill:#c8e6c9
```

### 5. Gestão de Instituições (Admin)

```mermaid
flowchart TB
    A[Admin Gerencia Instituições] --> B[Acessar Lista de Instituições]
    B --> C{Ação Desejada}
    
    C -->|Criar Nova| D[Formulário Nova Instituição]
    C -->|Editar Existente| E[Selecionar Instituição]
    C -->|Ver Detalhes| F[Visualizar Instituição]
    C -->|Deletar| G[Confirmar Exclusão]
    
    D --> H[Preencher Nome]
    H --> I[Selecionar Tipo]
    I --> J[Definir Localização]
    J --> K[Salvar Instituição]
    
    E --> L[Carregar Dados Existentes]
    L --> M[Editar Informações]
    M --> N[Atualizar Instituição]
    
    F --> O[Ver Usuários Vinculados]
    O --> P[Ver Estatísticas]
    
    G --> Q{Tem Usuários Vinculados?}
    Q -->|Sim| R[Erro: Não Pode Deletar]
    Q -->|Não| S[Instituição Deletada]
    
    K --> T[Instituição Criada]
    N --> U[Instituição Atualizada]
    R --> B
    
    style T fill:#c8e6c9
    style U fill:#c8e6c9
    style S fill:#c8e6c9
    style R fill:#ffcdd2
```

## Fluxos de Estados dos Objetos

### Estado do Projeto/Publicação

```mermaid
stateDiagram-v2
    [*] --> Rascunho
    Rascunho --> Pendente : Submeter
    Pendente --> Aprovado : Admin Aprova
    Pendente --> Rejeitado : Admin Rejeita
    Pendente --> Alteracoes : Admin Solicita Mudanças
    Alteracoes --> Pendente : Reenviar
    Rejeitado --> [*]
    Aprovado --> Publico : Publicar
    Publico --> [*]
```

### Estado do Usuário

```mermaid
stateDiagram-v2
    [*] --> Registrado
    Registrado --> EmailVerificado : Verificar Email
    EmailVerificado --> Ativo : Login
    Ativo --> Suspenso : Admin Suspende
    Suspenso --> Ativo : Admin Reativa
    Ativo --> [*] : Deletar Conta
```

## Resumo dos Principais Fluxos

1. **Autenticação e Registro**: Usuários se registram como tutor ou tutorando, vinculam-se a uma instituição
2. **Criação de Conteúdo**: Tutores e tutorandos criam projetos; apenas tutores criam publicações
3. **Aprovação de Conteúdo**: Administradores revisam e aprovam/rejeitam projetos e publicações
4. **Descoberta de Tutores**: Tutorandos podem pesquisar e filtrar tutores por área/curso
5. **Gestão Administrativa**: Administradores gerenciam instituições, usuários e aprovações
6. **Visualização Pública**: Conteúdo aprovado fica disponível para visualização pública

## Considerações Técnicas

- **Middleware de Autenticação**: Proteção de rotas baseada em papéis (admin, tutor, tutorando)
- **Validação de Dados**: Validação no frontend e backend para todos os formulários
- **Upload de Arquivos**: Suporte para imagens, PDFs e links do YouTube
- **Notificações**: Sistema de feedback para aprovações/rejeições
- **Responsividade**: Interface adaptável para desktop e mobile
