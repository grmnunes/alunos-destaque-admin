# Sistema de Cadastro de Alunos e Premiações

Este projeto tem como objetivo registrar escolas públicas e seus alunos que foram premiados em feiras e eventos educacionais. Desenvolvido em Laravel com FilamentPHP, a plataforma permite a gestão de premiações e a organização dos dados de forma intuitiva.

## 🚀 Tecnologias Utilizadas

- **Laravel** (Framework PHP)
- **FilamentPHP** (Painel administrativo)
- **MySQL** (Banco de dados)

## 📌 Funcionalidades

- Cadastro e gerenciamento de escolas
- Registro de alunos premiados
- Associação de premiações a escolas e alunos
- Painel administrativo para gerenciamento dos dados

## 📜 Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git
   ```
2. Instale as dependências:
   ```bash
   composer install
   ```
3. Configure o arquivo `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Execute as migrações:
   ```bash
   php artisan migrate
   ```
5. Inicie o servidor local:
   ```bash
   php artisan serve
   ```

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

