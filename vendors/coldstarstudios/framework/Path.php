<?php
namespace coldstarstudios\framework;

/**
 * This class is used to create the application path tag inside the template.
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Path {
    function __construct() {
        
    }
    
    function __toString() {        
        if(isset($_GET['page']))
        {
            $page = $_GET['page'];
            $path = '';
            
            if(isset($_SERVER["HTTPS"]))
                $path .= 'https://';
            else
                $path .= 'http://';
            
            $path .= $_SERVER['HTTP_HOST'];
            $path .= str_replace($page, '', $_SERVER['REQUEST_URI']);
            
            return $path;
        } else
            return '';
    }
}
