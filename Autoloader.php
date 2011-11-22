<?php
class Autoloader{
    
    static public function register() {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array(new self, 'autoload'));
    }
    
    static public function autoload($class) {
        /*// Debug purposes
        echo dirname(__FILE__).'/'.str_replace(array('\\','_', "\0"),
                array('/', '/', ''), $class).'.php<br>';*/
        
        // If class not exists
        if(!class_exists($class)){
            // Load from vendors folder
            if(is_file($file = dirname(__FILE__).'/vendors/'.str_replace(array('\\','_',"\0"),
                    array('/', '/', ''), $class).'.php'))
                require $file;
            
            // Or load from file
            if (is_file($file = dirname(__FILE__).'/'.str_replace(array('\\','_', "\0"),
                    array('/', '/', ''), $class).'.php'))
                require $file;
        }
    }
}
?>