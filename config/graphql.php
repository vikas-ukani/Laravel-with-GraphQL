<?php

declare(strict_types=1);

use App\GraphQL\Types\SkillType;
use App\GraphQL\Queries\SkillsQuery;
use App\GraphQL\Types\Task\TaskType;
use App\GraphQL\Types\User\UserType;
use App\GraphQL\Types\Auth\LoginType;
use App\GraphQL\Queries\Task\TaskQuery;
use App\GraphQL\Queries\User\UsersQuery;
use App\GraphQL\Types\User\MyProfileType;
use App\GraphQL\Queries\User\MyProfileQuery;
use App\GraphQL\Mutations\Auth\LoginUserMutation;
use App\GraphQL\Mutations\Task\CreateTaskMutation;
use App\GraphQL\Mutations\Task\DeleteTaskMutation;
use App\GraphQL\Types\User\PersonalAccessTokenType;
use App\GraphQL\Mutations\Auth\RegisterUserMutation;
use App\GraphQL\Mutations\Skills\CreateSkillMutation;
use App\GraphQL\Mutations\Skills\UpdateSkillMutation;
use App\GraphQL\Mutations\Task\UpdateTaskStatusMutation;

return [
    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'routes' => 'path/to/query/{graphql_schema?}',
    //
    // or define each route
    //
    // 'routes' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    // ]
    //
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Rebing\GraphQL\GraphQLController@query',
    //     'mutation' => '\Rebing\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',

    // Any middleware for the graphql route group
    'middleware' => [],

    // Additional route group attributes
    //
    // Example:
    //
    // 'route_group_attributes' => ['guard' => 'api']
    //
    'route_group_attributes' => [],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'default_schema' => 'default',

    'batching' => [
        // Whether to support GraphQL batching or not.
        // See e.g. https://www.apollographql.com/blog/batching-client-graphql-queries-a685f5bcd41b/
        // for pro and con
        'enable' => true,
    ],

    // The schemas for query and/or mutation. It expects an array of schemas to provide
    // both the 'query' fields and the 'mutation' fields.
    //
    // You can also provide a middleware that will only apply to the given schema
    //
    // Example:
    //
    //  'schema' => 'default',
    //
    //  'schemas' => [
    //      'default' => [
    //          'query' => [
    //              'users' => App\GraphQL\Query\UsersQuery::class
    //          ],
    //          'mutation' => [
    //
    //          ]
    //      ],
    //      'user' => [
    //          'query' => [
    //              'profile' => App\GraphQL\Query\ProfileQuery::class
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //      'user/me' => [
    //          'query' => [
    //              'profile' => App\GraphQL\Query\MyProfileQuery::class
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //  ]
    //
    'schemas' => [
        'default' => [
            'query' => [
                'myprofile' => MyProfileQuery::class,
                'skills' => SkillsQuery::class,
                'tasks' => TaskQuery::class,
                'users' => UsersQuery::class,
            ],
            'mutation' => [
                'newSkill' => CreateSkillMutation::class,
                'updateSkill' => UpdateSkillMutation::class,
                'newTask' => CreateTaskMutation::class,
                'updateTaskStatus' => UpdateTaskStatusMutation::class,
                'deleteTask' => DeleteTaskMutation::class
            ],
            'types' => [
                'token' => PersonalAccessTokenType::class,
                'myprofile' => MyProfileType::class,
                'skill' => SkillType::class,
                'user' => UserType::class,
                'login' => LoginType::class,
                'task' => TaskType::class,
            ],
            'middleware' => [],
            // 'middleware' => ['auth:sanctum'],
            // Which HTTP methods to support; must be given in UPPERCASE!
            'method' => ['GET', 'POST'],
        ],
        'login' => [
            'query' => [],
            'mutation' => [
                'login' => LoginUserMutation::class, // WORKING - Reference `graphql-schemas.md`
            ],
            'types' => [
                'login' => LoginType::class,
                'myprofile' => MyProfileType::class,
                'skill' => SkillType::class,
                'user' => UserType::class,
                'task' => TaskType::class,
                'token' => PersonalAccessTokenType::class
            ],
            'middleware' => [],
            // Which HTTP methods to support; must be given in UPPERCASE!
            'method' => ['GET', 'POST'],
        ],
        'register' => [
            'query' => [],
            'mutation' => [
                'register' => RegisterUserMutation::class,
            ],
            'types' => [
                'myprofile' => MyProfileType::class,
                'skill' => SkillType::class,
                'user' => UserType::class,
                'task' => TaskType::class,
                // 'token' => PersonalAccessTokenType::class
            ],
            'middleware' => [],
            // Which HTTP methods to support; must be given in UPPERCASE!
            'method' => ['GET', 'POST'],
        ],
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     App\GraphQL\Type\UserType::class
    // ]
    //
    'types' => [

        // 'skill' => SkillType::class,
        // ExampleType::class,
        // ExampleRelationType::class,
        // \Rebing\GraphQL\Support\UploadType::class,
    ],

    // The types will be loaded on demand. Default is to load all types on each request
    // Can increase performance on schemes with many types
    // Presupposes the config type key to match the type class name property
    'lazyload_types' => false,

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => [\Rebing\GraphQL\GraphQL::class, 'formatError'],

    /*
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => [\Rebing\GraphQL\GraphQL::class, 'handleErrors'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key' => 'variables',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://webonyx.github.io/graphql-php/security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false,
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    /*
     * You can define your own simple pagination type.
     * Reference \Rebing\GraphQL\Support\SimplePaginationType::class
     */
    'simple_pagination_type' => \Rebing\GraphQL\Support\SimplePaginationType::class,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     */
    'graphiql' => [
        'prefix' => '/graphiql',
        'controller' => \Rebing\GraphQL\GraphQLController::class . '@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'display' => env('ENABLE_GRAPHIQL', true),
    ],

    /*
     * Overrides the default field resolver
     * See http://webonyx.github.io/graphql-php/data-fetching/#default-field-resolver
     *
     * Example:
     *
     * ```php
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     * },
     * ```
     * or
     * ```php
     * 'defaultFieldResolver' => [SomeKlass::class, 'someMethod'],
     * ```
     */
    'defaultFieldResolver' => null,

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,

    /*
     * Automatic Persisted Queries (APQ)
     * See https://www.apollographql.com/docs/apollo-server/performance/apq/
     */
    'apq' => [
        // Enable/Disable APQ - See https://www.apollographql.com/docs/apollo-server/performance/apq/#disabling-apq
        'enable' => env('GRAPHQL_APQ_ENABLE', false),

        // The cache driver used for APQ
        'cache_driver' => env('GRAPHQL_APQ_CACHE_DRIVER', config('cache.default')),

        // The cache prefix
        'cache_prefix' => config('cache.prefix') . ':graphql.apq',

        // The cache ttl in minutes - See https://www.apollographql.com/docs/apollo-server/performance/apq/#adjusting-cache-time-to-live-ttl
        'cache_ttl' => 300,
    ],
];
