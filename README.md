
# ChamadoJá

## Sobre o projeto

O ChamadoJá é um projeto desenvolvido para ajudar na organização de chamados de suporte técnico. A ideia é permitir que os problemas sejam registrados e acompanhados de forma mais simples, facilitando a consulta das informações e o controle do andamento de cada chamado.

O sistema está sendo desenvolvido como parte do Projeto Integrador do curso.

## Tecnologias utilizadas

- PHP
- Laravel
- PostgreSQL
- Composer
- SQLite (utilizado nos testes automatizados)

## Como executar o projeto

Para rodar o projeto no computador, é necessário ter o PHP, o Composer e o PostgreSQL instalados.

### 1. Instalar as dependências

Dentro da pasta do projeto, execute:

```bash
composer install
```

### 2. Configurar o ambiente

Configure o arquivo `.env` com os dados de conexão do PostgreSQL. Caso ainda não tenha esse arquivo, utilize o `.env.example` como base.

Depois, gere a chave da aplicação:

```bash
php artisan key:generate
```

### 3. Preparar o banco de dados

Crie o banco de dados `chamado_ja` no PostgreSQL e configure a conexão no arquivo `.env`.

Com o banco preparado, execute as migrations:

```bash
php artisan migrate
```

### 4. Iniciar o servidor

Para iniciar a aplicação localmente, utilize:

```bash
php artisan serve
```

## Testando a API

Com o servidor ligado, acesse o endereço abaixo no navegador:

http://127.0.0.1:8000/api/saude

Se estiver tudo funcionando, será exibida uma resposta em JSON indicando que a API está ativa.

## Organização dos arquivos

- `app/Models/`: contém os modelos utilizados para representar os dados e seus relacionamentos.
- `app/Http/Controllers/`: contém os controllers responsáveis pelas funcionalidades da API.
- `database/migrations/`: contém os arquivos que definem a estrutura das tabelas.
- `database/factories/`: contém as configurações para gerar dados fictícios de teste.
- `database/seeders/`: contém os arquivos usados para inserir dados iniciais.
- `routes/api.php`: contém as rotas da API.
- `tests/Feature/`: contém os testes automatizados das funcionalidades.

## Situação atual

O ChamadoJá já possui funcionalidades para cadastrar e consultar usuários e categorias, abrir e atualizar chamados, adicionar comentários, alterar status e consultar o histórico de alterações.

Também foram implementados filtros, paginação e um relatório quantitativo dos chamados.

O projeto conta com validações e testes automatizados para verificar o funcionamento das principais funcionalidades.

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
    "nome": "Maria Silva",
    "telefone": "51999990001"
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
    "nome": "Hardware"
}
```

As categorias utilizadas no projeto são Hardware e Sistema Operacional.

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
    "solicitante_id": 1,
    "categoria_id": 1,
    "titulo": "Computador não liga",
    "descricao": "O computador não está ligando.",
    "prioridade": "Alta"
}
```

O status inicial é definido pela API como `Pendente de Atendimento`, sem precisar ser enviado na requisição.

Resposta esperada: `201 Created`, com os dados do chamado.

Exemplo de atualização (`PATCH /chamados/1`):

```json
{
    "titulo": "Computador apresenta defeito"
}
```

Resposta esperada: `200 OK`, com os dados atualizados.

### Comentários

| Método | Rota | Descrição |
|---|---|---|
| GET | `/chamados/{id}/comentarios` | Consulta os comentários de um chamado. |
| POST | `/chamados/{id}/comentarios` | Adiciona um comentário ao chamado. |

Exemplo de cadastro (`POST /chamados/1/comentarios`):

```json
{
    "usuario_id": 1,
    "comentario": "Verifiquei o problema no computador."
}
```

Resposta esperada: `201 Created`.

### Alteração de status

| Método | Rota | Descrição |
|---|---|---|
| PATCH | `/chamados/{id}/status` | Altera o status de um chamado. |

Os status utilizados são:

- Pendente de Atendimento
- Em Atendimento
- Cancelado
- Resolvido

A API verifica se a alteração de status é permitida antes de salvar a mudança.

### Histórico de status

| Método | Rota | Descrição |
|---|---|---|
| GET | `/chamados/{id}/historico` | Consulta o histórico de alterações de status de um chamado. |

O histórico registra as alterações realizadas, permitindo consultar o status anterior e o novo status.

### Relatórios

| Método | Rota | Descrição |
|---|---|---|
| GET | `/relatorios/resumo-chamados` | Consulta o resumo quantitativo dos chamados. |

O relatório apresenta a quantidade total de chamados e a quantidade por status.

### Filtros e paginação

A listagem de chamados permite realizar consultas utilizando filtros:

- `status`: filtra pelo status do chamado.
- `prioridade`: filtra pela prioridade.
- `categoria_id`: filtra pela categoria.
- `solicitante_id`: filtra pelo usuário solicitante.
- `data_inicio`: filtra pela data inicial.
- `data_fim`: filtra pela data final.

Também é possível ordenar os resultados por data de criação, prioridade ou status.

A listagem utiliza paginação de 15 registros por página.

### Validações e respostas de erro

A API possui validações para evitar o cadastro de informações incorretas ou incompletas.

- Campos obrigatórios ausentes ou dados inválidos retornam `422 Unprocessable Content`, com uma mensagem e os detalhes dos erros.
- Referências inexistentes, como usuário ou categoria, são rejeitadas pela validação.
- A consulta ou atualização de um chamado inexistente retorna `404 Not Found`, com uma mensagem informando que o registro não foi encontrado.

## Testes automatizados

O projeto possui testes automatizados para verificar o funcionamento das principais funcionalidades da API.

Para executar os testes, utilize:

```bash
php artisan test
```

Os testes utilizam SQLite em memória, permitindo verificar as funcionalidades sem precisar utilizar o banco PostgreSQL durante sua execução.

Entre os pontos testados estão:

- Cadastro de usuários e categorias.
- Abertura e consulta de chamados.
- Validação de dados obrigatórios.
- Verificação de referências inexistentes.
- Alteração válida e inválida de status.
- Criação de comentários.
- Filtros e paginação.
