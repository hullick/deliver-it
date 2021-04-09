Talk about groups Unit testing
Add XDebug for test coverage

## Sobre este projeto

Este é um projeto de teste para a [DeliverIt](http://deliverit.com.br/).

### Definição do objetivo

Serviços a serem criados:

   - Inclusão de corredores para uma corrida
      - ID único
      - Nome
      - CPF
      - Data de nascimento

   - Inclusão de provas
      - Id da prova
      - Tipo de prova (3, 5, 10, 21, 42km)
      - Data

   - Inclusão de corredores em provas
      - ID do corredor
      - ID da prova

   - Inclusão de resultados dos corredores
      - ID do corredor
      - ID da prova
      - Horário de início da prova
      - Horário de conclusão da prova

   - Listagem de classificação das provas por idade
      - ID da prova
      - Tipo de prova
      - ID do corredor
      - Idade
      - Nome do corredor
      - Posição

   - Listagem de classificação das provas gerais
      - ID da prova
      - Tipo de prova
      - ID do corredor
      - Idade
      - Nome do corredor
      - Posição

Regras de negócio

   - Todos os campos são obrigatórios.
   - Não é permitido cadastrar o mesmo corredor em duas provas diferentes na mesma data. Por exemplo, o corredor Barry Allen não pode estar cadastrado nas provas de 21km e 42km no dia 05/10/2019.
   - Não é permitida a inscrição de menores de idade.
   - As classificações são definidas pelo menor tempo de prova.
   - A listagem de classificações por idade deve apresentar as posições dos candidatos dentro dos seguintes grupos em cada tipo de prova:
      - 18 – 25 anos
      - 25 – 35 anos
      - 35 – 45 anos
      - 45 – 55 anos
      - Acima de 55 anos
      ** Por exemplo, as colocações de 18 -25 na prova de 3km apresentarão os 1º, 2º, 3º, ..., nesta faixa de idade, o mesmo para as outras faixas e tipos de provas.
   - A listagem de classificações gerais deve ser separada por tipos de provas.

## Rodando o projeto

Para executar o projeto, em ambientes linux, instale as ferramentas [Docker Composer](https://docs.docker.com/compose/) e [PHP Composer](https://getcomposer.org/), siga para a pasta raiz do projeto e execute o comando, copie o arquivo `.env.example` para `.env` e execute o comando `docker-compose up -d`.

Execute o comando `docker exec -it deliver-it php artisan migrate` para criar as tabelas e popular com uma corrida, diversos usuários e suas inscrições e resultados.

Para pegar o ip do container e acessar o serviço, utilize o comando `docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' deliver-it`.


### Rotas dos serviços

Este projeto utiliza o [Orion](https://tailflow.github.io/laravel-orion-docs/) para criar as pontas das APIs, dê uma olhada nas [rotas padrões](https://tailflow.github.io/laravel-orion-docs/guide/models.html#setting-up-controller) geradas por ele.

Para listar todas as rotas registradas no projeto, utilize o comando `docker exec -it deliver-it php artisan route:list`.

   - Prova: api/races
   - Corredores: api/runners
   - Inscrições na prova: api/race/{race}/runners-subscribed
   - Resultados da prova agrupados por idade: api/race/{id}/grouped-results
   - Resultados gerais da prova: api/race/{id}/results

   *** Considerar índice do resultado como posição.

## Executando testes

Para executar os testes unitários, execute o comando `docker exec -it deliver-it php artisan migrate`. Testes lentos, pois dá-se um refresh toda a vez que o teste é executado.
