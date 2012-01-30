<?php
namespace coldstarstudios\framework\interfaces;

/**
 * This interface is used to define how the application flows. The Loader
 * class is very important because is the main class of every application.
 * 
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
interface Application {
    function __construct();
    static function start($default_controller);
    function flow($controller);
    function render();
}