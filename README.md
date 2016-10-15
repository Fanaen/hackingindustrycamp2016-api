# hackingindustrycamp2016-api

## Usage

Base de données : `GET https://hackingindustrycamp2016-api.scalingo.io/{DATABASE_NAME}.json`.

Le JSON est pretty-printed avec des `\n`, donc le plus simple est de faire "Afficher la source" (CTRL+U) dans un navigateur. Pour les vrais, il y a Postman, et CURL pour les barbus.

## Référentiels

### [subscriptions.json](https://hackingindustrycamp2016-api.scalingo.io/subscriptions.json)

```json
{
    "subscriptions": [
        {
            "id": "base3",
            "type": "base",
            "power": 3,
            "price": 4.67,
            "low": 0.1564,
            "high": 0.1564
        },
        {
            "id": "hc6",
            "type": "hc",
            "power": 6,
            "price": 8.38,
            "low": 0.127,
            "high": 0.156
        },
        ...
    ]
}
```

### [taxonomy.json](https://hackingindustrycamp2016-api.scalingo.io/taxonomy.json)

@ TODO


## Édition de données

Éditer les fichiers YAML dans `tables/*`. Les structures de données sont les mêmes qu'en JSON (object, array, number, string), plus quelques notations spéciales cool, parce que JSON c'est quand-même un peu faible.

[[ [Cheat Sheet YAML](https://gist.github.com/jonschlinkert/5170877) ]]

Attention à bien respecter la structure des données mise en place.

**Indenter avec des espaces ! Sinon FATAL PARSE ERROR UNRECOVERABLE ERROR hein. Vous aurez tout cassé et toute l'équipe vous en voudra.**

Ensuite, commiter les changements et pusher. Déploiement automatique.