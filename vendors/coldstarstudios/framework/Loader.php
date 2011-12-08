<?php
namespace coldstarstudios\framework;
use coldstarstudios\databases\Connection;
use coldstarstudios\framework\Request;
use coldstarstudios\framework\Controller;
use coldstarstudios\framework\Error;

/**
 * This class is used to load the the main flow of the application.
 *
 * @author ALRIK
 */
class Loader {
    
    /** @var PDO */
    public $connection;
    /** @var Url */
    public $url;
    /** @var Request */
    public $request;
    /** @var Controller */
    public $controller;
    /** @var Response */
    public $response;
    
    /// This var allows you to choose if you want to see the response or not.
    public $production = false;
    
    /** @var Aplication path */
    public $path;
    
    public $data = array();

    /**
     * This constructor loads the main flow of the application.
     */
    function __construct() {
                
        // Database connection
        $conn = new Connection();
        $this->connection = $conn->create();
        
        // URL control
        $this->url = new Url();
        
        // Session control
        
        // Data Request class
        $this->request = new Request();
        
        $app_config_file = "config/app_config.yaml";
        if(!file_exists($app_config_file))
                throw new \Exception('"config/app_config.yaml" not found.', '0x000002');
        
        // Read config file
        $data = \Spyc\Spyc::YAMLLoad($app_config_file);
        $app_config = $data['app_config'];
        
        $this->production = $app_config['production'];
        $this->path = $app_config['default_uri'];
    }
    
    /**
     * Sets any type of controller in the render port.
     * @param Controller $linked_controller
     */
    function setController($linked_controller) {
        $action = $linked_controller->action;
        $controller = $linked_controller->name;
        
        if(!class_exists($controller))
            throw new \Exception ('The controller: '.$controller.' hasn\'t been found.');
        // Look for the controller in the list (If controller not exists then error)
        $this->controller = new $controller();
        
        if(!method_exists($controller, $action))
            throw new \Exception ('The method: \''.$action.'\' cannot be found in
                the controller: \''.$controller.'\'', 0xFF0001);
        
        // Once the controller is finded you must look for an action called
        $this->response = $this->controller->$action();
        
        if(!is_null($this->response))
            $this->response->renderView();
    }
    
    /**
     * This static method works as a typical application. Should be like the
     * typicall main method of java.
     * The execution of this is conditioned to the application passed and the
     * default controller that it's going to be loaded.
     * 
     * @param Application $Application
     * @param Controller $default_controller 
     */
    static function start($Application, $default_controller){
        
        // Set main controller
        $Application->url->default_controller = $default_controller;

        // Application error management
        try{
            $Application->setController($Application->url->getController());
            return true;
        } catch (\Exception $e) {
            
            $error = new \coldstarstudios\Error($Application, $e);
            $error->response();
            
            return false;
        }
    }
}
?>