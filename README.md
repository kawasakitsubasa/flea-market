#アプリケーション名
　・Flea Market App

## Dockerビルド
   ・git clone git@github.com:kawasakitsubasa/flea-market.git

   ・docker-compose up -d --build

## 環境構築

　　・docker-compose exec php composer install
　　・docker-compose exec php cp .env.example .env
　　・docker-compose exec php php artisan key:generate
　　・docker-compose exec php php artisan migrate
　　・docker-compose exec php php artisan storage:link


## 開発環境
　　・http://localhost/users
    
    ・http://localhost/products

　　・http://localhost/categories

　　・http://localhost/category_product
    
    ・http://localhost/comments

    ・http://localhost/likes

    ・http://localhost/purchases

## 使用技術（実行環境）
　　・PHP 8.x

　　・Laravel 8.x

　　・MySQL 8.x

　　・Docker

　　・Nginx

　　・Stripe


## ER図

