# Indeed avec Symfony

## Initialisation

- composer create-project symfony/skeleton indeed
- composer require symfony/orm-pack
- composer require --dev symfony/maker-bundle
- symfony console doctrine:database:create
- symfony console make:entity
- symfony console make:migration

Récupérer la db :

- symfony console doctrine:database:create
- symfony console doctrine:migrations:migrate

Création du controller :

- symfony console make:controller
- composer require symfony/twig-bundle

Start :

- symfony server:start

Fausses données:

- composer require orm-fixtures --dev
- composer require fzaninotto/faker --dev
- symfony console doctrine:fixtures:load
