# Simple/Config

Simple configuration provider based on [PHP dotenv](https://github.com/vlucas/phpdotenv)

Combines the simplicity of `.env` files with the flexibility of defining arrays of config values.


## Installation

```bash
composer require simpl/config
```

## Setup

For the default installation, the following directory structure is assumed. The `*.php` filenames in this example are contrived. They can be anything you'd like.

```
.env
config/
    app.php
    database.php
    logging.php 
```

## Basic Usage
Define your per-environment configuration in .env files in the root of your project.

```
.env
.env.dev
.env.uat
.env.prod
```

Environment File Example

```
APP_ENV=local
DEBUG=true
```

Load your configuration file.

```php
<?php
use Simpl\Config;
$config = new Config;

$debug = $config->get('DEBUG');
var_dump($debug); // bool(true)
```

If you want more flexibility, you can use `.php` files that return arrays of configuration values.

```php
<?php
# config/app.php

return [
	'name' => env('APP_NAME', 'Simpl PHP Example'),
	'debug' => env('DEBUG', false),
	'environment' => env('APP_ENV', 'local'),
];
```

```
$environment = $config->get('app.environment');
var_dump($environment); // string(5) "local"
```

>The above example makes use of the `env()` helper function to get a value loaded from your `.env` file.


## Testing

```bash
composer test
```

## Coding Standards
This library uses [PHP_CodeSniffer](http://www.squizlabs.com/php-codesniffer) to ensure coding standards are followed.

I have adopted the [PHP FIG PSR-2 Coding Standard](http://www.php-fig.org/psr/psr-2/) EXCEPT for the tabs vs spaces for indentation rule. PSR-2 says 4 spaces. I use tabs. No discussion.

To support indenting with tabs, I've defined a custom PSR-2 ruleset that extends the standard [PSR-2 ruleset used by PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer/blob/master/CodeSniffer/Standards/PSR2/ruleset.xml). You can find this ruleset in the root of this project at PSR2Tabs.xml


### Codesniffer

```bash
composer codensiffer
```

### Codefixer

```bash
composer codefixer
```