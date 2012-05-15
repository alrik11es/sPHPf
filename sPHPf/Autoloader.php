<?php
class Autoloader{
    
    static public $dirname;
    static public $debug = false;
    
    static public function register($dirname) {
        self::$dirname = $dirname;
        //ini_set('unserialize_callback_func', 'autoload');
        spl_autoload_register(array(new self, 'autoload'));
    }
    
    static public function autoload($class) {
        /*// Debug purposes
        echo dirname(__FILE__).'/'.str_replace(array('\\','_',"\0"),
            array('/', '/', ''), $class).'.php<br>';//*/
        
        if(self::$debug)
            echo 'Remember not to put a Class name at the end on the namespace declaration!!!!!<br/>';
        
        // If class not exists
        if(!class_exists($class)){
            // Load from vendors folder
            if(is_file($file = dirname(__FILE__).'/vendors/'.str_replace(array('\\','_',"\0"),
                    array('/', '/', ''), $class).'.php')){
                if(self::$debug)
                    echo $file.'<br/>';
                require_once $file;
            }
            
            // Load from app vendors folder
            if(is_file($file = self::$dirname.'/vendors/'.str_replace(array('\\','_',"\0"),
                    array('/', '/', ''), $class).'.php')){
                if(self::$debug)
                    echo $file.'<br/>';
                require_once $file;
            }

            // Or load from file
            if (is_file($file = self::$dirname.'/'.str_replace(array('\\','_', "\0"),
                    array('/', '/', ''), $class).'.php')){
                if(self::$debug)
                    echo $file.'<br/>';
                require_once $file;
            }
        }
    }
}
?>