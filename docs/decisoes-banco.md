# Decisões do Banco de Dados — ChamadoJá

## Usuários

A tabela `usuarios` foi criada para guardar os dados dos usuários do sistema, como nome e telefone.

## Categorias

A tabela `categorias` foi criada para organizar os chamados por tipo de problema, como Hardware e Sistema Operacional.

## Chamados

A tabela `chamados` guarda as informações principais de cada chamado, como título, descrição, prioridade e status.

Ela também possui os campos `solicitante_id` e `categoria_id` para relacionar o chamado com o usuário que o abriu e com sua categoria.

## Comentários

Os comentários ficam em uma tabela separada porque um chamado pode ter vários comentários. Assim, não precisamos colocar vários comentários dentro de um único campo da tabela `chamados`.

## Histórico de Status

O histórico fica separado porque um chamado pode mudar de status várias vezes.

Além do status e da data da alteração, foi colocado o `usuario_id` para saber qual usuário fez a alteração.

## Relacionamentos

As tabelas foram relacionadas por meio das chaves estrangeiras para manter os dados organizados e facilitar as consultas.

- Um usuário pode abrir vários chamados.
- Uma categoria pode estar relacionada a vários chamados.
- Um chamado pode ter vários comentários.
- Um chamado pode ter vários registros no histórico de status.
- Um usuário pode realizar várias alterações de status.