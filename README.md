#Register module for Yii 2.0 Framework advanced template

## Installation

Before installing this extension ,please install admin lte through composer

Either run:

```bash
composer require dmstr/yii2-adminlte-asset "2.*"
```

or add

```bash
"dmstr/yii2-adminlte-asset": "2.*",
```

to the require section of your `composer.json` file.


The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run:

```bash
composer require tbi/yii2-login
```

or add

```bash
"tbi/yii2-login": "*"
```

to the require section of your `composer.json` file.

Usage
-----

1.add link to RegisterModule in your config

```php
return [
    'modules' => [
        'login' => [
            'class' => 'TBI\Login\Login',
        ],
    ],
]; 

