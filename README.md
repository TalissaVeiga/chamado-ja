# ChamadoJá

## Sobre o projeto

O ChamadoJá é um projeto desenvolvido para ajudar na organização de chamados de suporte técnico. A ideia é permitir que os problemas sejam registrados e acompanhados de forma mais simples, facilitando a consulta das informações e o controle do andamento de cada chamado.

O sistema está sendo desenvolvido como parte do Projeto Integrador do curso.

## Tecnologias utilizadas

- PHP
- Laravel
- PostgreSQL
- Composer

## Como executar o projeto

Para rodar o projeto no computador, é necessário ter o PHP, o Composer e o PostgreSQL instalados.

**1. Instalar as dependências**

Dentro da pasta do projeto, execute:

```bash
composer install
```

**2. Configurar o ambiente**

Configure o arquivo `.env` com os dados de conexão do PostgreSQL. Caso ainda não tenha esse arquivo, utilize o `.env.example` como base.

Depois, gere a chave da aplicação:

```bash
php artisan key:generate
```

**3. Preparar o banco de dados**

Crie o banco de dados `chamado_ja` no PostgreSQL e configure a conexão no arquivo `.env`.

Com o banco preparado e as migrations compatíveis com sua estrutura, execute:

```bash
php artisan migrate
```

**4. Iniciar o servidor**

Para iniciar a aplicação localmente, utilize:

```bash
php artisan serve
```

## Testando a API

Com o servidor ligado, acesse o endereço abaixo no navegador:

http://127.0.0.1:8000/api/saude

Se estiver tudo funcionando, será exibida uma resposta em JSON indicando que a API está ativa.

## Organização dos arquivos

- `app/Models`: contém os modelos utilizados para representar os dados e seus relacionamentos.
- `database/migrations`: contém os arquivos que definem a estrutura das tabelas.
- `database/factories`: contém as configurações para gerar dados fictícios de teste.
- `database/seeders`: contém os arquivos usados para inserir dados iniciais.
- `routes/api.php`: contém as rotas da API.

## Situação atual

O projeto está em desenvolvimento. Nesta etapa, o foco é organizar a estrutura do Laravel, conectar o PostgreSQL e configurar os modelos e relacionamentos necessários para o gerenciamento dos chamados.

## Endpoints da API

A API permite cadastrar e consultar usuários e categorias, além de abrir, consultar e atualizar chamados.

A URL base para os testes locais é:

`http://127.0.0.1:8000/api`

### Usuários

| Método | Rota | Descrição |
|---|---|---|
| GET | `/usuarios` | Lista os usuários cadastrados. |
| POST | `/usuarios` | Cadastra um usuário. |

Exemplo de cadastro (`POST /usuarios`):

```json
{
  "nome": "Teste Semana 4",
  "telefone": "51988887777"
}
```

Resposta esperada: `201 Created`, com os dados do usuário cadastrado.

### Categorias

| Método | Rota | Descrição |
|---|---|---|
| GET | `/categorias` | Lista as categorias cadastradas. |
| POST | `/categorias` | Cadastra uma categoria. |

Exemplo de cadastro (`POST /categorias`):

```json
{
  "nome": "Impressora"
}
```

Resposta esperada: `201 Created`, com os dados da categoria cadastrada.

### Chamados

| Método | Rota | Descrição |
|---|---|---|
| GET | `/chamados` | Lista os chamados com seus relacionamentos. |
| POST | `/chamados` | Abre um chamado. |
| GET | `/chamados/{id}` | Consulta um chamado pelo ID. |
| PATCH | `/chamados/{id}` | Atualiza os dados permitidos de um chamado. |

Exemplo de abertura (`POST /chamados`):

```json
{
  "solicitante_id": 10,
  "categoria_id": 5,
  "titulo": "Monitor com defeito",
  "descricao": "O monitor não liga quando pressiono o botão.",
  "prioridade": "Alta"
}
```

O status inicial é definido pela API como `Pendente de Atendimento`, sem precisar ser enviado na requisição.

Resposta esperada: `201 Created`, com os dados do chamado.

Exemplo de atualização (`PATCH /chamados/9`):

```json
{
  "titulo": "Monitor com defeito"
}
```

Resposta esperada: `200 OK`, com os dados atualizados.

### Validações e erros

- Campos obrigatórios ausentes ou dados inválidos retornam `422 Unprocessable Content`.
- A criação de chamado com uma categoria inexistente é rejeitada pela validação.
- A consulta ou atualização de um chamado inexistente retorna `404 Not Found`.

### Teste da API

Antes de realizar os testes, inicie o servidor:

```bash
php artisan serve
```

Os endpoints podem ser testados pelo Postman, usando os métodos HTTP e exemplos apresentados nesta seção.