# Minha primeira API.
## Antes de começar:
Após clonar o repositório é necessário fazer as migrações do banco de dados. Em seguida é necessário criar um usuário no banco (veja como abaixo). Talvez seja necessário executar o comando "composer require laravel/passport". Ao executar o comando "php artisan passaport:install" serão gerados dois clientes, um pessoal e um para gerar senha, cada um com sua respectiva chave secreta. Inicie o servidor com o comando "php artisan serve".

No Postman, crie uma nova requisição do tipo POST e acesse a url http://127.0.0.1:8000/oauth/token , selecione a aba Body e o tipo form-data, então adicione as chaves e valores a seguir:

chave | valor
grant_type | password
client_id | 2
client_secret | cole a chave secreta gerada anteriormente para o cliente 2
username | e-mail que foi inserido no banco de dados
password | senha inserida no banco de dados
scope | deixe vazio

Na resposta do Postman, terá um campo chamado "access_token". Copie a chave sem as aspas. Abra outra requisição do Postman do tipo GET, acesse http://127.0.0.1:8000/api/v1/user , na aba headers adicione as chaves e valores a seguir:

chave | valor
Accept | application/json
Authorization | Escreva a palavra Bearer, dê um espaço e cole o access_token de antes

Se tudo der certo, você verá o usuário que criou na resposta do Postman e terá acesso a todas as funcionalidades da API.

### Artisan Tinker:
Basta usar o comando 'php artisan tinker' no terminal dentro da raiz do projeto, em seguida digitando o comando "DB::table('users')->insert(['name'=>'escolha_um_nome', 'email'=>'um_email@dominio.com', 'password'=>Hash::make('escolha_uma_senha')])".

### Laravel Seeder:
Dentro da pasta do projeto execute o comando "php artisan make:seeder UserSeeder" no terminal, em seguida coloque os campos 'name', 'email' e 'password' no método run. Execute o comando "php artisan db:seed --class=UserSeeder".

## Como usar:
Basta acessar as rotas com o tipo de requisição que deseja realizar.

## Rotas:
prefixo: /api/v1
- /tasks [GET]: retorna todas as tarefas do banco de dados e as tags de cada uma, caso existam
- /tasks [POST]: adiciona nova tarefa 
- /tasks/:id [PUT]: edita uma tarefa específica
- /tasks/:id/status [PATCH]: altera o status da tarefa
- /tasks/:id/tag [POST]: adiciona tag à tarefa
- /tasks/:id/file_url [GET]: retorna a url da tarefa com status aprovado