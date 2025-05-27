# Tutorando

Uma plataforma de interação entre tutores e tutorandos, focada no apoio acadêmico e profissional.

## 🚀 Tecnologias

- [Laravel 12](https://laravel.com/)
- [Bootstrap 5](https://getbootstrap.com/)
- [SQLite](https://www.sqlite.org/)

## 📋 Requisitos

- PHP 8.1 ou superior
- Composer
- Node.js e NPM
- SQLite3

## 🔧 Instalação

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/tutorando.git
cd tutorando
```

2. Instale as dependências do PHP:
```bash
composer install
```

3. Instale as dependências do Node.js:
```bash
npm install
```

4. Copie o arquivo de ambiente:
```bash
cp .env.example .env
```

5. Gere a chave da aplicação:
```bash
php artisan key:generate
```

6. Configure o banco de dados SQLite no arquivo `.env`:
```
DB_CONNECTION=sqlite
DB_DATABASE=/path/absoluto/para/database.sqlite
```

7. Execute o script de configuração de armazenamento:
```bash
./setup-storage.sh
```

8. Execute o script de configuração do banco de dados:
```bash
./setup-database.sh
```

9. Compile os assets:
```bash
npm run build
```

10. Inicie o servidor:
```bash
php artisan serve
```

Ou use o script para configurar e iniciar automaticamente:
```bash
./start-app.sh
```

## 🔐 Credenciais padrão

- **Administrador**:
  - Email: admin@tutorando.com
  - Senha: password

- **Tutor**:
  - Email: joao@tutorando.com
  - Senha: password

- **Tutorando**:
  - Email: pedro@example.com
  - Senha: password

## 🌟 Funcionalidades

### 👨‍🏫 Tutor
- Publicar projetos com imagens, PDF e link do YouTube
- Publicar conteúdos acadêmicos (artigos, livros, vídeos, sebentas, cursos)
- Visualizar e interagir com tutorandos

### 🎓 Tutorando
- Visualizar temas de orientação e lista de tutores
- Publicar projetos com imagens, PDF e link do YouTube
- Acesso gratuito às sebentas disponíveis

### 🛡️ Administrador
- Aprovar ou rejeitar contas de usuários, projetos e publicações
- Cadastrar e gerenciar instituições
- Definir conteúdos em destaque na plataforma

## 📝 Licença

Este projeto está sob a licença MIT.

## 👥 Autores

- Seu Nome - [GitHub](https://github.com/seu-usuario)

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
