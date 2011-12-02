<?php
// Remember to add the namespace when you create a new controller
namespace controller;

class mainController extends \Application {

    function index() {
        $book = \coldstarstudios\databases\R::dispense( 'book' );
        $book->title = 'Boost development with RedBeanPHP';
        $book->author = 'Charles Xavier'; 
        $id = \coldstarstudios\databases\R::store($book);
        
        return new \coldstarstudios\Response('web/index.twig', $this->data);
    }

    function other() {
        return new \coldstarstudios\Response('web/other.twig', $this->data);
    }
}

?>