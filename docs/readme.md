# Documentation

Icarus Slim is a framework based on [Slim](https://www.slimframework.com), the PHP micro-framework.

## Index

- [Philosophy](#philosophy)
- [Slim framework](#slim-framework)
- [Getting started](#getting-started)
- [Langage & libraries](#language-libraries)
- [Architecture](#architecture)
- [Makefile](#makefile)
- [Tests](#tests)
- [Deploy](#deploy)
- [Authors](#authors)
- [License](#license)

## Philosophy

This framework complies to the standards of the [PHP-FIG](https://www.php-fig.org) and adhere to the best-practices put forward by [PHP The "Right" Way](http://www.phptherightway.com).

This framework respect the [KISS](https://nl.wikipedia.org/wiki/KISS-principe) (Keep it simple, stupid) and the [DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) (Don't Repeat Yourself) principles.

> Less software means less features, less code, less waste.

David David Heinemeier Hansson in [Getting Real](https://www.amazon.com/Getting-Real-Smarter-Successful-Application/dp/0578012812/ref=sr_1_1?ie=UTF8&qid=1518841302&sr=8-1&keywords=getting+real).

## Slim framework

This framework is based on [Slim PHP micro framework](https://www.slimframework.com).

📖 [Documentation](https://www.slimframework.com/docs/)

## Getting started

### Installation

```bash
$ composer install
```

#### .env

The framework use a `.env` file for environment variables thanks to [phpdotenv](https://github.com/vlucas/phpdotenv) package.

This file must be created based on the `.env.example` file.

Create a `.env` file by copying the `.env-example` file and modify the values with your environment:

```bash
$ make copy-env
```

### Apache

The framework comes with an `/public/.htaccess` file.

### Nginx

In `nginx.conf` file of the server:

```nginx
try_files $uri /index.php;
```

### Usage

```bash
$ php -S 0.0.0.0:8080 -t public public/index.php
# or using Makefile
$ make serve
```

### Example

The framework comes with an example page `/` using [Bootstrap 4](https://getbootstrap.com).

### Clean

To clean (delete) the framework of the example files, just run:

```bash
$ make clean
```

## Language & libraries

### Php

Php >= `7.0` is required.

### Composer

Dependancy packages are located in `vendor` folder and required in `composer.json`.

| Library | Description |
| ------- | ----------- |
| [PHP](http://php.net)     | Server-side code |
| [Composer](https://getcomposer.org) | PHP dependency management |
| [Slim](https://www.slimframework.com) |  PHP micro framework |
| [phpdotenv](https://github.com/vlucas/phpdotenv) | Environment variables in `.env` |
| [Config](https://github.com/hassankhan/config) | Lightweight configuration file loader |
| [Twig](https://twig.symfony.com) | Templating |
| [Slim Twig view](https://github.com/slimphp/Twig-View) | Slim Framework view layer built on top of Twig |
| [Slim Twig Flash](https://github.com/kanellov/slim-twig-flash) | Twig extension for rendering slim flash messages |
| [Monolog](https://github.com/Seldaek/monolog) | Logger |

### .editorconfig

The framework has an [editorconfig](http://editorconfig.org) file to respect PHP standards coding style.

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

### Assets

| Path | Description|
|-|-|
| `resources/assets/` | Assets for development (unminified)  |
| `public/assets/` | Assets for production (minified) and libraries |

### Helpers

| Path | Description|
|-|-|
| `src/Helpers/helpers.php` | Helper functions |

The helper functions are autoloaded by Composer.

### Controllers

| Path | Description|
|-|-|
| `src/Controllers/` | Controllers folder |
| `src/Controllers/Controller.php` | Base Controller |

### Middlewares

| Path | Description|
|-|-|
| `src/Middlewares/` | Middlewares folder |

### Views

| Path | Description|
|-|-|
| `resources/views/` | Views (Twig) folder |

## Makefile

A Makefile is included with the project.

```bash
$ make [command]
```

Use `help` to list available commands.

Scripts are categorized:
- Serve the project
- Tests
- Sitemap
- Minify css and js
- Concat css and js

### Sources

- http://wonko.com/post/simple-makefile-to-minify-css-and-js
- https://gist.github.com/bpierre/1341808

## Tests

To execute the test suite, you'll need phpunit.

```bash
$ phpunit
```

## Deploy

### VPS

On VPS like DigitalOcean, Linode... that uses Ubuntu

### Heroku

In `index.php` file:

```php
// Load secret parameters (.env)
if (env('HEROKU') == null) {
    $dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
    $dotenv->load();
}
```

In `composer.json` file, move `vlucas/phpdotenv` from `require` to `require-dev`:

```php
"require-dev": {
    "vlucas/phpdotenv": "^2.4",
},
```

### Gandi

## Authors

- [Clément Barbaza](https://www.github.com/cba85)

## License

This project is licensed under the MIT License - see the [LICENSE](../LICENSE) file for details.