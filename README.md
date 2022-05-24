
# Teste para processo seletivo iPORTO

### Como foi feito o projeto:

Foram criadas duas commands utilizando Artisan console, dentro de um projeto Laravel. A primeira busca os dados na Api e cadastra o preço da moeda no banco de dados;&nbsp;
A segunda verifica a média dos últimos preços cadastrados e informa se o valor é 0.5% menor que o preço médio.
Foi criado no Banco de dados, através das migrations, uma tabela que armazena o Symbol e o BidPrice da moeda informada. Foi utilizado Eloquet para consultas e cadastro no banco  de dados.

### Requisitos:

Requisitos:
**Composer versão 2.1
**Laravel 9
**PHP ^8.0

### Instalação:

Para rodar o projeto execute os passos abaixo:
1. Clone o repositório em um ambiente local
2. Abra a pasta do projeto em um terminal
3. Execute o comando "composer install"
4. Configue uma base de dados mysql no arquivo .env na raíz do projeto
5. Depois de configurar o arquivo .env execute o comando "php artisan key:generate"
6. Execute o comando para executar as migrations no seu banco de dados "php artisan migrate"
7. Depois é só executar os comandos "php artisan c:saveBidPriceOnDataBase" e "php artisan c:checkAvgBigPrice" para executar as funcões do teste.

