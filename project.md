
# 📘 Tutorando – Documentação Técnica do Projeto

Plataforma de interação entre **tutores** e **tutorandos**, focada no apoio acadêmico e profissional. Desenvolvida com **Laravel 12**, **Bootstrap 5** e **SQLite**.

---

## ✅ Requisitos do Sistema

- Laravel 12
- SQLite3

---

## 🎨 FRONTEND PROMPT (UI/UX com Bootstrap 5)

### 🔹 Layout e Estilo

- Interface moderna, intuitiva e responsiva.
- Paleta de cores: Azul (#007bff), Branco, Cinza claro.
- Ícones: Bootstrap Icons
- Framework: Bootstrap 5

---

### 🏠 Páginas Públicas

- **Página Inicial**
  - Banner com CTA: "Encontrar Tutor" | "Publicar Projeto"
  - Destaques: Projetos em destaque, tutores populares
  - Rodapé com links e redes sociais

- **Login / Registro**
  - Abas (Login / Registar)
  - Registro com:
    - Nome, Email, Senha
    - Tipo de conta (Tutor / Tutorando)
    - Instituição (dropdown)
    - Curso
    - Upload de comprovativo (opcional)

---

### 👤 Painel do Tutor/Tutorando

#### Sidebar
- Dashboard
- Meus Projetos
- Minhas Publicações (apenas Tutor)
- Meu Perfil

#### Funcionalidades
- 📂 Publicar Projeto:
  - Título, Descrição, Imagens (múltiplas)
  - Link do YouTube
  - Upload de PDF

- 📚 Publicar Conteúdo (Tutor):
  - Artigos, Livros, Sebentas, Cursos, Vídeos

- 🔍 Ver outros projetos e publicações

---

### 🛠️ Painel do Administrador

- Dashboard com KPIs
- Gestão de:
  - Instituições
  - Contas de usuários (aprovar/suspender)
  - Projetos e publicações (aprovar/rejeitar)
  - Destaques da plataforma

---

## 🛠️ BACKEND TECHNICAL SPECS (Laravel 12 + SQLite)

### 🧱 Estrutura e Tecnologias

- Framework: Laravel 12
- Banco de dados: SQLite
- Autenticação: Laravel Breeze com Bootstrap
- Uploads: via `storage/app/public`
- Armazenamento de imagens, PDFs e links de YouTube
- Middleware para verificação de tipo de usuário

---

### 🧍 Usuários (`users`)

| Campo         | Tipo      | Detalhes                         |
|---------------|-----------|----------------------------------|
| id            | bigint    | PK                               |
| name          | string    |                                  |
| email         | string    | único                            |
| password      | string    | hashed                           |
| role          | enum      | `admin`, `tutor`, `tutorando`    |
| curso         | string    | obrigatório                      |
| instituicao_id| foreignId | obrigatório                      |
| created_at    | timestamp |                                  |

---

### 🏫 Instituições (`instituicoes`)

| Campo        | Tipo   | Detalhes                         |
|--------------|--------|----------------------------------|
| id           | bigint | PK                               |
| nome         | string | Nome da instituição              |
| tipo         | enum   | técnico, médio, superior         |
| localizacao  | string | Cidade, província, país          |
| created_at   | timestamp |                               |

---

### 📁 Projetos (`projetos`)

| Campo         | Tipo     | Detalhes                                 |
|---------------|----------|------------------------------------------|
| id            | bigint   | PK                                       |
| titulo        | string   | obrigatório                              |
| descricao     | text     |                                          |
| imagens       | json     | array de caminhos das imagens            |
| youtube_link  | string   | link do vídeo                            |
| arquivo_pdf   | string   | caminho do PDF                           |
| user_id       | foreignId| tutor ou tutorando                       |
| aprovado      | boolean  | aprovado por administrador               |
| created_at    | timestamp|                                          |

---

### 📚 Publicações Acadêmicas (`publicacoes`)

| Campo         | Tipo     | Detalhes                               |
|---------------|----------|----------------------------------------|
| id            | bigint   | PK                                     |
| titulo        | string   |                                        |
| tipo          | enum     | livro, artigo, vídeo, curso, sebenta   |
| conteudo_url  | string   | URL ou caminho do arquivo              |
| descricao     | text     |                                        |
| user_id       | foreignId| apenas tutor pode publicar             |
| aprovado      | boolean  |                                        |

---

### 🧾 Planos e Pagamentos

> **Simples, manual (na primeira fase).**

- `plano_user` tabela opcional com:
  - `user_id`
  - `tipo_plano` (tutor, tutorando)
  - `valor_pago`
  - `data_expiracao`
  - `status`

---

### 🔒 Autenticação e Middleware

- Laravel Breeze com Bootstrap
- Middlewares:
  - `IsAdminMiddleware`
  - `IsTutorMiddleware`
  - `IsTutorandoMiddleware`

---

### 📂 Uploads e Armazenamento

| Tipo           | Local                           |
|----------------|----------------------------------|
| Imagens        | `storage/app/public/projetos/`   |
| PDFs           | `storage/app/public/projetos/`   |
| Publicações    | `storage/app/public/publicacoes/`|

Rodar:
```bash
php artisan storage:link
```

---

## 🎯 Funcionalidades Específicas

### 👨‍🏫 Tutor

- Publicar:
  - Projetos com:
    - 📷 Imagens
    - 📄 Arquivo PDF
    - 🎥 Link do YouTube
  - Conteúdos acadêmicos:
    - 📚 Artigos
    - 📘 Livros
    - 📼 Vídeos
    - 📖 Sebentas
    - 💻 Cursos
- Visualizar e interagir com tutorandos
- Publicar temas de orientação
- Fazer publicidade dos seus trabalhos

---

### 🎓 Tutorando

- Visualizar:
  - Temas de orientação
  - Lista de tutores
  - Livros e cursos disponíveis
- Publicar projetos com:
  - Imagens
  - PDF
  - Link do YouTube
- Acesso gratuito às sebentas disponíveis

---

### 🛡️ Administrador

- Aprovar ou rejeitar:
  - Contas de usuários
  - Projetos publicados
  - Publicações acadêmicas
- Suspender contas de usuários
- Cadastrar e gerenciar instituições
- Definir conteúdos em destaque na plataforma

---

## 📦 Pacotes Recomendados

| Pacote                     | Finalidade                                                                 |
|---------------------------|---------------------------------------------------------------------------|
| `spatie/laravel-permission` | Gerenciamento de permissões e controle de acesso baseado em roles        |
| `intervention/image`       | Redimensionamento e manipulação de imagens (para thumbnails, etc.)       |
| `laravel-medialibrary`     | Upload e organização avançada de arquivos e mídia                        |
| `dompdf/dompdf`            | Geração de documentos PDF (ex: comprovantes, certificados)               |
| `guzzlehttp/guzzle`        | Integração com APIs externas (ex: YouTube para preview de vídeos)        |

---

### 🧪 Comandos Úteis

```bash
php artisan make:model Projeto -mc
php artisan make:model Publicacao -mc
php artisan make:model Instituicao -mc

php artisan make:middleware IsTutor
php artisan make:middleware IsTutorando
php artisan make:middleware IsAdmin
```

---

### 📌 Observações Finais

- Todos os usuários devem estar **vinculados obrigatoriamente a uma instituição**.
- A plataforma deve permitir publicação de **projetos com imagens, vídeo do YouTube e PDF**.
- O administrador pode **cadastrar e gerenciar instalações/instituições**.
- Implementar política de **aprovação de conteúdo** por parte do administrador.
