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
class Loader implements interfaces\Loader{
    
    /** @var PDO */
    public $connection;
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
        if(class_exists('Connection')){
            $conn = new Connection();
            $this->connection = $conn->create();
        }
        
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
     * This method executes the main application flow.
     * @param Controller $linked_controller 
     */
    function flow($controller){
        $this->response = $this->exec($controller);
        
        if(!is_null($this->response))
            $this->render();
    }
    
    /**
     * Executes the controller.
     * @param Controller $linked_controller
     */
    function exec($controller) {
        $action = $controller->action;
                
        if(!class_exists($controller->name))
            throw new \Exception ('The controller: '.$controller->name.' hasn\'t been found.');
        // Look for the controller in the list (If controller not exists then error)
        $load = $controller->name;
        $this->controller = new $load();
        
        if(!method_exists($controller->name, $action))
            throw new \Exception ('The method: \''.$action.'\' cannot be found in
                the controller: \''.$controller->name.'\'', 0xFF0001);
        
        // Once the controller is finded you must look for an action called
        return $this->controller->$action();
    }
    
    /**
     * This method renders the view using the Response class defined
     * in the Loader.
     */
    function render(){
        $this->response->renderView();
    }
    
    /**
     * This static method works as a typical application. Should be like the
     * typicall main method of java.
     * The execution of this is conditioned to the application passed and the
     * default controller that it's going to be loaded.
     * 
     * @param Controller $default_controller 
     */
    static function start($default_controller){
        $class = '\\'.__CLASS__;
        $Application = new $class();
        
        // Set main controller
        $Application->request->default_controller = $default_controller;

        try{
            $Application->flow($Application->request->getController());
            return true;
        } catch (\Exception $e) {
            // Application error management
            $error = new \coldstarstudios\Error($Application, $e);
            $error->response();
            return false;
        }
    }
}
?>