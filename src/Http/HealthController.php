<?php

declare(strict_types=1);

namespace App\Http;

use Twig\Environment;

final class HealthController
{
    public function __construct(
        private readonly Environment $twig,
    ) {
    }

    public function __invoke(): string
    {
        return $this->twig->render(
            'health.html.twig',
            [
                'status' => 'OK <ready>',
            ],
        );
    }
}