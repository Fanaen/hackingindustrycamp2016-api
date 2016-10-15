<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

const DB_YAML = __DIR__.'/database.yml';
const DB_JSON = __DIR__.'/database.compiled.json';

$app = new Silex\Application();

$app['debug'] = getenv('SILEX_PROD') == false;

$app->get('/database.json', function() {
    if(!file_exists(DB_JSON)) {
        $database = Yaml::parse(file_get_contents(DB_YAML));
        file_put_contents(DB_JSON, $json = json_encode($database, JSON_PRETTY_PRINT));
    }

    return $json ?? file_get_contents(DB_JSON);
});

$app->run();
