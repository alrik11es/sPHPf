<?php
namespace coldstarstudios\framework;
use coldstarstudios\framework\Controller;

/**
 * This class is used to select what controller is going to be used.
 * So if the page url should be something like
 * http://foosite.com/controller/method
 * This class will clean and interprets the url.
 *
 * @author ALRIK
 */
class Url {
 
    public $default_controller;

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