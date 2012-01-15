<?php
// Remember to add the namespace when you create a new controller
namespace controller;

class testController extends \Application {

    function index() {
        // This is how you set up vars to use inside your view.
        return new \coldstarstudios\framework\Response('index.twig', $this->data);
    }
    
    function indice() {
        // This is how you set up vars to use inside your view.
        return new \coldstarstudios\framework\Response('indice.php', $this->data);
    }
}
