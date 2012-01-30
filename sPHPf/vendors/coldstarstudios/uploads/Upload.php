<?php
namespace coldstarstudios\uploads;

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
     * @param type $file
     * @return string 
     */
    static function getMimeType($file){
        $file = preg_split("/\./", $file);
        $types = array('jpg'=>'image/jpeg', 'png'=>'image/png', 'gif'=>'image/gif');
        
        $count = count($file)-1;
        
        if(isset($file[$count]))
            return $types[strtolower($file[count($file)-1])];
        else
            return false;
    }
}