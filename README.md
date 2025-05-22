# SaaS Backend API

API em Laravel desenvolvida para um sistema SaaS de vendas online. A plataforma possibilita que qualquer pessoa ou empresa crie sua própria loja virtual para vender produtos físicos ou digitais.

## Funcionalidades

- **Autenticação**: Registro e login de usuários utilizando JWT.
- **Gerenciamento de Usuários**: Criação, edição e remoção de usuários.
- **Gerenciamento de Lojas**: Cada usuário pode criar e gerenciar múltiplas lojas virtuais.
- **Gerenciamento de Produtos**: Cadastro de produtos físicos e digitais, com categorias e preços.
- **Gerenciamento de Pedidos**: Controle de pedidos realizados nas lojas.
- **Arquitetura RESTful**: Endpoints organizados seguindo boas práticas REST.
- **Autenticação via JWT**: Segurança nas requisições e controle de sessão.

## Tecnologias Utilizadas

- [Laravel](https://laravel.com/)  (backend framework PHP)
- [JWT Auth](https://jwt-auth.readthedocs.io/en/develop/) (autenticação)
- MySQL ou PostgreSQL (banco de dados relacional)
- Composer (gerenciador de dependências PHP)

## Requisitos

- PHP >= 8.1
- Composer
- MySQL ou PostgreSQL
- [Extensão PHP OpenSSL](https://www.php.net/manual/pt_BR/book.openssl.php)

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/seu-repo.git
   cd seu-repo
   ```

2. Instale as dependências:
   ```bash
   composer install
   ```

3. Copie o arquivo de exemplo de ambiente e configure as variáveis:
   ```bash
   cp .env.example .env
   # Edite o .env conforme necessário (DB, JWT_SECRET, etc)
   ```

4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

5. Execute as migrations:
   ```bash
   php artisan migrate
   ```

6. Inicie o servidor:
   ```bash
   php artisan serve
   ```

## Autenticação

A autenticação é feita via JWT. Após o login, o usuário recebe um token para autenticar as próximas requisições.

### Exemplo de login

```http
POST /api/login
{
  "email": "usuario@exemplo.com",
  "password": "senha"
}
```

Resposta:
```json
{
  "access_token": "seu_token_jwt",
  "token_type": "bearer",
  "expires_in": 3600
}
```

## Estrutura dos Endpoints Principais

- `POST /api/register` — Cadastro de usuário
- `POST /api/login` — Login e obtenção do token JWT
- `GET /api/user` — Detalhes do usuário autenticado
- `POST /api/stores` — Criação de loja virtual
- `GET /api/stores` — Listagem de lojas do usuário
- `POST /api/products` — Cadastro de produtos
- `GET /api/products` — Listagem de produtos
- `POST /api/orders` — Criação de pedidos
- `GET /api/orders` — Listagem de pedidos

> Consulte a documentação completa dos endpoints para detalhes de parâmetros e respostas.


> Projeto desenvolvido por [Seu Nome](https://github.com/Egydiio)
