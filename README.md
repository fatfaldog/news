# Articles

## Docker
1. Постройка докером `docker-compose up -d --build`

2. Вход в контейнер`docker exec -ti articles-app-1 /bin/bash`

3. Миграция `php artisan migrate`

4. Чтобы загрузить тестовые категории. Выполняется в контейнере
`php artisan db:seed`

Запуск контейнеров:
5. `docker-compose up -d`

6. Установить доступы к папкам
   - `sudo chmod -R 777 storage/logs`
   - `sudo chmod -R 777 vendor/`
   - `sudo chmod -R 777 storage/framework/views`
   


7. Генерируется Swagger для описания API
Команда `php artisan swagger:generate`
`\storage\api-docs.json`

8. Команда дял загрузки с `https://newsapi.org/v2/everything` статей
`php artisan article:refresh`
Это основная команда. В ней выполняется парсинг. 
   
10. Тесты `./vendor/bin/phpunit`



Если интересует GraphQL в проекте ,то открыть страницу проверки  Graph QL API `http://localhost/graphql-playground`, то есть добавляется в URL справа`/graphql-playground`
![Картинка](/public/support/graphql_playground.png)

**Структура БД**

```mysql 
#Статьи
create table articles
(
id          bigint unsigned auto_increment
primary key,
title       varchar(255)    null,
source      varchar(255)    null,
author_id   bigint unsigned null,
description text            null,
url         varchar(255)    null,
urlToImage  text            null,
publishedAt timestamp       null,
content     text            null,
typename    text            not null,
created_at  timestamp       null,
updated_at  timestamp       null,
category_id bigint unsigned not null,
constraint articles_author_id_foreign
foreign key (author_id) references authors (id),
constraint articles_category_id_foreign
foreign key (category_id) references categories (id)
)`


#Авторы
`create table authors
(
id         bigint unsigned auto_increment
primary key,
name       varchar(255) not null,
created_at timestamp    null,
updated_at timestamp    null
)


#Категории статей
`create table categories
(
id         bigint unsigned auto_increment
primary key,
name       varchar(255) not null,
created_at timestamp    null,
updated_at timestamp    null
)
```

**Swagger-документация**
Она есть в коде но все равно выложил
```json
<?php

return [
    'api' => [
        /*
        |--------------------------------------------------------------------------
        | Edit to set the api's title
        |--------------------------------------------------------------------------
         */
        'title' => 'Swagger Lume API',
    ],

    'routes' => [
        /*
        |--------------------------------------------------------------------------
        | Route for accessing api documentation interface
        |--------------------------------------------------------------------------
         */
        'api' => '/api/documentation',

        /*
        |--------------------------------------------------------------------------
        | Route for accessing parsed swagger annotations.
        |--------------------------------------------------------------------------
         */
        'docs' => '/docs',

        /*
        |--------------------------------------------------------------------------
        | Route for Oauth2 authentication callback.
        |--------------------------------------------------------------------------
        */
        'oauth2_callback' => '/api/oauth2-callback',

        /*
        |--------------------------------------------------------------------------
        | Route for serving assets
        |--------------------------------------------------------------------------
        */
        'assets' => '/swagger-ui-assets',

        /*
        |--------------------------------------------------------------------------
        | Middleware allows to prevent unexpected access to API documentation
        |--------------------------------------------------------------------------
         */
        'middleware' => [
            'api' => [],
            'asset' => [],
            'docs' => [],
            'oauth2_callback' => [],
        ],
    ],

    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Absolute path to location where parsed swagger annotations will be stored
        |--------------------------------------------------------------------------
         */
        'docs' => storage_path('api-docs'),

        /*
        |--------------------------------------------------------------------------
        | File name of the generated json documentation file
        |--------------------------------------------------------------------------
        */
        'docs_json' => 'api-docs.json',

        /*
        |--------------------------------------------------------------------------
        | Absolute path to directory containing the swagger annotations are stored.
        |--------------------------------------------------------------------------
         */
        'annotations' => base_path('app'),

        /*
        |--------------------------------------------------------------------------
        | Absolute path to directories that you would like to exclude from swagger generation
        |--------------------------------------------------------------------------
         */
        'excludes' => [],

        /*
        |--------------------------------------------------------------------------
        | Edit to set the swagger scan base path
        |--------------------------------------------------------------------------
        */
        'base' => env('L5_SWAGGER_BASE_PATH', null),

        /*
        |--------------------------------------------------------------------------
        | Absolute path to directory where to export views
        |--------------------------------------------------------------------------
         */
        'views' => base_path('resources/views/vendor/swagger-lume'),
    ],

    /*
    |--------------------------------------------------------------------------
    | API security definitions. Will be generated into documentation file.
    |--------------------------------------------------------------------------
    */
    'security' => [
        /*
        |--------------------------------------------------------------------------
        | Examples of Security definitions
        |--------------------------------------------------------------------------
        */
        /*
        'api_key_security_example' => [ // Unique name of security
            'type' => 'apiKey', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
            'description' => 'A short description for security scheme',
            'name' => 'api_key', // The name of the header or query parameter to be used.
            'in' => 'header', // The location of the API key. Valid values are "query" or "header".
        ],
        'oauth2_security_example' => [ // Unique name of security
            'type' => 'oauth2', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
            'description' => 'A short description for oauth2 security scheme.',
            'flow' => 'implicit', // The flow used by the OAuth2 security scheme. Valid values are "implicit", "password", "application" or "accessCode".
            'authorizationUrl' => 'http://example.com/auth', // The authorization URL to be used for (implicit/accessCode)
            //'tokenUrl' => 'http://example.com/auth' // The authorization URL to be used for (password/application/accessCode)
            'scopes' => [
                'read:projects' => 'read your projects',
                'write:projects' => 'modify projects in your account',
            ]
        ],*/

        /* Open API 3.0 support
        'passport' => [ // Unique name of security
            'type' => 'oauth2', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
            'description' => 'Laravel passport oauth2 security.',
            'in' => 'header',
            'scheme' => 'https',
            'flows' => [
                "password" => [
                    "authorizationUrl" => config('app.url') . '/oauth/authorize',
                    "tokenUrl" => config('app.url') . '/oauth/token',
                    "refreshUrl" => config('app.url') . '/token/refresh',
                    "scopes" => []
                ],
            ],
        ],
        */
    ],

    /*
    |--------------------------------------------------------------------------
    | Turn this off to remove swagger generation on production
    |--------------------------------------------------------------------------
     */
    'generate_always' => env('SWAGGER_GENERATE_ALWAYS', false),

    /*
    |--------------------------------------------------------------------------
    | Edit to set the swagger version number
    |--------------------------------------------------------------------------
     */
    'swagger_version' => env('SWAGGER_VERSION', '3.0'),

    /*
    |--------------------------------------------------------------------------
    | Edit to trust the proxy's ip address - needed for AWS Load Balancer
    |--------------------------------------------------------------------------
     */
    'proxy' => false,

    /*
    |--------------------------------------------------------------------------
    | Configs plugin allows to fetch external configs instead of passing them to SwaggerUIBundle.
    | See more at: https://github.com/swagger-api/swagger-ui#configs-plugin
    |--------------------------------------------------------------------------
    */

    'additional_config_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Apply a sort to the operation list of each API. It can be 'alpha' (sort by paths alphanumerically),
    | 'method' (sort by HTTP method).
    | Default is the order returned by the server unchanged.
    |--------------------------------------------------------------------------
    */

    'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),

    /*
    |--------------------------------------------------------------------------
    | Uncomment to pass the validatorUrl parameter to SwaggerUi init on the JS
    | side.  A null value here disables validation.
    |--------------------------------------------------------------------------
    */

    'validator_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Uncomment to add constants which can be used in anotations
    |--------------------------------------------------------------------------
     */
    'constants' => [
        // 'SWAGGER_LUME_CONST_HOST' => env('SWAGGER_LUME_CONST_HOST', 'http://my-default-host.com'),
    ],
]

```
