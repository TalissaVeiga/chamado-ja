# Pesquisa orientada sobre autenticação 

## 1. Qual é a diferença entre autenticação e autorização? 

A autenticação identifica quem é a pessoa e a autorização mostra o que ela tem permissão para fazer. Um exemplo é que um solicitante pode abrir um chamado, mas não pode alterar seu status, já o atendente pode executar a alteração de status.

## 2. Por que senhas não devem ser armazenadas em texto puro? 

Porque qualquer pessoa que acessar o banco de dados terá acesso a senha dessa pessoa. Para resolver esse problema as senhas são usadas com funções de hash que transforma a senha em um valor que não pode ser revertido para o valor original. 

## 3. O que é um hash de senha?

É o resultado de uma função que converte a senha original em um hash que é um texto com vários símbolos letras e números e depois o armazena no banco de dados no lugar da senha original, impossibilitando de que alguém que tenha acesso ao banco vizualize as senhas dos usuários. Um dado importante também é que não é possível convertê-lo de volta para descobrir a senha original.

## 4. O que é um token de acesso? 

Depois que um usuário faz login pela primeira vez é gerado um token de acesso que basicamente é uma credencial digital gerada pelo sistema para que as próximas vezes que ele for logar não precise necessariamente digitar a senha e login. Nas próximas requisições o token é enviado para a API para verificar se ele já está autenticado. 
Uma observação é que se outra pessoa tiver acesso a essa máquina com o token de acesso mesmo sem ter acesso a senha ela consegue acessar a conta através do token gerado enquanto ele ainda estiver ativo. 

## 5. Para que serve o Laravel Sanctum?

É uma ferramenta Laravel utilizada para gerar tokens de usuarios autenticados após login, verificar esse tokens nas proximas requisições e proteger as rotas que só podem ser acessadas por usuários autenticados. 

## 6. Como uma rota pode exigir um usuário autenticado?

Uma rota exigir a autenticaçao com um intermediário como um middleware. Ele é responsável por verificar se o usuário tem permissão para continuar com a requisição. No Laravel Sanctun podemos utilizar o middleware auth:sanctum pra proteger as rotas API. Assim antes de executar, o sistema vê se o usuário está autenticado ou não. Se estiver autenticado, acessa a rota, caso contrário, será bloqueado. 

## 7. Como um token pode ser revogado?

Quando o token é excluído do banco de dados. Em outras palavras, quando o usuário reaolizar logout o sistema localiza o token e o exclui impedidndo que ele seja usado novamente a não ser que ele realize um novo login. 

## 8. Que dados não devem aparecer nas respostas da API?

Não devem expor as informações que exponham a privacidade e a segurança dos usuários como senhas, tokens de acessos e dados pessoais que não sejam necessários para a operação. 

## 9. Que riscos existem ao deixar todos os endpoints públicos?

Qualquer pessoa poderia consultar, alterar, excluir os dados. Também poderia enviar muitas requisições e sobrecarregar o sistema e explorar possíveis vulnerabilidades. Isso causa problemas de segurança, exposição de dados pessoais, acesso indevido a informações, alterações não autorizadas e exclusão de registros. Por isso importante proteger as rotas e verificar se cada usuário tem permissão para realizar as ações previstas no sistema.

## Funcionalidades que seriam protegidas em uma futura versão

Em uma futura versão do ChamadoJá com autenticação, as seguintes funcionalidades seriam protegidas:

- **Cadastro de usuários:** evitar que pessoas não autorizadas cadastrem usuários.
- **Cadastro de categorias:** controlar quem pode cadastrar novas categorias.
- **Abertura de chamados:** identificar o usuário responsável pela abertura de cada chamado.
- **Alteração de status:** permitir que somente usuários autorizados alterem o status dos chamados.
- **Consulta de relatórios:** evitar que pessoas sem autorização consultem os relatórios do sistema.

## REFERENCIAS 

- **OWASP.** Password Storage Cheat Sheet. Disponível em: https://cheatsheetseries.owasp.org/cheatsheets/Password_Storage_Cheat_Sheet.html

- **OWASP.** REST Security Cheat Sheet. Disponível em: https://cheatsheetseries.owasp.org/cheatsheets/REST_Security_Cheat_Sheet.html

- **Laravel.** Hashing — Laravel 13.x. Disponível em: https://laravel.com/docs/13.x/hashing

- **Laravel.** Authentication — Laravel 13.x. Disponível em: https://laravel.com/docs/13.x/authentication

- **Laravel.** Laravel Sanctum — Laravel 13.x. Disponível em: https://laravel.com/docs/13.x/sanctum

- **Laravel.** Eloquent: Serialization — Laravel 13.x. Disponível em: https://laravel.com/docs/13.x/eloquent-serialization