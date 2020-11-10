# Indeed avec Symfony

## Initialisation

- composer create-project symfony/skeleton indeed
- composer require symfony/orm-pack
- composer require --dev symfony/maker-bundle
- symfony console doctrine:database:create
- symfony console make:entity
- symfony console make:migration

R�cup�rer la db :

- symfony console doctrine:database:create
- symfony console doctrine:migrations:migrate

Cr�ation du controller :

- symfony console make:controller
- composer require symfony/twig-bundle

Start :

- symfony server:start

Fausses donn�es:

- composer require orm-fixtures --dev
- composer require fzaninotto/faker --dev
- symfony console doctrine:fixtures:load
