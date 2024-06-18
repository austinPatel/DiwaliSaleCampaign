# Diwali Sale Campaign

## Requirement 
<ul>
<li>PHP Version 8.2 or later</li>
<li>Laravel 11 </li>
<li>Composer 2.7.6</li>
<li>MYSQL 8 </li>
</ul>
## Enable the sodium extension in your php.ini for updating dependancy for laravel passport
extension=sodium;

## In this Project you will be seen the robust application, follows best practices code standard which makes the code more maintainable and testable.
For Example

<p>`Dependency injection`- Allows for better separation of concerns and makes the code more maintainable and testable.</p>
<p>`Services Class` - that contains the business logic for processing the products and determining the discounted and payable items.</p>
<p>`Product Controller` -The ProductController uses dependency injection to get an instance of the ProductService.</p>
<p>`Repository Pattern` - Follow the repository pattern to organized and maintained through the seperating the data access layer from Business logic e.g
`UserRepository class` - which is for the User registration and login.</p>

<p>`Create User Request` - For the Better Validation rules defined in single places of user request class and make customized validation as well.</p>

<p>Install the Laravel Passport for better used of Oauth 2 server implementation for the application Authentication and Authorization that while required secure communication with third party application.</p>

## To setup the project, follow the below steps.

## Step-1  Clone the project from the repository
git clone https://github.com/austinPatel/DiwaliSaleCampaign.git

## Step-2 Composer install 
composer install

## step-3 Change the database configuration based on your environment of database you used.

For Example:

<p>DB_CONNECTION=mysql</p>
<p>DB_HOST=127.0.0.1</p>
<p>DB_PORT=3306</p>
<p>DB_DATABASE=diwalisalecampaign</p>
<p>DB_USERNAME=root</p>
<p>DB_PASSWORD=</p>

## Step-4 Migrate the database to create schema in your database.
`php artisan migrate`

## After all above step done, start the laravel server to execute and used the apiendpoint for this application.
`php artisan serve`

Copy the link which is given laravel server
For example
http://127.0.0.1:8000/

## Please find the below API Endpoint Routing

User Registration - sign up the user account

## `[/api/register]`(http://127.0.0.1:8000/api/register)

<p>
Request Payload (Input Parameters)

```JSON
{
    "name":"XYZ",
    "email": "XYZ@localhost.com",
    "password":"123456",
    "confirm_password":"123456"
}
``` 
</p>

<p>

```JSON
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
```
</p>

User Login - User login
## [/api/login] (http://127.0.0.1:8000/api/login)

```JSON

Request Payload
{
    "email": "XYZ@localhost.com",
    "password":"123456",
}
```
```JSON
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
```

## `[/api/buy-product]` (http://127.0.0.1:8000/api/buy-product)

<h3>Rule - 1 </h3>
<p>Customers can buy one product and get another product for free as long as the price of the free product is equal to or less than the price of the first product.</p>

<h4>Request Payload - Input</h4>

```JSON
{
    "products":[10, 20, 30, 40, 50, 60]
}
```

<h3>Rule - 2 </h3>
<p>Customers can buy one product and get another product for free as long as the price of the free product is less than the price of the first product.</p>

<h4>Request Payload - Input</h4>

```JSON
{
    "products":[10, 20, 30, 40, 40, 50, 60, 60]
}
```
<h3>Rule - 3 </h3> 
<p>Customers can buy two products and get two products for free as long as the price of the free product is less than the price of the first product</p>

<h4>Request Payload - Input</h4>

```JSON
{
    "products":[5, 5, 10, 20, 30, 40, 50, 50, 50, 60]
}
```