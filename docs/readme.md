# Documentation

Icarus Slim is a framework based on [Slim](https://www.slimframework.com), the PHP micro-framework.

## Philosophy

This framework complies to the standards of the [PHP-FIG](https://www.php-fig.org) and adhere to the best-practices put forward by [PHP The "Right" Way](http://www.phptherightway.com).

This framework respect the [KISS](https://nl.wikipedia.org/wiki/KISS-principe) (Keep it simple, stupid) and the [DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) (Don't Repeat Yourself) principles.

> Less software means less features, less code, less waste.

David David Heinemeier Hansson in [Getting Real](https://www.amazon.com/Getting-Real-Smarter-Successful-Application/dp/0578012812/ref=sr_1_1?ie=UTF8&qid=1518841302&sr=8-1&keywords=getting+real).

## Slim framework

This framework is based on [Slim PHP micro framework](https://www.slimframework.com).

📖 [Documentation](https://www.slimframework.com/docs/)

## Architecture

The architecture of the framework follows the rules of [pds/skeleton](https://github.com/php-pds/skeleton) the standard filesystem skeleton suitable for all PHP packages mixed with the ones of [Ruby on Rails](http://guides.rubyonrails.org/getting_started.html#creating-the-blog-application) for a web application.

```
bin/
config/
└── settings.php
db/
docs/
logs/
public/
├── assets/
├── .htaccess
├── favicon.ico
├── index.php
└── robots.txt
resources/
├── assets
└── views
src/
├── Controllers/
├── Helpers/
├── Middleware/
├── Models/
├── lib.php
└── routes.php
tests/
tmp/
.editorconfig
.env.example
.gitignore
composer.json
Makefile
```

### Folders

| Description                | Folder name  |
| -------------------------- | -------------|
| Command-line executables   | `bin/`       |
| Configuration files        | `config/`    |
| Database schema/migrations | `db/`        |
| Documentation files        | `docs/`      |
| Log files                  | `logs/`      |
| Web server files           | `public/`    |
| Other resource files       | `resources/` |
| PHP source code            | `src/`       |
| Test code                  | `tests/`     |
| Temporary files            | `tmp/`       |

### .editorconfig

The framework has an `.editorconfig` file to respect PHP standards coding style.

### .env

The framework use a `.env` file for environment variables.

This file must be created based on `.env.example` file.

### Makefile

A `Makefile`

## Example

The framework comes with an example page `/`using [Bootstrap 4](https://getbootstrap.com).

## Tests

To execute the test suite, you'll need phpunit.

```bash
$ phpunit
```