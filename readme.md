sPHPf (Simple PHP Framework)
============================
### Making your life simple and better.

sPHPf is a PHP 5.3 based framework that allows you to initiate a fast developement
to whatever application you're interested using my personal view of MVC implementation.

The point features of this framework is the use of the Twig template manager and RedBean database
management. A good feature is also that due to it's simplicity you can always
switch between other template engines or database engines in an easy way.

You can obviously see more information of this framework in the webpage.
http://sphpf.coldstarstudios.com

How to start building your own app?
-----------------------------------
To start an app simply copy "my_app" folder inside sPHPf wherever you want. Then point the require to Loader in index.php

```php
<?php
// Index.php
session_start();
use coldstarstudios\framework\Controller;

// Here you have to point to the Autoloader.php the base of any sPHPf based APP
require '../sPHPf/Autoloader.php';
Autoloader::register(dirname(__FILE__));

// Load a new instance of the application and load the selected controller with selected action.
Application::start(new Controller('controller\mainController', 'index'));
```

What's next?
------------

### Example Controller

```php
<?php
// Remember to add the namespace when you create a new controller
namespace controller;

class mainController extends \Application {

    function index() {
        // This is how you set up vars to use inside your view.
        $this->data['example_var'] = \ExampleVendor\ExampleVendor::EXAMPLE_CONST;
        return new \coldstarstudios\framework\Response('web/index.twig', $this->data);
    }
}
```

### Example view

```twig
{% extends 'templates/base.twig' %}

{% block body %}
    <b>This is a Simple PHP Framework Application</b><br/>
    {{example_var}}
    <br/><br/>
    Mini-menu:
    <br/><br/>
    <a href="{{path}}main/index">Main page</a><br/>
    <a href="{{path}}main/phpView">PHP View page</a><br/>
    <a href="{{path}}test/twig">Page from widget with TWIG</a><br/>
    <a href="{{path}}test/php">Page from widget with PHP</a><br/>
    <a href="{{path}}main/other">Other page</a>
{% endblock %}
```

Developement
------------

###Changelog

Please refer to changelog.md

###License

Please refer to license.txt

Twig, RedBean and Spyc are used by sPHPf but it's not maintained or builded by us. Please
refer to the LICENSE file inside each source code folders or in the code itself.