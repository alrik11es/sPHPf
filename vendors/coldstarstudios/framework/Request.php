<?php
namespace coldstarstudios\framework;

/**
 * This class will be used to validate and secure the requests in the framework
 * Not added yet in the 1.0.0
 *
 * @author ALRIK
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
            
            $num = 0;
            for($i=0; $i<count($directories); $i++)
            {
                $test_path = $controller_path . $directories[$i].'/';
                if(is_dir($test_path))
                    $controller_path .= $directories[$i].'/';
                else {
                    if(is_file($controller_path.$directories[$i].'Controller.php')) {
                        $controller = $directories[$i].'Controller';
                        if(isset($directories[$i+1])) {
                            $action = $directories[$i+1];
                            $num = $i+2;
                        }
                    }
                }
            }

            if($num != 0)
                $data = array_slice($directories, $num);
            else
                $data = array();
            
            // Hay veces que pone dos y no es cierto, lo arreglo con esto.
            //$controller_path = str_replace('\\\\', '\\', $controller_path);
            //echo "return new Controller($controller_path.$controller, $action, $data);";
            $controller = $controller_path.$controller;
            $controller = str_replace('/', '\\', $controller);
            return new Controller($controller, $action, $data);
        }
        return $this->default_controller;
    }
}

?>