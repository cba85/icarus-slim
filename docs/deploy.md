# Deploy

## VPS

On VPS like DigitalOcean, Linode... that uses Ubuntu

## Heroku

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

## Gandi