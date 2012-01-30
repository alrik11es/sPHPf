<?php
session_start();
use coldstarstudios\framework\Controller;

require '../sPHPf/Autoloader.php';
Autoloader::register(dirname(__FILE__));

// Load a new instance of the application and load the selected controller with selected action.
Application::start(new Controller('controller\mainController', 'index'));