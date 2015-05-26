#FakerinoBundle

[![Latest Stable Version](https://poser.pugx.org/fakerino/symfony-fakerino/v/stable.svg)](https://packagist.org/packages/fakerino/symfony-fakerino)
[![Travis Ci](https://travis-ci.org/niklongstone/symfony-fakerino.svg?branch=master)](https://travis-ci.org/niklongstone/symfony-fakerino)
[![License](https://poser.pugx.org/fakerino/symfony-fakerino/license.svg)](https://packagist.org/packages/fakerino/symfony-fakerino)

The FakerinoBundle provides integration of [Fakerino](https://github.com/niklongstone/Fakerino) into the Symfony2 framework.

More information in the [official documentation](https://github.com/niklongstone/Fakerino/wiki).

## Installation

  Add the following dependency to your projects composer.json file:

```JSON
    "require": {
        "fakerino/symfony-fakerino": "0.0.2",
    }
```
Install the ODS data sample in two ways:
 - Add a script to your composer.json:  
```JSON
  "scripts": {
        "post-install-cmd": "vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data",
        "post-update-cmd": "vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data"
    }
```
 In this way the data will be always updated automatically via composer.

 - Run maually the command (after the fakerino composer installation):  
 ```sh
$ vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data
```

### Initializing the bundle

To initialize the bundle, you'll need to add it in your `app/AppKernel.php`.

```PHP
public function registerBundles()
{
    // ...
  $bundles = array(
            new Fakerino\Bundle\FakerinoBundle(),
    // ...
}
```
### Configuration
Configuration example
```YML
fakerino:
    config:
        locale: en-GB
        fakerinoTag: fake
        fakeFilePath: /data
        fake:
            fakeMale:
                - nameMale
                - surname
                - country
        database:
            dbname: mydb
            user: username
            password: password
            host: localhost
            driver: pdo_mysql
        fake:
          fakeFemale:
            - titlefemale
            - namefemale
            - surname
```

### Controller Example
```PHP
<?php
namespace Acme\DemoBundle\Controller;

use Fakerino\Core\FakeDataFactory;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function __construct(FakeDataFactory $fakerino)
    {
        $this->fakerino = $fakerino;
    }

    public function indexAction()
    {
        $person = $this->fakerino->fake('fakeFemale');
        $duty = $this->fakerino->fakeTemplate('<p>Remeber the appointment with {{ surname }} in {{ country }}</p>');

        return new Response('<html><body> Hello '.$person.'!'.$duty.'</body></html>');
    }
}

/* random output at every page refresh
   Hello Ms Adeline Douglas !

   Remeber the appointment with Watts in Cyprus
*/
```

```XML
//config/services.xml
<service id="hello_service" class="%hello.service.class%">
    <argument type="service" id="fakerino" />
</service>
```
For more information about Symfony configuration please read about:  
[Service Container](http://symfony.com/doc/current/book/service_container.html) and [Controller as a Service](http://symfony.com/doc/current/cookbook/controller/service.html) on the official Symfony documentation.
