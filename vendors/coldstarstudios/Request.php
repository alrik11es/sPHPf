<?php
namespace coldstarstudios;

/**
 * This class will be used to validate and secure the requests in the framework
 * Not added yet in the 1.0.0
 *
 * @author ALRIK
 */
class Request {
    
    public $_GET;
    public $_POST;
    public $_FILES;
    
    function __construct() {
        // Get all vars:
        $this->_POST = $_POST;
        $this->_GET = $_GET;
        $this->_FILES = $_FILES;
    }
    
    function secure_injections() {
        
    }
    
    function validate() {
        
    }
}

?>