<?php
// Remember to add the namespace when you create a new controller
namespace controller;

class testController extends \Application {

    function twig() {
        // This is how you set up vars to use inside your view.
        return new \coldstarstudios\framework\Response('index.twig', $this->data);
    }
    
    function php() {
        // This is how you set up vars to use inside your view.
        return new \coldstarstudios\framework\Response('indice.php', $this->data);
    }
}
