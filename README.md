
# Patient


Uma api rest com crud de paciente e uma consulta via cep e cadastro de paciente via arquivo csv



### Requerimentos

- docker
- docker-compose

### Encoding
Todos os arquivos estão em UTF-8.


### Tecnologias 

- PHP 8.2
- Laravel 10
- Postgres
- Redis

```
cp -v .env .example .env
```

Subir os container
```
docker-compose up -d
```

Rodar migration

```
php artisan migrate
```

Rodar teste

```
php artisan test
```
Rodar teste covarage

```
 vendor/bin/phpunit --coverage-html coverage
```

Rodar horizon

```
 php artisan horizon
```

Obs:
Acessando a rota raiz da web é possivel adicionar um arquivo csv com os pacientes que será cadastrado de formar assicrona.
Tive dificuldades em passar o arquivo usando o insommnia

http://10.11.0.200/