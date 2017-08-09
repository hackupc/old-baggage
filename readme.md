<br>
<p align="center">
  <img alt="HackUPC Fall 2017" src="https://github.com/hackupc/frontend/raw/master/src/images/hackupc-header.png" width="620"/>
</p>
<br>


HackUPC's baggage management system.

## Setup

Needs: PHP 5.4.X

- `git clone https://github.com/hackupc/baggage && cd baggage`
- `Create one database and setup .env for database connection`
- `php artisan migrate:refresh --seed`
- `php artisan serve`

## Available enviroment variables

- **DB_CONNECTION**: Can be any of the following: mysql, postgres, sqlite, sqlsrv.
- **DB_HOST**: Can be localhost or any IP.
- **DB_PORT**: Usually 3306, can be any port.
- **DB_DATABASE**:  The name of the database to connect with.
- **DB_USERNAME**: The username to connect to the database.
- **DB_PASSWOR**: The password to connect to the database.

## License

MIT © Hackers@UPC
