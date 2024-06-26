# Simple/Config

Simple configuration provider based on [PHP dotenv](https://github.com/vlucas/phpdotenv)

[![PHP CI](https://github.com/simpl-php/config/actions/workflows/php.yml/badge.svg?branch=2.x)](https://github.com/simpl-php/config/actions/workflows/php.yml)

Combines the simplicity of `.env` files with the flexibility of defining arrays of config values.

## Installation

```bash
composer require simpl/config
```

## Basic Usage
```php
<?php
use Simpl\Config;
$config = new Config();

var_dump($config->get('app.debug'));
```

See <https://simpl-php.com/components/config> for full documentation.

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