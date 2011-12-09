<?php
session_start();
use coldstarstudios\framework\Controller;

require 'Autoloader.php';

Autoloader::register();

// Load a new instance of the application and load the selected controller with selected action.
Application::start(new Controller('controller\mainController', 'index'));
?>