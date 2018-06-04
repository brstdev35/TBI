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
```
```php

To Generate Table in database.
<website url  or localhost path to directory>/login/register/generate-table

To add user
<website url  or localhost path to directory>/login/register/create

Update User
<website url  or localhost path to directory>/login/register/update?id=<:id>

User listing
<website url  or localhost path to directory>/login/register/index

Country Listing
<website url  or localhost path to directory>/login/country/index

State Listing
<website url  or localhost path to directory>/login/state/index

City Listing
<website url  or localhost path to directory>/login/city/index

Role Listing
<website url  or localhost path to directory>/login/role/index
```

```php
API Lists

Role API's 
   
    Adding Role
    
    <website url  or localhost path to directory>/login/api/add-role

    Updating Role

    <website url  or localhost path to directory>/login/api/update-role?id=<:id>
    
    Role List
    
    <website url  or localhost path to directory>/login/api/role-list
    
    Delete Role

    <website url  or localhost path to directory>/login/api/delete-role?id=<:id>

Country API's  

    <website url  or localhost path to directory>/login/api/add-country

    <website url  or localhost path to directory>/login/api/update-country?id=<:id>
 
    <website url  or localhost path to directory>/login/api/country-list

    <website url  or localhost path to directory>/login/api/delete-country?id=<:id>

State API's

    <website url  or localhost path to directory>/login/api/add-state

    <website url  or localhost path to directory>/login/api/update-state?id=<:id>
 
    <website url  or localhost path to directory>/login/api/state-list

    <website url  or localhost path to directory>/login/api/delete-state?id=<:id>

    <website url  or localhost path to directory>/login/api/state-listbycountry?id=<:id>

City API's
    
    <website url  or localhost path to directory>/login/api/add-city

    <website url  or localhost path to directory>/login/api/update-city?id=<:id>
 
    <website url  or localhost path to directory>/login/api/city-list

    <website url  or localhost path to directory>/login/api/delete-city?id=<:id>

    <website url  or localhost path to directory>/login/api/city-listbycountry?id=<:id>

User Information API's

    <website url  or localhost path to directory>/login/api/register

    <website url  or localhost path to directory>/login/api/user-infobystatus?id=<:id>

    <website url  or localhost path to directory>/login/api/user-infobyrole?id=<:id>

    <website url  or localhost path to directory>/login/api/user-info?id=<:id>

    <website url  or localhost path to directory>/login/api/list

    <website url  or localhost path to directory>/login/api/delete?id=<:id>
```

Login API's

    
