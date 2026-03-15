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

## ER図

```mermaid
erDiagram

USERS {
    bigint id
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

PRODUCTS {
    bigint id
    bigint user_id
    string name
    string brand
    text description
    integer price
    string condition
    string image
    timestamps
}

CATEGORIES {
    bigint id
    string name
    timestamps
}

CATEGORY_PRODUCT {
    bigint product_id
    bigint category_id
}

COMMENTS {
    bigint id
    bigint user_id
    bigint product_id
    text content
    timestamps
}

LIKES {
    bigint id
    bigint user_id
    bigint product_id
    timestamps
}

PURCHASES {
    bigint id
    bigint user_id
    bigint product_id
    string payment_method
    string zipcode
    string address
    string building
    timestamps
}

USERS ||--o{ PRODUCTS : exhibits
USERS ||--o{ COMMENTS : writes
USERS ||--o{ LIKES : likes
USERS ||--o{ PURCHASES : buys

PRODUCTS ||--o{ COMMENTS : has
PRODUCTS ||--o{ LIKES : has
PRODUCTS ||--|| PURCHASES : purchased

PRODUCTS ||--o{ CATEGORY_PRODUCT : ""
CATEGORIES ||--o{ CATEGORY_PRODUCT : ""
```


