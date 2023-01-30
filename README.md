# OOP PHP Test
## Installation du projet:
Si le projet n'est pas déjà cloné:
* `git clone https://github.com/Tiriel/training-lesechos`
* `cd training-lesechos`

Puis:
* `git checkout php-oop`
* `composer install`

## Démarrage du serveur
Le serveur interne de PHP peut être démarré comme suit:
`php -S 127.0.0.1:8000 -t public/`

## Routes disponibles
Les routes suivantes sont reconnues par l'application (définies dans `App\Config\Config::getRoutes()`):
* `/`: main_index, page d'accueil
* `/contact`: main_contact, page de contact
* `/posts`: post_list, index des posts (non-implémentée)
* `/posts/{slug}`: post_show, visionnage d'un post (non-implémentée)

### Implémenter une route:
Pour implémenter une route:
* Créer dans le dossier `Controller` un controller portant le nom de la première partie de la route si il n'éxiste pas + Controller (`App\Controller\PostController` pour les routes `post_*` par exemple)
* Dans ce controller, créer une méthode portant le même nom que la deuxième partie de la route (`list` pour `post_list` par exemple)
* Créer dans le dossier `Templating\Views` une vue portant le nom de la route en PascalCase + View (`App\Templating\Views\PostListView` pour `post_list` par exemple). elle devra étendre `App\Templating\Views\BaseView`
* Prendre exemple sur les vues existantes pour utiliser le système d'héritage et de blocs primitif
