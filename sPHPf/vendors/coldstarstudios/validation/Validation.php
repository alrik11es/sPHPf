<?php
namespace coldstarstudios\validation;

/**
 * This class is designed to allow an easy use of all validations
 * called stack because is a stack of errors that will be checked
 * if valid or not.
 *
 * @author ALRIK
 * @license MIT
 */
class Validation {
    
    public $isValid = true;
    public $errors = array();
    
    // Temporary condition for generic checks.
    public $condition;
    
    /**
     * Checks if a $param is empty or not.
     * @param string $param
     * @param string $message 
     */
    function isEmpty($param, $message){
        if($this->isValid)
            if(empty($param)){
                $this->isValid = false;
                array_push($this->errors, array('message'=>$message));
            }
    }
    
    /**
     * Check some condition if is valid or not.
     * @param string $message
     * @param boolean $condition
     */
    function generic($message, $condition = null){
        if($condition != null)
            $condition = $condition;
        else
            $condition = $this->condition;
        
        if($condition){
            $this->isValid = false;
            array_push($this->errors, array('message'=>$message));
        }
    }

    /**
     * Checks if a file is valid or not.
     * @param $_FILE $param
     * @param array $mime
     * @param int $size
     * @param string $message_size
     * @param string $message_mime 
     */
    function file($param, $mime, $size, $message_size, $message_mime){
        if(!empty($param['tmp_name'])){
            if($param['size'] > $size) {
                $this->isValid = false;
                array_push($this->errors, array('message'=>$message_size));
            }

            if(!\coldstarstudios\uploads\Upload::validateMimeType($param['type'], $types)) {
                $this->isValid = false;
                array_push($this->errors, array('message'=>$message_mime));
            }
        }
    }
    
    /**
     * Checks if two parameters are equal or not.
     * @param type $param1
     * @param type $param2
     * @param type $message 
     */
    function equal($param1, $param2, $message){
        if($param1 != $param2) {
            $this->isValid = false;
            array_push($this->errors, array('message'=>$message));
        }
    }
    
    /**
     * Validate if a string is smaller than length or not.
     * @param string $param
     * @param int $length
     * @param string $message 
     */
    function minLength($param, $length, $message){
        if(strlen($param) < $length) {
            $this->isValid = false;
            array_push($this->errors, array('message'=>$message));
        }
    }
    
    /**
     * Validate if a string is bigger than length or not.
     * @param string $param
     * @param int $length
     * @param string $message 
     */
    function maxLength($param, $length, $message){
        if(strlen($param) > $length) {
            $this->isValid = false;
            array_push($this->errors, array('message'=>$message));
        }
    }
    
    function dateRange($param1, $param2, $message){
        
    }
    
    /**
     * Check if email is RFC 2822 Compliant
     * @param type $param
     * @param type $message 
     */
    function email($param, $message){
        if(empty($param) || !Email::validate($param)){
            $this->isValid = false;
            array_push($this->errors, array('message'=>$message));
        }
    }
    
    /**
     * Checks if its a valid telephone number.
     * @param type $param
     * @param type $message 
     */
    function telephone($param, $message){
        $match = '/^((\+)?(\d{2})[-])?(([\(])?((\d){3,5})([\)])?[-])|(\d{3,5})(\d{5,8}){1}?$/';
        $answer = preg_match($match, $param);
        if(empty($param) || !$answer){
            $this->isValid = false;
            array_push($this->errors, array('message'=>$message));
        }
    }
}

