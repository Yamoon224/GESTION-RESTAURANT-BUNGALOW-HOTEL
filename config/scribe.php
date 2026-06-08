<?php

use Knuckles\Scribe\Extracting\Strategies;

return [
    'title' => 'Documentation API Synchronisation',
    'description' => 'API de synchronisation des produits et des commandes pour le systeme externe.',
    'base_url' => env('APP_URL', 'http://localhost'),

    'routes' => [
        [
            'match' => [
                'prefixes' => ['api/sync*'],
                'domains' => ['*'],
                'versions' => [],
            ],
            'include' => [],
            'exclude' => [],
        ],
    ],

    'type' => 'static',
    'theme' => 'default',

    'static' => [
        'output_path' => 'public/docs',
    ],

    'laravel' => [
        'add_routes' => false,
        'docs_url' => '/docs',
        'assets_directory' => null,
        'middleware' => [],
    ],

    'external' => [
        'html_attributes' => [],
    ],

    'try_it_out' => [
        'enabled' => false,
        'base_url' => null,
        'use_csrf' => false,
        'csrf_url' => '/sanctum/csrf-cookie',
    ],

    'auth' => [
        'enabled' => true,
        'default' => true,
        'in' => 'bearer',
        'name' => 'Authorization',
        'use_value' => env('SYNC_API_TOKEN'),
        'placeholder' => '{YOUR_SYNC_API_TOKEN}',
        'extra_info' => 'Envoyez le jeton dans le header `Authorization: Bearer {token}` ou via `X-Api-Token`.',
    ],

    'intro_text' => <<<INTRO
Cette documentation couvre les endpoints de synchronisation exposes par l'application.

Tous les endpoints necessitent un jeton defini dans `SYNC_API_TOKEN`.
INTRO,

    'example_languages' => [
        'bash',
        'javascript',
        'php',
    ],

    'postman' => [
        'enabled' => true,
        'overrides' => [],
    ],

    'openapi' => [
        'enabled' => true,
        'overrides' => [],
    ],

    'groups' => [
        'default' => 'Synchronisation',
        'order' => [
            'Synchronisation Produits',
            'Synchronisation Commandes',
        ],
    ],

    'logo' => false,
    'last_updated' => 'Derniere generation: {date:d/m/Y H:i}',

    'examples' => [
        'faker_seed' => 1234,
        'models_source' => ['factoryMake', 'databaseFirst'],
    ],

    'strategies' => [
        'metadata' => [
            Strategies\Metadata\GetFromDocBlocks::class,
            Strategies\Metadata\GetFromMetadataAttributes::class,
        ],
        'urlParameters' => [
            Strategies\UrlParameters\GetFromLaravelAPI::class,
            Strategies\UrlParameters\GetFromUrlParamAttribute::class,
            Strategies\UrlParameters\GetFromUrlParamTag::class,
        ],
        'queryParameters' => [
            Strategies\QueryParameters\GetFromFormRequest::class,
            Strategies\QueryParameters\GetFromInlineValidator::class,
            Strategies\QueryParameters\GetFromQueryParamAttribute::class,
            Strategies\QueryParameters\GetFromQueryParamTag::class,
        ],
        'headers' => [
            Strategies\Headers\GetFromHeaderAttribute::class,
            Strategies\Headers\GetFromHeaderTag::class,
            [
                'override',
                [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
            ],
        ],
        'bodyParameters' => [
            Strategies\BodyParameters\GetFromFormRequest::class,
            Strategies\BodyParameters\GetFromInlineValidator::class,
            Strategies\BodyParameters\GetFromBodyParamAttribute::class,
            Strategies\BodyParameters\GetFromBodyParamTag::class,
        ],
        'responses' => [
            Strategies\Responses\UseResponseTag::class,
            Strategies\Responses\UseResponseFileTag::class,
        ],
        'responseFields' => [
            Strategies\ResponseFields\GetFromResponseFieldAttribute::class,
            Strategies\ResponseFields\GetFromResponseFieldTag::class,
        ],
    ],
];