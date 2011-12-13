<?php
namespace coldstarstudios;

/**
 * This class is used to handle image operations.
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Upload {
    
    /**
     * This static method validates a image extension returning true or false.
     * 
     * @param type $mime
     * @param type $valid_ext
     * @return boolean
     */
    static function validateMimeType($mime, $valid_types = array("image/jpeg","image/png","image/gif")){
        $validate = new \coldstarstudios\uploads\Mime($mime, $valid_types);
        return $validate->check();
    }
    
    /**
     * This method allows you to know the mime type of whatever file from its
     * extension.
     * Returns the name of the mime type or false if not found.
     * @param type $filename
     * @return string 
     */
    static function getMimeType($filename){
        $file = preg_split("/\./", $file);
        $types = array('jpg'=>'image/jpeg', 'png'=>'image/png', 'gif'=>'image/gif');
        if(isset(strtolower($file[count($file)-1])))
            return $types[strtolower($file[count($file)-1])];
        else
            return false;
    }
}

?>