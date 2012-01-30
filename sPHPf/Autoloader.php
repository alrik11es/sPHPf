<?php
class Autoloader{
    
    static public $dirname;
    
    static public function register($dirname) {
        self::$dirname = $dirname;
        //ini_set('unserialize_callback_func', 'autoload');
        spl_autoload_register(array(new self, 'autoload'));
    }
    
    static public function autoload($class) {
        /*// Debug purposes
        echo dirname(__FILE__).'/'.str_replace(array('\\','_',"\0"),
            array('/', '/', ''), $class).'.php<br>';//*/
        
        // If class not exists
        if(!class_exists($class)){
            // Load from vendors folder
            if(is_file($file = dirname(__FILE__).'/vendors/'.str_replace(array('\\','_',"\0"),
                    array('/', '/', ''), $class).'.php'))
                require_once $file;
            
            // Load from widget folder
            $widget_folder = scandir('widget/');
            foreach($widget_folder as $widget){
                if(is_dir('widget/'.$widget))
                    if(is_file($file = self::$dirname.'/widget/'.$widget.'/'.str_replace(array('\\','_',"\0"),
                            array('/', '/', ''), $class).'.php'))
                        require_once $file;
            }
            
            // Or load from file
            if (is_file($file = self::$dirname.'/'.str_replace(array('\\','_', "\0"),
                    array('/', '/', ''), $class).'.php'))
                require_once $file;
        }
    }
}
?>