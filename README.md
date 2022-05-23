# API with Symfony without any tool.

    List: GET
        http://localhost:8000/bookmark/list

    Item: GET
        http://localhost:8000/bookmark/{id}

    Create: POST
        http://localhost:8000/bookmark/create

    Delete: DELETE
        http://localhost:8000/bookmark/delete/{id}

_Construction du JSON dans Postman pour la création d'un bookmark: **BODY / RAW / JSON**_

    {
        "url": "https://vimeo.com/76979871"
    }

_Des fixtures sont également à votre disposition pour alimenter rapidement la base de données:_

    php bin/console doctrine:fixtures:load --no-interaction

# Simple Symfony Docker starter

You only need `docker` and `docker-compose` installed

## Start server

The following command will start the development server at URL http://127.0.0.1:8000/:

```bash
./dc up # dc is a wrapper around docker-compose that allows services to be run under the current user
```

## Useful commands

```bash
# Composer is installed into the php container, it can be invoked as such:
./dc exec php composer [command]

# This is a Symfony Flex project, you can install any Flex recipe
./dc exec php composer req annotations

# Symfony console
./dc exec php bin/console

# Start the MySQL cli
./dc exec mysql mysql symfony

# Stop all services
./dc down
```
