<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpFoundation\{Request, Response};

const DB_PATH = __DIR__.'/database.yml';

$app = new Silex\Application;

$app['debug'] = getenv('SILEX_PROD') == false;

function json($data): string {
    return json_encode($data, JSON_PRETTY_PRINT);
}

function getDatabase(string $dbname): array {
    return Yaml::parse(file_get_contents(DB_PATH))[$dbname];
}

$db = new PDO(getenv('MYSQL_DSN'), getenv('MYSQL_USERNAME'), getenv('MYSQL_PASSWORD'), [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$app->before(function(Request $request) {
    if (strpos($request->headers->get('Content-Type'), 'application/json') === 0) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : []);
    }
});

$app->get('/products.json/{code}', function(string $code) use($db) {
    $query = $db->prepare('SELECT * FROM products WHERE code = :code');
    $query->bindParam(':code', $code);
    $query->execute();
    $product = $query->fetch();

    foreach (getDatabase('taxonomy') as $group) {
        foreach ($group['categories'] as $category) {
            if($category['name'] == $product['category']) {
                $product += $category;
            }
        }
    }

    return json($product);
});

$app->post('/products.json', function(Request $request) use($db) {
    $query = $db->prepare('INSERT INTO products(code, category, consumption) VALUES(:code, :category, :consumption)');
    $query->bindParam(':code', $request->request->get('code'));
    $query->bindParam(':category', $request->request->get('category'));
    $query->bindParam(':consumption', $request->request->get('consumption'));
    $query->execute();

    return new Response(null, 204);
});

$app->get('/{dbname}.json', function($dbname) {
    return json(getDatabase($dbname));
});

$app->run();
