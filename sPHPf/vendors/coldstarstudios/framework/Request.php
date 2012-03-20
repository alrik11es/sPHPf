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
            
            // Filtering $directories something/---(Empty)
            $directories = array_filter($directories, function($var){
                if(empty($var))
                    return false;
                else
                    return true;
            });
            
            $controller_path = 'controller'; // Without slash
            $action = null;
            $controller = null;
            
            //Debug
            //print_r($directories);
            
            $controller_tmp = $controller_path;
            for($i=0; $i<count($directories); $i++){
                $controller_tmp .= '\\'.$directories[$i];

                // If the last is a class over it only folders
                if($i == count($directories)-1 && class_exists($controller_tmp.'Controller')){
                    $controller = $controller_tmp.'Controller';
                    $action = 'index';
                }
                
                // If the last is a method and the beforelast is a class over it everything is folder
                if($i == count($directories)-2 && class_exists($controller_tmp.'Controller')){
                    $controller = $controller_tmp.'Controller';
                    $action = $directories[count($directories)-1];
                }
            }
            
            return new Controller($controller, $action, $data = array());
        }
        return $this->default_controller;
    }
}
