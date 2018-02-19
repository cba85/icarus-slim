# Documentation

Icarus Slim is a framework based on [Slim](https://www.slimframework.com), the PHP micro-framework.

## Index

- [Philosophy](#philosophy)
- [Slim framework](#slim-framework)
- [Getting started](#getting-started)
- [Langage & libraries](#language-libraries)
- [Architecture](#architecture)
- [Features](#features)
    - [.env](#dotenv)
    - [Config files](#config-files)
    - [Templating](#templating)
    - [Logging](#logging)
    - [Database](#database)
    - [Flash messages](#flash-messages)
    - [Basic authentification](#basic-authentification)
    - [CSRF protection](#csrf-protection)
    - [Validation](#validation)
    - [Sitemap](#sitemap)
- [Makefile](#makefile)
- [Tests](#tests)
- [Deploy](#deploy)
- [Authors](#authors)
- [License](#license)

## Philosophy

Icarus Slim is a tool to make products the simple and fast way. The name comes from [Icarus myth](https://en.wikipedia.org/wiki/Icarus), an example of [hubris](https://en.wikipedia.org/wiki/Hubris). It's a reminder to never forget to stay simple and humble when creating products.

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

#### Load environment variables in Makefile

Uncomment at the beginning of the `Makefile`:

```bash
include .env
```

### Servers

#### Apache

The framework comes with an `/public/.htaccess` file.

#### Nginx

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

Dependancies packages are located in `vendor` folder and required in `composer.json`.

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
.user.ini
composer.json
Makefile
Procfile
```

### .editorconfig

The framework has an [editorconfig](http://editorconfig.org) file to respect PHP standards coding style.

### .user.ini

The framework has an [.user.ini](http://php.net/manual/fr/configuration.file.per-user.php) file for changing `php.ini` settings on some servers. (e.g [Heroku](https://devcenter.heroku.com/articles/custom-php-settings#php-runtime-settings)).

### Procfile

A [Procfile](https://devcenter.heroku.com/articles/getting-started-with-php#define-a-procfile) is included in the framework to explicitly declare what command should be executed to start the app on [Heroku](https://www.heroku.com/home).

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
| `resources/lang/` | Internationalisation files |
| `resources/views/` | Views (Twig) folder |

## Features

This framework comes with all the basic features to create a website/web application.

To remove one of them, simply remove the package in `composer.json` and its dependency in `src/lib.php`.

### dotenv

The framework use a `.env` file for environment variables thanks to [phpdotenv](https://github.com/vlucas/phpdotenv) package.

📖 [Documentation](https://github.com/vlucas/phpdotenv)

### Config files

The framework use config files located in `config/` folder thanks to [hassankhan/config](https://github.com/hassankhan/config) to load the files.

📖 [Documentation](https://github.com/hassankhan/config)

#### Dependency

This feature has a dependency in Slim container in `src/lib.php` file.

```php
$container['config'];
```

#### List

| File | Description |
|-|-|
| `app.php` | Application settings |
| `database.php` | Database settings |
| `logger.php` | Monolog settings |
| `slim.php` | Slim framework settings |
| `view.php` | Twig settings |

#### Usage

Controller helper:

```php
// One setting
$this->config('app.url');
// All settings
$this->config();
```

Using the package natively:

```php
// One setting
$this->config->get('app.url');
// All settings
$this->config->all();
```

### Templating

For templating, the framework uses [Twig](https://twig.symfony.com) library.

📖 [Documentation](https://twig.symfony.com/doc/2.x/)

The framework uses 2 add-ons for Twig:

| Library | Description |
| ------- | ----------- |
| [Slim Twig view](https://github.com/slimphp/Twig-View) | Slim Framework view layer built on top of Twig |
| [Slim Twig Flash](https://github.com/kanellov/slim-twig-flash) | Twig extension for rendering slim flash messages |

#### Dependency

This feature has a dependency in Slim container in `src/lib.php` file.

```php
$container['view'];
```

#### Usage

```php
// Display a view
return $this->view($response, 'index.html');
```

### Logging

For logging, the framework uses [Monolog](https://github.com/Seldaek/monolog) library.

📖 [Documentation](https://github.com/Seldaek/monolog/tree/master/doc)

#### Dependency

This feature has a dependency in Slim container in `src/lib.php` file.

```php
$container['logger'];
```

#### Usage

Controller helper:

```php
$this->log($text, $type);
```

Using the package natively:

```php
    $this->container->logger->debug($text);
    $this->container->logger->info($text);
    // ...
```

### Database

For database connection, the framework uses [aura/sql](https://github.com/auraphp/Aura.Sql).

📖 [Documentation](https://github.com/auraphp/Aura.Sql/blob/3.x/docs/index.md)

#### Dependency

This feature has a dependency in Slim container in `src/lib.php` file.

```php
$container['db'];
```

### Flash messages

For flash messages, this framework uses [Slim Flash](https://github.com/slimphp/Slim-Flash).

📖 [Documentation](https://github.com/slimphp/Slim-Flash)

The framework uses [Slim Twig Flash](https://github.com/kanellov/slim-twig-flash) for rendering slim flash messages in Twig.

#### Dependency

This feature has a dependency in Slim container in `src/lib.php` file.

```php
$container['flash'];
```

### Usage

Using controller helper:

```php
 $this->flash($message, $type);
```

Using the package natively:

```php
$this->flash->addMessage($type, $message);
```

In a Twig file:

```html
<!-- Flash message -->
{% if flash.success %}
    <div>{{ flash.success[0] }}</div>
{% elseif flash.error %}
    <div>{{ flash.error[0] }}</div>
{% endif %}
```

### Basic authentification

For basic authentification, this framework uses [Slim Basic Auth](https://github.com/tuupola/slim-basic-auth).

📖 [Documentation](https://appelsiini.net/projects/slim-basic-auth/)

ℹ️ Basic authentification is not activated by default.

#### Dependency

This feature has a dependency in Slim container in `src/lib.php` file.

To activate the basic authentification, just uncomment the dedicated code to add the middleware:

```php
// Http authentification
$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "users" => [
        "root" => "t00r",
    ]
]));
```

### CSRF protection

For flash messages, this framework uses [Slim CSRF](https://github.com/slimphp/Slim-Csrf).

📖 [Documentation](https://github.com/slimphp/Slim-Csrf)

#### Dependency

This feature has a dependency in Slim container in `src/lib.php` file.

```php
$container['csrf'];

// Middleware
$app->add(new \Slim\Csrf\Guard);
```

### Validation

For validation, this framework uses [Slim Validation](https://github.com/DavidePastore/Slim-Validation), that internally uses [Respect/Validation](https://github.com/Respect/Validation).

📖 [Slim Validation documentation](https://github.com/DavidePastore/Slim-Validation)<br>
📖 [Respect Validation documentation](https://github.com/Respect/Validation)

### Sitemap

To create a sitemap of the website, this framework uses [samdark/sitemap](https://github.com/samdark/sitemap).

📖 [Documentation](https://github.com/samdark/sitemap)

By default, a route is created in `src/routes.php` and a controller `SitemapController.php` is included in `src/Controllers`.

#### Usage

1. Edit the `create()` method in `src/Controllers/SitemapController` to add pages in the sitemap.

2. To create a sitemap, launch the Makefile command:

    ```bash
    make sitemap
    ```

The sitemap file `sitemap.xml` is created in `public/` folder.

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

To execute the test suite, you'll need [phpunit](https://phpunit.de).

Phpunit is installed using Composer on your local/dev environment.

```bash
$ phpunit
```

## Deploy

### VPS

On VPS like DigitalOcean, Linode... that uses Ubuntu

### Heroku

The framework includes a `Procfile` to initiate a php web server on an Heroku server.

To deploy on an Heroku server, you have to do some modification because the `dotenv` library is not compatible with the Heroku environment variables.

1. First, create an `HEROKU` variable on your Heroku application:

    ```
    HEROKU=true
    ```

2. In `index.php` file, add:

    ```php
    // Load secret parameters (.env)
    if (env('HEROKU') == null) {
        $dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
        $dotenv->load();
    }
    ```

3. In `composer.json` file, move `vlucas/phpdotenv` from `require` to `require-dev` to continue using the `dotenv` package on your `local/dev` environment:

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