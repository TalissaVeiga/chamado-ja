# Contrato da API - ChamadoJá 

## Chamados 

### GET /api/chamados

consulta os chamados do sistema

### POST /api/chamados

abre um novo chamado

#### Dados enviados

O chamado deverá receber: 

-solicitante
-categoria
-título
-descrição
-prioridade


#### Exemplo de entrada 

**JSON**
{
    "solicitante_id": 1,
    "categoria_id": 2,
    "titulo": "Computador não liga",
    "descricao": "O computador não está ligando.",
    "prioridade": "Alta"
}

#### Exemplo de saída 

**JSON**
{
"id": 1,
    "solicitante_id": 1,
    "categoria_id": 2,
    "titulo": "Computador não liga",
    "descricao": "O computador não está ligando.",
    "prioridade": "Alta"
}

#### GET /api/chamados/{id}

Consulta um chamado


#### PATCH /api/chamados/{id}

Atualiza os dados do chamado.

#### POST /api/chamados/1/comentarios

Registrar comentário 

### Dados enviados

### Exemplo de Entrada 

**JSON**
{
    "comentario": "O computador foi mandado para a manutenção."
}

#### PATCH /api/chamados/{id}/status

Alterar status de um chamado.

#### Dados enviados 

**JSON**

{
    "status": "Resolvido"
}

### GET /api/chamados/{id}/historico

Consultar histórico de chamados. 