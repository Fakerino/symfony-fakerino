#FakerinoBundle

[![Latest Stable Version](https://poser.pugx.org/fakerino/symfony-fakerino/v/stable.svg)](https://packagist.org/packages/fakerino/symfony-fakerino)
[![Travis Ci](https://travis-ci.org/niklongstone/symfony-fakerino.svg?branch=master)](https://travis-ci.org/niklongstone/symfony-fakerino)
[![License](https://poser.pugx.org/fakerino/symfony-fakerino/license.svg)](https://packagist.org/packages/fakerino/symfony-fakerino)

The FakerinoBundle provides integration of __[Fakerino](https://github.com/Fakerino/Fakerino)__ into the __Symfony2__ framework.  
This bundle also include a Fakerino __Twig__ extension.

More information in the [official documentation](http://www.fakerino.io).

## Installation
###1. Install symfony-fakerino 
  Add the following dependency to your projects composer.json file:

```JSON
    "require": {
        "fakerino/symfony-fakerino": "~0.1"
    }
```

###2. Install the ODS data sample *(optional but suggested)*
Install the ODS data sample using __one__ of the below options:  
##### 2.1 Install and update automatically adding a script to your composer.json *(suggested way)*:  
```JSON
  "scripts": {
        "post-install-cmd": "vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data",
        "post-update-cmd": "vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data"
    }
```
__NOTE:__ add as first script to be executed.
#####2.2 Run the command manually *(after the fakerino composer installation)*:  
 ```sh
$ vendor/fakerino/fakerino/build/ods vendor/fakerino/fakerino/data
```

### 3. Initializing the bundle

To initialize the bundle, you'll need to add it in your `app/AppKernel.php`.

```PHP
public function registerBundles()
{
    // ...
  $bundles = array(
           new Fakerino\Bundle\FakerinoBundle\FakerinoBundle(),
    // ...
}
```

### 4. Configuration *(optional)* 
If the configuration is not set, Fakerino will use the default values.  
Configuration example `config.yml`:
```YML
fakerino:
    config:
        locale: en-GB
        fake:
            fakeMale:
              - titlemale
              - nameMale
              - surname
            fakeFemale:
              - titlefemale
              - namefemale
              - surname
        database:
            dbname: mydb
            user: username
            password: password
            host: localhost
            driver: pdo_mysql
```
  

## Example

#### Controller
```PHP
<?php
namespace Acme\DemoBundle\Controller;

use Fakerino\Core\FakeDataFactory;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

class HelloController
{
    public function __construct(FakeDataFactory $fakerino, Twig_Environment $twig)
    {
        $this->fakerino = $fakerino;
        $this->twig = $twig;
    }

    public function helloAction()
    {
        $person = $this->fakerino->fake('fakeFemale');
        $duty = $this->fakerino->fakeTemplate('<p>Remeber the appointment with {{ surname }} in {{ country }}</p>');

        return new Response('<html><body> Hello '.$person.'!'.$duty.'</body></html>');
    }

    public function twigAction()
    {
        return new Response(
            $this->twig->render('AcmeDemoBundle:Demo:my_fakerino_demo.html.twig')
        );
    }
}  
```
#### Twig file
```
{# Resources/view/Demo/my_fakerino_demo.html.twig #}

Hello Mr {{fake('surname')}}
```  

#### Service configuration

```XML
//config/services.xml
<service id="hello_service" class="Acme\DemoBundle\Controller\HelloController">
    <argument type="service" id="fakerino" />
    <argument type="service" id="twig" />
</service>
```

For more information about the service configuration and the controller used in this example, please read about:  
[Service Container](http://symfony.com/doc/current/book/service_container.html) and [Controller as a Service](http://symfony.com/doc/current/cookbook/controller/service.html) on the official Symfony documentation.

#### Outputs

Output of __helloAction()__, will changes at every page refresh:
```
Hello Ms Adeline Douglas !

Remeber the appointment with Watts in Cyprus
```
Output of __twigAction()__, will changes at every page refresh:
```
Hello Mr Wallace
```
