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

use Rezzza\Formulate\Formula;

$formula = new Formula('{{ variable1 }} + {{ variable2 }}');
$formula->setParameter('variable1', 10);
$formula->setParameter('variable2', 13);

echo $formula->render(); // "10 + 13"

$formula->setIsCalculable(true);

echo $formula->render(); // "23"

// Works with sub formulas

$formula = new Formula('{{ subformula1 }} + {{ variable2 }}');
$formula->setSubFormula('subformula1', new Formula('subformula1', '({{ variable1 }} - {{ variable2 }} / 100)'));
$formula->setParameter('variable1', 10);
$formula->setParameter('variable2', 13);

echo $formula->render(); // (10 - 13 / 100) + 13
```

## Mathematic operations

Works as above + constant `Formula::CALCULABLE`, it'll use `Hoa\Math` arithmetic grammar to evaluate your operation. Example:

```php
use Rezzza\Formulate\Formula;

$formula = new Formula('{{ subformula1 }} + {{ variable2 }}');
$formula->setSubFormula('subformula1', new Formula('(30 / 2) * -10', Formula::CALCULABLE));
$formula->setParameter('variable2', '10');

echo $formula->render(); // -150 + 10

$formula->setIsCalculable(true);

echo $formula->render(); // -140
```

Look at [Hoa Math repository](https://github.com/hoaproject/Math).

## Tests

```shell
php composer install --dev
bin/atoum -d tests/units
```

## Todo

- Add more tests
