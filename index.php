<?php
session_start();
use coldstarstudios\framework\Loader;
use coldstarstudios\framework\Controller;

require 'Autoloader.php';

Autoloader::register();

// Load a new instance of the application and load the selected controller with selected action.
Loader::start(new Application(), new Controller('controller\mainController', 'index'));
?>