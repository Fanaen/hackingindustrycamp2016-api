# hackingindustrycamp2016-api

### Usage

Base de données : `GET https://hackingindustrycamp2016-api.scalingo.io/database.json`.

Le JSON est pretty-printed avec des `\n`, donc le plus simple est de faire "Afficher la source" (CTRL+U) dans un navigateur. Pour les vrais, il y a Postman, et CURL pour les barbus.

### Édition de données

Éditer le fichier YAML `database.yml`. Les structures de données sont les mêmes qu'en JSON (object, array, number, string), plus quelques notations spéciales cool, parce que JSON c'est quand-même un peu faible.

[[ [Cheat Sheet YAML](https://gist.github.com/jonschlinkert/5170877) ]]

Attention à bien respecter la structure des données mise en place.

**Indenter avec des espaces ! Sinon FATAL PARSE ERROR UNRECOVERABLE ERROR hein. Vous aurez tout cassé et toute l'équipe vous en voudra.**

Ensuite, commiter les changements et pusher. Déploiement automatique.