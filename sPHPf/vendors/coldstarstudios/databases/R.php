<?php
namespace coldstarstudios\databases;

// This class loads the main flow of the RedBean database engine.
class R extends \RedBean_Facade{
    
    /**
     * Check if the $value exists in $field on $entity
     * @param string $entity
     * @param string $field
     * @param any $value
     * @return boolean 
     */
    static function exists($entity, $field, $value){
        $t = R::find($entity, $field.' = :t', array(':t'=>$value));
        if(count($t) > 0)
            return true;
        return false;
    }    
}