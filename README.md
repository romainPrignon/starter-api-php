# starter-api-php [![Build Status](https://travis-ci.org/romainPrignon/starter-api-php.svg?branch=master)](https://travis-ci.org/romainPrignon/starter-api-php)

starter for php api

## Using this repository as a starting point

```sh
git clone https://github.com/romainprignon/starter-api-php.git
cd starter-api-php
rm -rf .git
git init
git remote add origin <repo_url>
composer run installhooks
composer install
```
time for coffee... :)

## Installation

```sh
composer install
```

## Usage

### Develop

**-e** can be dev, test, prod

```sh
composer run start -- -e=dev
```

### Test

```sh
composer run test
```

### Release

```sh
composer run release
```

### Documentation

Take a look at the [documentation table of contents](doc/TOC.md).

### License

The code is available under the [MIT license](LICENSE.md).

## Doctrine support

Not all API need doctrine, or databases.
If you don't need it, juste remove the following in composer.json appKernel.php and config.yml
```json
    "doctrine/orm": "@stable",
    "doctrine/doctrine-bundle": "@stable",
    "doctrine/doctrine-cache-bundle": "@stable",
    "doctrine/data-fixtures": "@stable",
```

## Todo
* [ ] choose qa tools (prestissimo ?, php-parallel-lint ?, phpmd ?,psalm?, php_codesniffer, phpmetrics, php-cs-fixer, phpstan ?, rector ?)
* [ ] clean readme

* [ ] debugging
* [ ] debug performance
* [ ] server-sent-event
* [ ] authentification (HWIOAuthBundle, oauthclientbundle, jwt,...)
* [ ] release (changelog, ...)
* [ ] github release (optionnal)
