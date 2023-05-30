**API de Gerenciamento de Usuários e Cards (Kanban)**

Esta é uma API de gerenciamento de usuários e cards desenvolvida com Laravel. Ela fornece endpoints para autenticação de usuários, criação, leitura, atualização e exclusão de usuários e cards. O projeto possui uma autenticação baseada em JWT (JSON Web Token) para proteger as rotas que exigem autenticação.

Aqui estão as rotas disponíveis na API:

**Rotas de Autenticação**

-   **POST /login**: Realiza o login do usuário e retorna um token JWT válido para autenticação.

**Rotas de Usuários**

Não é necessário Autenticação

-   **GET /user**: Retorna todos os usuários cadastrados.
-   **GET /user/{id}**: Retorna um usuário específico com base no ID fornecido.
-   **POST /user**: Cria um novo usuário com base nos dados fornecidos.
-   **PUT /user/{id}**: Atualiza os dados de um usuário existente com base no ID fornecido.
-   **DELETE /user/{id}**: Exclui um usuário específico com base no ID fornecido.

**Rotas de Cards**

-   **GET /card**: Retorna todos os cards do usuário autenticado.
-   **GET /card/{id}**: Retorna um card específico com base no ID fornecido, desde que pertença ao usuário autenticado.
-   **POST /card**: Cria um novo card para o usuário autenticado.
-   **PUT /card/{id}**: Atualiza os dados de um card existente com base no ID fornecido, desde que pertença ao usuário autenticado.
-   **DELETE /card/{id}**: Exclui um card específico com base no ID fornecido, desde que pertença ao usuário autenticado.

## Requests e Responses de User

### Exemplo de Request Criação USER:

```json

    "name": "João",
	"email": "joao@email.com",
	"password":"1234"

```

### Response da request:

```json

    "name": "João",
	"email": "joao@email.com",
	"id": "3e6842d2-4f73-4570-b9fd-1053704993a5",
	"updated_at": "2023-05-30T16:17:31.000000Z",
	"created_at": "2023-05-30T16:17:31.000000Z"
```

### Exemplo de Request LOGIN USER:

```json

  	"email": "joao@email.com",
	"password":"1234"

```

### Response da request:

```json

    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjg1NDYzNDYyLCJleHAiOjE2ODU0NjcwNjIsIm5iZiI6MTY4NTQ2MzQ2MiwianRpIjoiaUprdVgzdFl6Sk1FN2Y0MyIsInN1YiI6Ijg5ZDg5ZTAxLTk0ODctNGY2Zi1iMWU1LTNhYzE0ODJmZWFjMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.8t5f976r1X_a9IVqFFq9zPC6B2yPVoO2J02TmiKP-98",
	"token_type": "bearer",
	"expires_in": 3600
```

### Exemplo de Request UPDATE USER:

necessário preencher todos os campos por ser um método PUT

```json
    "nome" : "Joao Ayualizado"
  	"email": "joao@email.com",


```

### Response da request:

```json

    "name" : "Joao Ayualizado"
	"email": "joao@email.com",
	"id": "3e6842d2-4f73-4570-b9fd-1053704993a5",
	"updated_at": "2023-05-30T16:17:31.000000Z",
	"created_at": "2023-05-30T16:17:31.000000Z"
```

### Exemplo de Request CREATE CARD:

```json
    "titulo": "Criar Fronend",
	"conteudo": "descrição..."


```

### Response da request:

```json
		"id": "02c1ab62-c947-46b7-a35a-378080c20958",
		"titulo": "Criar Fronend",
	    "conteudo": "descrição..."
		"lista": "Done",
		"created_at": "2023-05-30T14:53:08.000000Z",
		"updated_at": "2023-05-30T15:30:17.000000Z",
		"user_id": "89d89e01-9487-4f6f-b1e5-3ac1482feac3"

```

### Exemplo de Request UPDATE CARD:

necessário preencher todos os campos por ser um método PUT e para atualizar a lista só é aceito essas opções: To Do, Doing, Done

```json
    "titulo": "Criar Fronend",
	"conteudo": "descrição...",
    "lista": "Done"


```

### Response da request:

```json
		"id": "02c1ab62-c947-46b7-a35a-378080c20958",
		"titulo": "update",
		"conteudo": "teste",
		"lista": "Done",
		"created_at": "2023-05-30T14:53:08.000000Z",
		"updated_at": "2023-05-30T15:30:17.000000Z",
		"user_id": "89d89e01-9487-4f6f-b1e5-3ac1482feac3"

```

**Observações sobre autenticação:**

-   Para acessar as rotas protegidas, é necessário enviar um token JWT válido no cabeçalho de autorização (Authorization header).
-   O token JWT pode ser obtido através da rota de login (/login), fornecendo as credenciais corretas de um usuário existente.
-   Ao enviar uma solicitação para as rotas protegidas, certifique-se de incluir o token JWT no cabeçalho Authorization da seguinte forma: `Authorization: Bearer {token}`.

**Pré-requisitos**

-   PHP 7.4 ou superior instalado
-   Composer instalado
-   Banco de dados MySQL configurado
-   Docker e Docker Compose (opcional)

**Configuração**

1. Faça o clone do projeto para o seu ambiente local.
2. Abra o terminal e navegue até o diretório do projeto.
3. Execute o comando `composer install` para instalar as dependências do projeto.
4. Renomeie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, como a conexão do banco de dados.
5. Execute o comando `php artisan key:generate` para gerar a chave do aplicativo.
6. Execute o comando `php artisan migrate` para executar as migrações do banco de dados.

**Executando o Projeto**

Você pode executar o projeto de duas maneiras: usando o servidor embutido do PHP ou usando o Docker.

**Usando o Servidor Embutido do PHP**

1. No terminal, execute o comando `php artisan serve --port=5000` para iniciar o servidor embutido do PHP.
2. Acesse a API através do URL fornecido, por exemplo: `http://localhost:5000
