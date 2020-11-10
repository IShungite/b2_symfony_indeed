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

# ENCORE / YARN / SASS

dans un powershell faire :

npm install -g sass
npm install -g yarn

dans le projet faire :

composer require symfony/webpack-encore-bundle
yarn install

le css se trouve dans indeed/assets/style
après avoir modifié faites :

yarn encore dev
yarn encore production

ou le faire automatiquement à chaque fois :

yarn encore dev --watch

Faire dans le terminal:

yarn add sass-loader@^9.0.1 node-sass --dev

(Faire les commandes dessous en adaptant la version de node-sass, pour nous :)

npm uninstall node-sass

npm install node-sass@4.14.1
