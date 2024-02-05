# CursoAí - Plataforma de ensino a distância.
CursoAí é um projeto acadêmico visando a construção de uma plataforma online utilizando tecnologias como PHP e MySQL.

## Requisitos funcionais
 - [x] O sistema permitirá que usuários sejam cadastrados, classificando-os como: usuário comum ou Administrador
 - [x] O sistema permitirá que os usuários façam alterações em seus cadastros.
 - [x] O cadastro deverá conter: nome, login, senha, data de nascimento, telefone,
endereço, e-mail, CEP, bairro, cidade e estado. USUÁRIOS/LOGIN.
 - [x] O sistema permitirá o acesso dos usuários através do login e senha.
 - [x] O sistema permitirá ao usuário administrador o cadastro, a edição e exclusão de cursos do sistema.
 - [x] O usuário comum poderá se inscrever em um curso no sistema.
 - [x] Um usuário não pode fazer mais de um curso na mesma data/horário.

## Requisitos não funcionais
 - [x] O sistema deve ser desenvolvido em linguagem PHP.
 - [x] O banco de dados deve ser desenvolvido no MySQL.
 - [x] A interface deve ser agradável e de fácil utilização.
 - [x] O aplicativo deve consumir poucos recursos do navegador
 - [x] O aplicativo não deverá armazenar dados localmente, sendo estes redirecionados a um
 servidor externo.
 - [x] O aplicativo fará uso de um WebService na linguagem PHP para troca de informações entre sistema e servidor.

## Regras de negócio
 - [x] O usuário deverá estar logado no sistema para acessar as funcionalidades.
 - [ ] Nos campos da tela de Login, se a tecla “Shift” estiver pressionada, mostrar uma mensagem informando ao usuário.
 - [x] Para realizar o login, o cliente deverá obrigatoriamente preencher os campos e-mail e senha.
 - [x] O usuário administrador terá acesso a todas as funcionalidades do sistema.
 - [x] Os campos de preenchimento obrigatório deverão conter um asterisco na descrição.
 - [x] O campo e-mail do cadastro de usuário deverá conter um domínio.
 - [x] Os cursos devem ser selecionados a partir de uma lista pré-cadastrada pelo Administrador.