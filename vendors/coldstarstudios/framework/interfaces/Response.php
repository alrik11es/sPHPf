<?php
namespace coldstarstudios\framework\interfaces;

/**
 * This interface is used if you want to create your own response type in your
 * framework package.
 * 
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
interface Response {
   public function __construct($view, $vars = array());
   public function renderView();
}
?>