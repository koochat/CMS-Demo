<?php

declare(strict_types=1);

use App\Http\HealthController;
use App\Http\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$twigLoader = new FilesystemLoader(
    dirname(__DIR__) . '/templates',
);

$twig = new Environment(
    $twigLoader,
    [
        'autoescape' => 'html',
    ],
);

$healthController = new HealthController(
    $twig,
);

$router = new Router();

$router->get(
    '/health',
    $healthController
);

return $router;