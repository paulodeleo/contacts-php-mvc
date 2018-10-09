# Contacts

This is a Contacts CRUD application in PHP MVC, in a custom way (inspired by Ruby on Rails).

The objective was to have:

- REST routes managed by a router class;
- model logic managed by the corresponding resource class;
- controller logic managed by the corresponding resource class;
- view logic managed by the corresponding resource class;
- templates managed by the view class;
- unit tests for model methods;
- server-side and client-side validations;
- responsive layout using Bootstrap;

## Running it

It uses docker and docker-compose. Just run:

`docker-compose up`

After containers initialization open http://localhost:3000/contacts/index

## Running tests

PHPUnit tests are available at `public/app/Contacts/Tests/` path. To execute all of them run:

`docker-compose exec php-fpm ./phpunit.phar --testdox public/app/Contacts/Tests/`

The output should be like this:

```
PHPUnit 7.4.0 by Sebastian Bergmann and contributors.

Contact
 ✔ Required attributes validation
 ✔ Phone format validation
 ✔ Create
 ✔ Update
 ✔ Destroy
 ✔ Filter
 ✔ Find by id

DatabaseConnection
 ✔ Connection is valid

Time: 1.29 seconds, Memory: 10.00MB

OK (8 tests, 11 assertions)
```