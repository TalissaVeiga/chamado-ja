# Requisitos do ChamadoJá

## 1. Objetivo do sistema:

O ChamadoJá é uma API de gestão de chamados de suporte técnico. O sistema tem como objetivo registrar, classificar e fornecer o acompanhamento e a consulta das solicitações de suporte.

A API deverá organizar as informações dos chamados para ajudar no atendimento e facilitar o acompanhamento da situação. 

## 2. Descrição do Problema:

Busca organizar o processo de atendimento das solicitações de suporte técnico.

O sitema deve permitir que os chamados sejam organizados, registrados e acompanhados de forma estruturada, sendo possível consultar informações como solicitante, categoria, prioridade e status do chamado.

Também será possível registrar comentários, alterar status e consultar o histórico das alterações do status. 

## 3. Público que utilizará a aplicação:

Utilizado por pessoas envolvidas na solicitação e atendimento de chamada de suporte técnico. 

Os principais usuários são: 

**Solicitante:** Pessoa que registra uma solicitação e acompanha seu chamado. 
**Atendente:** Pessoa responsável por consultar e acompanhar os chamados de suporte. 

## 4. Requisitos funcionais:

O sistema deverá:

- RF01 - Cadastrar usuários.
- RF02 - Consultar usuários.
- RF03 - Cadastrar categorias de chamados.
- RF04 - Consultar categorias de chamados.
- RF05 - Abrir chamados de suporte.
- RF06 - Consultar chamados.
- RF07 - Atualizar dados de um chamado.
- RF08 - Filtrar chamados.
- RF09 - Paginar a listagem de chamados.
- RF10 - Registrar comentários em chamados.
- RF11 - Alterar o status de um chamado.
- RF12 - Armazenar o histórico de alterações de status.
- RF13 - Consultar o histórico de um chamado.
- RF14 - Consultar um resumo quantitativo dos chamados.

## 5. Requisitos não funcionais:

- RNF01 - A aplicação deverá ser desenvolvida utilizando Laravel.
- RNF02 - A aplicação deverá utilizar PostgreSQL como banco de dados.
- RNF03 - A API deverá possuir validações para os dados recebidos.
- RNF04 - O projeto deverá possuir testes básicos.
- RNF05 - O projeto deverá possuir documentação de instalação.
- RNF06 - A API deverá possuir documentação dos endpoints.
- RNF07 - As decisões técnicas do projeto deverão ser documentadas.

## 6. Regras iniciais de prioridade e status: 

O ChamadoJá terá três tipos de prioridades: Baixa, Média e Alta. 

A prioridade deverá ser definida pelo solicitante no ato do registro do chamado.

O ChamadoJá terá três tipos de status: Pendente de Atendimento, Em Atendimento, Cancelado e Resolvido. 

## 7. Limites do escopo: 

- Cadastrar e consultar usuários;
- Cadastrar e consultar categorias;
- Registrar chamados e sua prioridade;
- Atualizar chamados;
- Filtrar e paginar chamados;
- Abrir e conultar chamados e seu histórico;
- Alterar status;
- Guardar histórico de status;
- Adicionar comentários;
- Fornecer o resumo da quantidade de chamados já registrados; 

## 8. Dúvidas e hipóteses da equipe:

Se a prioridade do chamado é definida pelo solicitante haverá um problema de fluxo pelo fato de que alguns solicitantes terão a possibilidade de colocar prioridade Alta em todos os chamados para que tentem ser atendidos com mais agilidade, e a depender da quantidade de atendentes disponíveis isso poderia causar um fluxo muito grande de chamados de alta prioridade. Então uma solução seria trocar a definição do solicitante para que o atendente realizasse a classificação da prioridade, porém isso geraria mais uma função pro atendente, que seria a de triagem dos chamados antes de poder começar a resolvê-los e isso resultaria em deixar a resolução dos chamados mais lenta. A não ser que fosse implementado uma terceira pessoa além do solicitante e o atendente, alguém responsável só pela triagem. Assim o atendente só abriria e resolveria os chamados pelo nível de prioridade e isso tornaria o sistema de atendimento mais ágil para o solicitante. 
