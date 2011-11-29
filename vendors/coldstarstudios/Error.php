<?php
namespace coldstarstudios;
/**
 * This class is used to create a debug inform system in the app framework.
 * The debug window will appear as a fixed menu in the bottom of the page
 * when an error is throwed.
 *
 * @author ALRIK
 */
class Error {
    
    // This holds the exception data.
    public $exception;
    
    /**
     * @var \Application
     */
    public $Application;
    
    function __construct($Application, $exception){
        $this->exception = $exception;
        $this->Application = $Application;
    }
        
    function response(){

        $this->Application->data['error']['code'] = $this->exception->getCode();
        $this->Application->data['error']['message'] = $this->exception->getMessage();
        $this->Application->data['error']['file'] = $this->exception->getFile();
        
        try{
            $view = new \coldstarstudios\Response('errors/application.twig', $this->Application->data);
            if($this->Application->show_response)
                    $view->renderView();
        } catch (\Exception $z) {
            echo "Error message: #".$z->getCode()." ---- ".$z->getMessage()." ".$z->getFile();
        }
    }
}
?>