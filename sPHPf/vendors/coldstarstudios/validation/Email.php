<?php
namespace coldstarstudios\validation;

/**
 * This class will check if a RFC 2822 compliant email address is provided or not.
 * 
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Email{
    
    private $email;
    
    /**
     * Set the email to know if it is really valid or not.
     * @param string $email
     * @return boolean 
     */
    function __construct($email){
        $this->email = $email;
    }
    
    function checkEmail(){
        
        $regexp = ";^((?>[a-zA-Z\d!#$%&'*+\-/=?^_`{|}~]+\x20*|\"((?=[\x01-\x7f])[^\"\\]|\\[\x01-\x7f])*\"\x20*)*(?<angle><))?((?!\.)(?>\.?[a-zA-Z\d!#$%&'*+\-/=?^_`{|}~]+)+|\"((?=[\x01-\x7f])[^\"\\]|\\[\x01-\x7f])*\")@(((?!-)[a-zA-Z\d\-]+(?<!-)\.)+[a-zA-Z]{2,}|\[(((?(?<!\[)\.)(25[0-5]|2[0-4]\d|[01]?\d?\d)){4}|[a-zA-Z\d\-]*[a-zA-Z\d]:((?=[\x01-\x7f])[^\\\[\]]|\\[\x01-\x7f])+)\])(?(angle)>)$;";
        
        $answer = preg_match($regexp, $this->email);
        if($answer)
            return true;
        else
            return false;
    }
    
    /**
     * This method will make the operations inside the validation.
     * @param Email $email
     * @return type 
     */
    static function validate($email){
        $email = new Email($email);
        return $email->checkEmail();
    }
    
}