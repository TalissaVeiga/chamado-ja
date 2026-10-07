# Modelo ER — ChamadoJá

## Entidades

### Usuários
- id: identificador do usuário (PK)
- nome: nome do usuário
- telefone: telefone do usuário

### Categorias
- id: identificador da categoria (PK)
- nome: nome da categoria

### Chamados
- id: identificador do chamado (PK)
- solicitante_id: identificador do usuário que abriu o chamado (FK)
- categoria_id: identificador da categoria do chamado (FK)
- titulo: título do chamado
- descricao: descrição do problema
- prioridade: prioridade do chamado
- status: status atual do chamado
- criado_em: data e hora de criação
- atualizado_em: data e hora da última atualização

### Histórico de Status
- id: identificador do histórico (PK)
- chamado_id: identificador do chamado (FK)
- usuario_id: identificador do usuário que realizou a alteração (FK)
- status: status registrado
- alterado_em: data e hora da alteração

### Comentários
- id: identificador do comentário (PK)
- chamado_id: identificador do chamado (FK)
- comentario: conteúdo do comentário

## Relacionamentos

- Um usuário pode abrir vários chamados, e cada chamado pertence a um usuário.
- Uma categoria pode estar associada a vários chamados, e cada chamado pertence a uma categoria.
- Um chamado pode possuir vários comentários, e cada comentário pertence a um chamado.
- Um chamado pode possuir vários registros no histórico de status, e cada registro pertence a um chamado.
- Um usuário pode realizar várias alterações de status, e cada registro do histórico pertence a um usuário.

## Regras

### Prioridade
Os chamados possuem três níveis de prioridade:
- Baixa
- Média
- Alta

### Status
Os chamados possuem os seguintes status:
- Pendente de Atendimento
- Em Atendimento
- Cancelado
- Resolvido