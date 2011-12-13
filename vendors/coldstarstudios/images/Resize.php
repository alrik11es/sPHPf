<?php
namespace coldstarstudios\images;

/**
 * This class is used to resize multiple images.
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Resize {

    public $image, $width, $height;
    
    function __construct($image, $width, $height){
        $this->image = $image;
        $this->width = $width;
        $this->height = $height;
    }
    
    function resize(){
        if(imagesx($this->image)>imagesy($this->image)){
            $transformada['x'] = $this->width;
            $transformada['y'] = (imagesy($this->image) / imagesx($this->image)) * 100;
        } else {
            $transformada['y'] = $this->height;
            $transformada['x'] = (imagesx($this->image) / imagesy($this->image)) * 100;
        }
        
        $dst_image = imagecreatetruecolor($transformada['x'], $transformada['y']);
        
        imagecopyresampled($dst_image, $this->image, 0, 0, 0, 0,
                $transformada['x'], $transformada['y'], imagesx($this->image), imagesy($this->image));
        return $dst_image;
    }
}

?>
