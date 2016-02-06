4L Trophy, Team 1, AO
=====================

## Installation
 
* On clone le repository
* `composer install` et `npm install` pour installer les vendors
* `php app/console doctrine:database:create` pour créer la base de donnée
* `php app/console doctrine:migration:migrate` pour créer le modèle de données à partir des migrations
* Le site est accessible à partir de `web/app.php` pour la version de production, ou `web/app_dev.php` pour la version de développement

* Pour travailler : gulp watch
* Pour installer : gulp sass, gulp img, gulp js

## Workflow
**On ne push jamais sur master!!!**
**On pull toujours avec l'option `--rebase`**

* On crée une branche à partir de master, au nom explicite, pour chaque feature développée
* Si la feature est assez conséquente, la découper en plusieurs commits avant de push
* Une fois le dev fini, on push la branche sur le repository externe et on propose la *Pull Request*
* Attendre que l'autre développeur approuve les modifications faites
* En cas de conflit avec le master, les régler

* Une fois la branche mergée, revenir sur le master en local, puis `git pull --rebase`
* Prévenir l'autre développeur que la branche est mergée, afin qu'il puisse également pull
* Résoudre les conflits s'il y en a
* On peut créer une autre branche pour développer autre chose
