<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

const DB_PATH = __DIR__.'/database.yml';

$app = new Silex\Application;

$app['debug'] = getenv('SILEX_PROD') == false;

$app->get('/{dbname}.json', function($dbname) {
    $database = Yaml::parse(file_get_contents(DB_PATH))[$dbname];

    return json_encode($database, JSON_PRETTY_PRINT);
});

$app->run();
