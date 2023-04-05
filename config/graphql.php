<?php

declare(strict_types=1);

use example\Type\ExampleType;
use example\Query\ExampleQuery;
use example\Mutation\ExampleMutation;
use example\Type\ExampleRelationType;

return [

    'prefix' => 'graphql',

    'routes' => '{graphql_schema?}',

    'controllers' => \Rebing\GraphQL\GraphQLController::class.'@query',

    'middleware' => [],

    'route_group_attributes' => [],

    'default_schema' => 'default',

    'schemas' => [
        'default' => [
            'query' => [
                'calculatePrice' => App\GraphQL\Queries\PriceIndex::class,
            ],
            'mutation' => [
                // 'example_mutation'  => ExampleMutation::class,
            ],
            'middleware' => [],
            'method'     => ['get', 'post'],
        ],
    ],

    'lazyload_types' => false,

    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    'params_key'    => 'variables',

    'security' => [
        'query_max_complexity'  => null,
        'query_max_depth'       => null,
        'disable_introspection' => false,
    ],

    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    'graphiql' => [
        'prefix'     => '/graphiql',
        'controller' => \Rebing\GraphQL\GraphQLController::class.'@graphiql',
        'middleware' => [],
        'view'       => 'graphql::graphiql',
        'display'    => env('ENABLE_GRAPHIQL', true),
    ],

    'defaultFieldResolver' => null,

    'headers' => [],

    'json_encoding_options' => 0,
];
