<?php
// Remember to add the namespace when you create a new controller
namespace controller;

class mainController extends \Application {
    
    function index() {
        return new \coldstarstudios\Response('web/index.twig', $this->data);
    }
    
    function other() {
        return new \coldstarstudios\Response('web/other.twig', $this->data);
    }
}

?>