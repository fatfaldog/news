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
   
9. Тесты `./vendor/bin/phpunit`

10. Настроено обновление каждые 4 часа по CRON. CRON нужно настраивать
```php
    $schedule->command('article:refresh')->everyFourHours();
```


Если интересует GraphQL в проекте ,то открыть страницу проверки  Graph QL API `http://localhost/graphql-playground`, то есть добавляется в URL справа`/graphql-playground`
![Картинка](/public/support/graphql_playground.png)
Можно и по команде
`php artisan article:refresh`

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


**GraphQL Query**
```json
query
{
  allnews
{   
  title
  content
  category
  {
    name
  }
  author
  {
    name
  }
  source
  url
  publishedAt
}
}

```

Result:
```json
{
  "data": {
    "allnews": [
      {
        "title": "Meta’s Andrew Bosworth on moving Facebook to the metaverse",
        "content": "Grayson Blackmon\r\n\n \n\n\n ‘The magnitude of technological shifts that we are trying to manifest here hasn’t been attempted in a long time’ Last week, Facebook announced a major corporate rebrand by cha… [+38546 chars]",
        "category": {
          "name": "NFT"
        },
        "author": {
          "name": "Nilay Patel"
        },
        "source": "The Verge",
        "url": "https://www.theverge.com/22752986/meta-facebook-andrew-bosworth-interview-metaverse-vr-ar",
        "publishedAt": "2021-11-01 13:15:00"
      },
      {
        "title": "Metaverse pioneers unimpressed by Facebook rebrand - Reuters",
        "content": "LONDON, Nov 1 (Reuters) - Early adopters of the virtual worlds known as the metaverse criticised Facebooks rebranding as an attempt to capitalise on growing buzz over a concept that it did not create… [+3186 chars]",
        "category": {
          "name": "NFT"
        },
        "author": {
          "name": "Elizabeth Howcroft"
        },
        "source": "Reuters",
        "url": "https://www.reuters.com/article/facebook-connect-metaverse-idUSL8N2RP6YT",
        "publishedAt": "2021-11-01 10:01:00"
      },
```
