<?php
session_start();
use coldstarstudios\Controller;
use coldstarstudios\Loader;

require 'Autoloader.php';

Autoloader::register();

// Load a new instance of the application and load the selected controller with selected action.
Loader::start(new Application(), new Controller('controller\mainController', 'index'));
?>