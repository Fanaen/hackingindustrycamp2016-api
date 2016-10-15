<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

$app = new Silex\Application;

$app['debug'] = getenv('SILEX_PROD') == false;

$app->get('/{dbname}.json', function($dbname) {
    $yamldb = __DIR__."/tables/{$dbname}.yml";
    $jsondb = __DIR__."/tables-dist/{$dbname}.compiled.json";

    if(!file_exists($jsondb)) {
        $database = Yaml::parse(file_get_contents($yamldb));
        file_put_contents($jsondb, $json = json_encode($database, JSON_PRETTY_PRINT));
    }

    return $json ?? file_get_contents($jsondb);
});

$app->run();
