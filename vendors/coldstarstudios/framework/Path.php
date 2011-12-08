<?php
namespace coldstarstudios\framework;

/**
 * This class is used to create the application path tag inside the template.
 *
 * @author ALRIK
 */
class Path{
    
    function __construct() {
        
    }
    
    function __toString() {        
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            $path = '/';
            $directories = preg_split('/\//', $page);
            echo count($directories);
            for($i=0; $i<count($directories); $i++)
            {
                $test_path = $path .'../';
                if(is_dir($test_path))
                    $path .= '../';
            }
            
            return $path;

        } else {
            return '';
        }
    }
}

?>