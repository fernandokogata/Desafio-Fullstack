# Desafio-Fullstack

Este projeto faz parte da etapa de avaliação técnica da Gazin Tech e consiste em um crud de níveis e desenvolvedores.
As tecnologias empregadas foram:
```
* Laravel 11 + php 8.3 (backend);
* Angular + NodeJS 20.18.1 + Angular Material 3 (frontend);
* Banco de dados PostgreSQL;
```
<br>

Para a execução do projeto, foram levados em consideração os requisitos apresentados em forma de README disponibilizados pela Gazin Tech.

## Projeto

O projeto pode ser encontrado através do github pessoal:

```
https://github.com/fernandokogata/Desafio-Fullstack
```

O projeto está dividido em pastas de forma que fique separado o frontend do backend, porém foram criados Dockerfiles e arquivos docker-compose.yml para facilitar a execução do projéto.

** Arquivo de env adicionado ao github para fins de teste!

## Executando por docker

Após clonar o repositório do projeto, navegue até a pasta raiz do mesmo:
```
cd Desafio-Fullstack
```
Nesta pasta existe um arquivo docker-compose.yml que pode ser utilizado para criar os containeres docker na maquina, localmente, e também para deixar os dockers do projeto em execução.
<br>

Execute o comando a seguir para realizar o build dos containeres:

```
docker compose build app frontend
```
Após o termino do processo, podemos subir o projeto através do comando:
```
docker compose up -d
```
que fará o download das imagens restantes necessárias para o projeto (PostgreSQL e nginx).

*O banco tem um script automático para criação das tabelas necessárias ao subir o docker-compose. Caso haja falhas na criação das tabelas, execute o arquivo:
```
create-db.sql
```
pelo pgAdmin4 ou seu gerênciador de banco de dados favorito.

<br>

Para utilizar a aplicação, acesse através do navegador, o link:
```
http://localhost:100
```
## Executando o projeto manualmente

Para rodar o projeto localmente, certifique-se de que possuí todos os pré requisitos listados abaixo:
```
node 20^, angular-cli, php 8^, composer 3^, laravel 11^.
```
### Backend

Faça a configuração de banco de dados presente no arquivo .env da pasta backend, do projéto Laravel (originalmente está utilizando uma rede interna do docker).
<br>
Ainda na pasta backend, execute o comando:
```
composer install
```
Por fim, execute o comando:
```
php artisan serve
```
* A API está originalmente configurada para rodar na porta 8000.

### Frontend

Para execução do frontend, navegue até a pasta frontend e execute o comando:
```
npm install
```
Após instaladas todas as dependências, execute o comando:
```
ng serve
```
Sua aplicação estará sendo executada na porta 4200.

## Testes
O projeto possúi testes simples de requisição na backend, situados na pasta tests.
Para executar todos os testes, execute o comando:
```
php artisan test
```
Porém como trata-se de um CRUD conectado à um banco de dados, alguns testes se executados em ordens diferentes podem vir a falhar.
<br>

Caso deseje rodar algum teste separadamente (use case), navegue até a pasta do mesmo (ex: tests/Feature) e abra o arquivo desejado. No mesmo terá um comentário com o comando necessário para utilizar aquele teste individualmente.
<br>

Na pasta primária do projeto existe um arquivo json com requisições para teste que foram utilizadas no desenvolvimento do projeto através do insomnia.
```
insomnia.json
```
Caso queira, pode-se utilizar o mesmo em aplicações como insomnia e postman para testar as rotas sem a necessidade de utilizar o frontend.