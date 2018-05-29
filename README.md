#Register module for Yii 2.0 Framework advanced template

## Installation

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

