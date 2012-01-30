<?php
session_start();
use coldstarstudios\framework\Controller;

// Here you have to point to the Autoloader.php the base of any sPHPf based APP
require '../sPHPf/Autoloader.php';
Autoloader::register(dirname(__FILE__));

// Load a new instance of the application and load the selected controller with selected action.
Application::start(new Controller('controller\mainController', 'index'));