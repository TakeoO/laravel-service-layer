# Service Layer for laravel framework

Extra simple service manager module for laravel app

## Installation

- Require repository
 ```code
 composer require takeoo/laravel-service-layer
 ```

 - Check that **service.php** file was copied to *laravelRoot/config/* directory
    -  if not copy it from *vendor/takeoo/laravel-service-layer/config/*   



## Usage

 - Create new service class (Example.php) anywhere in your project:
```php

//Example.php


namespace  My\Service\Namespace;


use Takeoo\Service;

class MyService extend Service
{
// your code 
}

```
or if you do not want to extend Service.php just use Service trait;

```php

//Example.php


namespace  My\Service\Namespace;


use Takeoo\Service\Traits;

class MyService 
{
 use Service;
// your code 
}

```

- when you created new service class, you have to register it:
 - go to config/service.php
 - add your service to "services" array:
 
```php

'services' => [
  'Example' => \ My\Service\Namespace\Example::class,
]
```


- Add Service trait to your Controller.php class (if you extend it  with all your controllers) or to every controller
 class in which you want to use Service layer

## Code

In code you can call your service as:

```php

$service = $this->getService("Example");
             
```

if you want to use autocomplete (tested in JetBrains IDE) add PHPDoc above variable 

```php

/**
 * @var \My\Service\Namespace\Example $serivce
 */
$service = $this->getService("Example");
             
```

or you can always create helper functions for your commonly used services e.g: 



```php

/**
 * return \My\Service\Namespace\Example
 */
 public function getExampleService()
 {
  return $this->getService("Example");
 }             

```



