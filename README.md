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
{
    "openapi": "3.0.0",
    "info": {
        "title": "Article API",
        "version": "0.1"
    },
    "paths": {
        "/api/articles/search": {
            "get": {
                "tags": [
                    "article"
                ],
                "summary": "List of articles",
                "description": "List of articles",
                "operationId": "articleList",
                "parameters": [
                    {
                        "name": "q",
                        "in": "path",
                        "required": false,
                        "schema": {
                            "type": "string"
                        },
                        "example": "NFT"
                    },
                    {
                        "name": "from_date",
                        "in": "path",
                        "required": false,
                        "schema": {
                            "type": "string"
                        },
                        "example": "2021-11-02"
                    },
                    {
                        "name": "to_date",
                        "in": "path",
                        "required": false,
                        "schema": {
                            "type": "string"
                        },
                        "example": "2021-11-02"
                    },
                    {
                        "name": "typename",
                        "in": "path",
                        "required": false,
                        "schema": {
                            "type": "string"
                        },
                        "example": "news"
                    }
                ],
                "responses": {
                    "200": {
                        "description": "Success",
                        "content": {
                            "application/json": {
                                "schema": {
                                    "type": "array",
                                    "items": {
                                        "$ref": "#Article"
                                    }
                                }
                            }
                        }
                    }
                },
                "security": [
                    {
                        "bearer": []
                    }
                ]
            }
        }
    }
}

```
