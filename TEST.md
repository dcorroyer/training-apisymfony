# Test technique Klaxoon

_**Note** : Une amélioration à envisager est l'implémentation de tests, avec notamment phpUnit._

_Pour tester les fonctionnalités, j'ai utilisé Postman:_

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

_J'ai également modifié le docker-compose.yml pour y ajouter un phpmyadmin: **http://localhost:8888**_
