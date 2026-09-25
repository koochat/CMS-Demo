<?php

declare(strict_types=1);

use App\Http\Router;

require_once dirname(__DIR__) . '/vendor/autoload.php';

/** @var Router $router */
$router = require dirname(__DIR__) . '/bootstrap/app.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';

$path = parse_url(
    $requestUri,
    PHP_URL_PATH
);

if (!is_string($path)) {
    $path = '/';
}

$handler = $router->dispatch(
    $method,
    $path
);

if ($handler === null) {
    http_response_code(404);

    echo 'Not Found';

    return;
}

http_response_code(200);

echo $handler();