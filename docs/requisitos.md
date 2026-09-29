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