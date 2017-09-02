<br>
<p align="center">
  <img alt="HackUPC Fall 2017" src="https://github.com/hackupc/frontend/raw/master/src/images/hackupc-header.png" width="620"/>
</p>
<br>


HackUPC's baggage management system.

![Baggage check-in demo](https://raw.githubusercontent.com/hackupc/baggage/master/demo.png)

## Setup

Needs: PHP 5.6, GD library

- `git clone https://github.com/hackupc/baggage && cd baggage`
- `Create one database and setup .env for database connection`
- `php artisan migrate:refresh --seed`
- `php artisan serve`

You can now enter http://localhost:8000 with username `volunteer` and password `volunteer`.

## Available enviroment variables

- **DB_CONNECTION**: Can be any of the following: mysql, postgres, sqlite, sqlsrv.
- **DB_HOST**: Can be localhost or any IP.
- **DB_PORT**: Usually 3306, can be any port.
- **DB_DATABASE**:  The name of the database to connect with.
- **DB_USERNAME**: The username to connect to the database.
- **DB_PASSWOR**: The password to connect to the database.

## License

MIT © Hackers@UPC
