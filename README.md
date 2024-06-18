# Diwali Sale Campaign

## Requirement 
PHP Version 8.2 or later
Laravel 11
Composer 2.7.6
MYSQL 8

## Enable the sodium extension in your php.ini for updating dependancy for laravel passport
extension=sodium;

## In this Project you will be seen the robust application, follows best practices code standard which makes the code more maintainable and testable.
For Example

Dependency injection- Allows for better separation of concerns and makes the code more maintainable and testable.
Services Class - that contains the business logic for processing the products and determining the discounted and payable items.
Product Controller -The ProductController uses dependency injection to get an instance of the ProductService.
Repository Pattern - Follow the repository pattern to organized and maintained through the seperating the data access layer from Business logic e.g
UserRepository class - which is for the User registration and login.

Create User Request - For the Better Validation rules defined in single places of user request class and make customized validation as well.

## To setup the project, follow the step as below.

## Step-1  Clone the project from the repository
git clone https://github.com/austinPatel/DiwaliSaleCampaign.git

## Step-2 Composer install 
composer install

## step-3 Change the database configuration based on your environment of database you used.

For Example:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=diwalisalecampaign
DB_USERNAME=root
DB_PASSWORD=

## Step-4 Migrate the database to create schema in your database.
php artisan migrate

## After all above step done, start the laravel server to execute and used the apiendpoint for this application.
php artisan serve

Copy the link which is given laravel server
For example
http://127.0.0.1:8000/

## Please find the below API Endpoint Routing

User Registration - sign up the user account

## [/api/register](http://127.0.0.1:8000/api/register)

Request Payload (Input Parameters)
{
    "name":"XYZ",
    "email": "XYZ@localhost.com",
    "password":"123456",
    "confirm_password":"123456"
}
Response
{
    "success": true,
    "data": {
        "user": {
            "name": "Hardik Patel",
            "email": "hardik@localhost.com",
            "updated_at": "2024-06-17T21:11:12.000000Z",
            "created_at": "2024-06-17T21:11:12.000000Z",
            "id": 1
        }
    },
    "message": "User Successfully register"
}

User Login - User login
## [/api/login] (http://127.0.0.1:8000/api/login)

Request Payload
{
    "email": "XYZ@localhost.com",
    "password":"123456",
}
Response
{
    "success": true,
    "data": {
        "token": "<User Token>",
        "user_detail": {
            "id": 1,
            "name": "XYZ",
            "email": "XYZ@localhost.com",
            "email_verified_at": null,
            "created_at": "2024-06-17T21:11:12.000000Z",
            "updated_at": "2024-06-17T21:11:12.000000Z"
        }
    },
    "message": "Successfully Login"
}

## [/api/buy-product] (http://127.0.0.1:8000/api/buy-product)

Rule - 1 Customers can buy one product and get another product for free as long as the price of the free product is equal to or less than the price of the first product.

Request Payload - Input

{
    "products":[10, 20, 30, 40, 50, 60]
}

Rule 2 - Customers can buy one product and get another product for free as long as the price of the free product is less than the price of the first product

Request Payload - Input

{
    "products":[10, 20, 30, 40, 40, 50, 60, 60]
}

Rule 3 - Customers can buy two products and get two products for free as long as the price of the free product is less than the price of the first product

Request Payload - Input
{
    "products":[5, 5, 10, 20, 30, 40, 50, 50, 50, 60]
}