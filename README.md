# PROPOSTA - GERENCIADOR DE CLIENTES

## Descrição

Aplicação CRUD para cadastro e gerenciamento de clientes, com as seguintes informações

- Nome
- Telefone
- CPF
- RG
- Data Nascimento

## Requisitos implementados

- Frontend implementado utilizando Bootstrap 5
- Processamento do Frontend utilizando jQuery (Javascript)
- Backend implementado com a utilização de PHP 8.2.12
- Projeto estruturado usando MVC (Model, View, Controller), separando as funcionalidades em camadas para melhorar o desempenho e facilitar a manutenção
- Função para criação do usuário de acesso
- Função para login | logout
- Funções de criação, edição, leitura e exclusão dos clientes cadastrados

## Passo a Passo para implementar o projeto

### Ambiente

Projeto desenvolvido utilizando o XAMPP, realize a instalação e após instalado, clone o repositório na pasta 

`C:\xampp\htdocs`

![image](/assets/img/image.png)

Abra o XAMPP e ative o  Apache e o MySQL no painel de controle

![image](/assets/img/image_2.png)

Após clonar o projeto, caso a pasta vendor não tenha sido clonada, será necessário rodar o comando `composer install` no Command Line para que as dependências PHP sejam instaladas

![image](/assets/img/image_3.png)

![image](/assets/img/image_4.png)

### Database

Para criar o database necessário para a aplicação rode corretamente, após colocar o XAMPP para rodar, acesse a página de administração do banco através do link

`http://localhost/phpmyadmin/`

![image](/assets/img/image_5.png)

No menu superior, acessar a opção SQL e executar o conteúdo do arquivo `database.sql` que se encontra dentro da pasta `SQL` do projeto

### Utilização

Para acessar a aplicação, entre no seguinte link no navegador:

`localhost/client-management/login/home`

A página inicial do projeto solicitará o login, caso não tenha um, clique no link `Criar novo Acesso?` para ser encaminhado a tela de criação de usuário

![image](/assets/img/image_6.png)

![image](/assets/img/image_7.png)

Ao logar na aplicação, será apresentado o dashboard de gerenciamento dos clientes cadastrados

![image](/assets/img/image_8.png)

### Dasboard

Para adicionar um novo cliente, clique na opção `Adicionar Cliente`, será aberto o formulário com as informações do cliente que seve ser preenchidas

![image](/assets/img/image_9.png)

![image](/assets/img/image_10.png)

Com o cliente cadastrado, para adicionar o endereço(s) para o cliente, acesse a opção `editar`

Será apresentado 3 opções, sendo:

- Informações do cliente
- Editar Cliente
- Adicionar Endereço

#### Informações do cliente

clicando nessa opção, será apresentado as informações do cliente que está sendo editado

![image](/assets/img/image_11.png)

#### Editar Cliente

Clicando nessa opção, será apresentado as informações do cliente possibilitando a edição destas

![image](/assets/img/image_12.png)

#### Adicionar Endereço

Clicando nessa opção, será apresentado o formulário para adicionar endereços para esse cliente

![image](/assets/img/image_13.png)

Ao cadastrar esse endereço, a informação passará a ser apresentada dentro da opção `Informações do Cliente`

![image](/assets/img/image_14.png)

Clicando na opção `DELETE` do endereço, esse endereço será excluído

Por fim, caso deseje excluir o cliente, ao clicar no botão `Excluir` no dashboard, será apresentado a mensagem de confirmação da exclusão

![image](/assets/img/image_15.png)
