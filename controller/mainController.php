<?php
// Remember to add the namespace when you create a new controller
namespace controller;

class mainController extends \Application {

    function index() {
        // This is how you set up vars to use inside your view.
        $this->data['example_var'] = \ExampleVendor\ExampleVendor::EXAMPLE_CONST;
        throw new \Exception("Prueba");
        return new \coldstarstudios\framework\Response('web/index.twig', $this->data);
    }

    function other() {
        return new \coldstarstudios\framework\Response('web/other.twig', $this->data);
    }
}
?>