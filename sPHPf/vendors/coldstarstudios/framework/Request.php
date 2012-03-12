<?php
namespace coldstarstudios\framework;

/**
 * This class will be used to validate and secure the requests in the framework
 * Not added yet in the 1.0.0
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Request {

    public $default_controller;
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
    
    /**
     * This method returns the controller from the URL.
     * Or the default controller.
     */
    function getController(){
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            $directories = preg_split('/\//', $page);
            
            $controller_path = 'controller/';
            $action = null;
            $controller = null;
            
            $method_num = count($directories)-1;
            $controller_num = count($directories)-2;
            
            $controller_tmp = @$directories[$controller_num].'Controller';
            $action = @$directories[$method_num];
            
            array_pop($directories);
            array_pop($directories);
            $controller = '';
            foreach($directories as $folder){
                $controller .= $folder.'/';
            }
            
            $controller .= $controller_tmp;
          
            $data = array();
            
            $controller = $controller_path.$controller;
            $controller = str_replace('/', '\\', $controller);
            return new Controller($controller, $action, $data);
        }
        return $this->default_controller;
    }
}
