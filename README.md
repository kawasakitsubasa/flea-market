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

ER図

```mermaid
erDiagram

users ||--o{ products : 出品
users ||--o{ comments : コメント
users ||--o{ likes : いいね
users ||--o{ purchases : 購入

products ||--o{ comments : コメント
products ||--o{ likes : いいね
products ||--|| purchases : 購入

products ||--o{ category_product : ""
categories ||--o{ category_product : ""

users {
  bigint id PK
  string name
  string email
  string password
  string zipcode
  string address
  string building
  string avatar
  boolean is_profile_set
  timestamps
}

products {
  bigint id PK
  bigint user_id FK
  string name
  string brand
  text description
  integer price
  string condition
  string image
  timestamps
}

categories {
  bigint id PK
  string name
  timestamps
}

category_product {
  bigint id PK
  bigint product_id FK
  bigint category_id FK
}

comments {
  bigint id PK
  bigint user_id FK
  bigint product_id FK
  text content
  timestamps
}

likes {
  bigint id PK
  bigint user_id FK
  bigint product_id FK
  timestamps
}

purchases {
  bigint id PK
  bigint user_id FK
  bigint product_id FK
  string payment_method
  string zipcode
  string address
  string building
  timestamps
}



