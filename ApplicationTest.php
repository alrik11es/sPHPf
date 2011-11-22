<?php
// This file is used only to make the Unit Tests with PHPUnit.
session_start();
use coldstarstudios\Controller;
use coldstarstudios\Loader;

require('Autoloader.php');
Autoloader::register();

class ApplicationTest extends PHPUnit_Framework_TestCase{
    public $Application;
    
    function setUp() {
        $this->Application = new Application();
        $this->Application->show_response = false;
    }
    
    function testApplicationLoad(){
        $this->assertInstanceOf('Application', $this->Application, "The Application class cannot be instantiated");
    }
    
    function testShowController(){
        $this->assertTrue(Loader::start($this->Application, new Controller('controller\pageController', 'index')),
                'The controller/method cannot be found.');
    }
}
?>