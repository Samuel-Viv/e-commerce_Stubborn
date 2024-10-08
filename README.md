Projet Symfony Stubborn - Guide d'installation

1/ Les Prérequis: 
Avant de commencer, assurez-vous d'avoir les éléments suivant d'installé sur votre machine.

- PHP: version 8.3 minimum
- Composer
- XAMPP pour créer une base de donnée

2/ Installation du projet

Cloner le dépôt github dans un répertoire local.
Utiliser `composer install` dans le terminal afin d'installer les dependances nécessaires au projet.
Dans le fichier .env changer la base de donner pour `DATABASE_URL="mysql://root:@127.0.0.1:3306/stubborn_test?`.
Créer la base de donnée avec la commande `php bin/console doctrine:database:create`.
Charger la structure de la BDD avec la commande `php bin/console doctrine:migrations:migrate`
Migration des fixtures `php bin/console doctrine:fixtures:load`

3/ Lancer le serveur symfony 

Taper la commande `symfony server:start`

4/ Effectuer un payement avec stripe

 code da la carte banquaire: 4242 4242 4242 
 code secret : n'importe lequel ( 3 chiffre )
