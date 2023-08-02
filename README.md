# Formação Alura - Laravel: Crie Aplicações Web em PHP
Este repositório contém o projeto desenvolvido ao longo dos cursos ministrados desta formação, que são:

- **Laravel**: criando uma aplicação com MVC;
- **Laravel**: validando formulários, usando sessões e definindo relacionamentos;
- **Laravel**: transações, service container e autenticação;
- **Laravel**: e-mails, eventos assíncronos, uploads e testes;
- **Laravel**: construindo APIs;

# Aplicação de Controle de Séries
O sistema de controle de séries é uma aplicação web com o objetivo de gerenciar as séries que você está assistindo, organizando os episódios de uma determina série em temporadas com a opção de marcar seus episódios como assistidos ou não. 

O projeto foi implementado de duas formas: a primeira utilizando **MVC**, enquanto a segunda criou-se uma **API Rest**.

## Funcionalidades
- Cadastro de usuário;
- Login de usuário;
- Inserção, remoção, edição e remoção de série;
- Envio de e-mail ao cadastrar série;

# Tecnologias utilizadas

Linguagem:
```
PHP 8.1.2
```

Framework:
```
Laravel 10.16.1
```

Fazer requisições:
```
Postman
```

Views:
```
Blade
```
```
Bootstrap
```

Envio de e-mails:
```
Mailtrap
```

Banco de dados:
```
SQLite
```

## Configurando e Executando o Sistema
Instale o PHP, caso não o possua:
``` 
sudo apt install php
```

### Configurando arquivo .env
Copie o conteúdo do arquivo ``.env.example`` e coloque os seguintes valores nas variáveis de ambiente:
```
APP_NAME="Sistema de Séries"
APP_URL=http://localhost:8000
APP_SSL=false
DB_CONNECTION=sqlite
QUEUE_CONNECTION=database
MAIL_FROM_ADDRESS="contato@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Configurando envio de e-mails
Crie uma conta no  <a href="https://mailtrap.io/">Mailtrap</a>, caso não possua.

Vá na aba ``Email Testing -> Inboxes`` e selecione **Laravel 9+** em ``Integrations``. Aparecerão algumas variáveis de ambiente no seguinte formato:

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=SEU_USERNAME
MAIL_PASSWORD=SUA_SENHA
```

Coloque estas informações no arquivo ``.env``.

### Subindo o banco de dados
Executar as migrations:
```
$ php artisan migrate
```

### Rodando a aplicação
Subir o servidor localmente:
```
$ php artisan serve
```

Subir fila para executar jobs e eventos assíncronos (execute em outro terminal):
```
$ php artisan queue:listen
```

Por fim, acesse a interface na seguinte url:
```
localhost:8000
```