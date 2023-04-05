# CoinDesk Project
> A GraphQL implementation of the [CoinDesk laravel package in real use](https://github.com/gabrielAndy/coindesk)

## Project's requirements
Ensure that you have:
- PHP >=7.2
- MYSQL
- Laravel 5.8+
- [Composer](https://getcomposer.org/) installed in your machine

## Dependencies
- [CoinDesk for Laravel](https://github.com/gabrielAndy/coindesk)
- [Laravel GraphQL](https://github.com/rebing/graphql-laravel)

## Setting up the project
- Clone the project
- Copy `.env.exapmle` to `.env`
- **Optional:** Update `.env` with your database details
- Install composer:
```bash
composer install
```
- Bootstrap the application:
```bash
php artisan key:generate
php artisan jwt:secret
php artisan migrate
```
- Start the server:
```bash
php artisan serve`
```
- Have fun!

## Live project
[A live usage](https://bitwatch.herokuapp.com/graphiql)

Make a query of the form:
```javascript
{
  calculatePrice(type: "buy", margin: 300, exchangeRate: 360)
}

```

```javascript
{
  calculatePrice(type: "sell", margin: 0.2, exchangeRate: 362.50)
}

```

## Contribute
Contributions are always welcome

## License
Coindesk for Laravel is released under the MIT License. See the bundled LICENSE file for details.

## Patreon
Reach out and support me on [Patreon](https://www.patreon.com/andikan). All pledges will be dedicated to opensource projects.

