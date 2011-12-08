<?php

namespace coldstarstudios\framework;

/**
 * This class generates a controller objects that will be used to
 * provide access to the selected controller.
 *
 * @author ALRIK
 */
class Controller {
    public $name;
    public $action;
    public $data;
    
    /**
     * The Controller class is used to generate a Controller object, that
     * will allow you to select the controller from scratch. If you need to.
     * 
     * The $name var needs a formated string like: 
     * 'controller\pageController'
     * The folder and the controller file.
     * 
     * The $action var is the method of the controller to be loaded.
     * 
     * The $data array is used to pass info.
     * 
     * @param string $name
     * @param string $action
     * @param array $data 
     */
    function __construct($name, $action, $data = array()){
        $this->name = $name;
        $this->action = $action;
        $this->data = $data;
    }
    
    function __toString(){
        return $this->name.' -> '.$this->action;
    }
}
?>