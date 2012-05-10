<?php
namespace coldstarstudios\framework\interfaces;

/**
 * This interface is used for CRUD operations.
 * 
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
interface CRUD {
   public function create_update($action = 'create');
   public function read();
   public function delete();
}