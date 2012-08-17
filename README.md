Formulate - PHP
===============

[![Build Status](https://secure.travis-ci.org/rezzza/Formulate.png)](http://travis-ci.org/rezzza/Formulate)

Making life easier while writing complex math formulas, take a breath

## Instalation - composer

```
# composer.json
"rezzza/formulate": "dev-master"
# shell
php composer.phar update # or install
```

## Usage

```php
<?php

use Rezzza\Formulate\Token;
use Rezzza\Formulate\Formula;

$token = new Token();
$token->variable1 = "10";
$token->variable2 = "13";

$formula = new Formula('{{ variable1 }} + {{ variable2 }}');
$formula->setToken($token);

echo $formula->render(); // "10 + 13"

// Works with sub formulas

$formula = new Formula('{{ subformula1 }} + {{ variable2 }}');
$formula->setToken($token);
$formula->setSubFormula(new Formula('subformula1', '({{ variable1 }} - {{ variable2 }} / 100)'));
// you can add as many levels as you want

echo $formula->render(); // (10 - 13 / 100) + 13
```

## Tests

```shell
php composer install --dev
bin/atoum -d tests/units
```

## Wishlist

- Look at libraries to parse and calculate results.
- Add renderer (actually only strtr)

