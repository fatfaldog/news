# Articles

## Docker
1. `docker-compose up -d --build`
php artisan migrate
2. `docker exec -ti articles-app-1 /bin/bash`

3. Seeder
`php artisan db:seed`

Как проверять:
1. `docker-compose up -d`

2. Установить доступы к папкам
   - `sudo chmod -R 777 storage/logs`
   - `sudo chmod -R 777 vendor/`
   - `sudo chmod -R 777 storage/framework/views`
   
3. Открыть страницу проверки  Graph QL API `http://localhost/graphql-playground`, то есть добавляется в URL справа`/graphql-playground`
   ![Картинка](/public/support/graphql_playground.png)

4. Генерируется Swagger
`\storage\api-docs.json`
    
   
