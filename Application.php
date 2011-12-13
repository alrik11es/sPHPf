<?php
class Application extends \coldstarstudios\framework\Application {
    function __construct(){
        parent::__construct();
        $this->production = false;
    }
}
?>