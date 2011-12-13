<?php
namespace coldstarstudios\uploads;

/**
 * This class will validate Mime types.
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Mime {
    public $valid_ext;
    public $mime_type;
    
    /**
     * Given a mime_type and a array of valid mime types will
     * return true or false on $this->check() method.
     * 
     * @param string $mime_type
     * @param array $valid_ext 
     */
    function __construct($mime_type, $valid_ext){
        $this->mime_type = $mime_type;
        $this->valid_ext = $valid_ext;
    }
    
    /**
     * Returns true or false depending if mime_type specified exists
     * in the array.
     * 
     * @return boolean 
     */
    function check(){
        $file = preg_split("/\./",$this->mime_type);
        return in_array($file[count($file)-1], $this->valid_ext);
    }
}
?>
