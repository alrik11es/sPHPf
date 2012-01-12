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
        
        $width_orig = imagesx($this->image);
        $height_orig = imagesy($this->image);
        
        $width = $this->width; 
        $height = $this->height;
        
        if ($width_orig > $height_orig){ 
            $height = ($height_orig/$width_orig)*$height; 
        } else if($height_orig > $width_orig){ 
            $width = ($width_orig/$height_orig)*$width; 
        }
        
        $dst_image = imagecreatetruecolor($width, $height_orig);

        imagealphablending($dst_image, false);
        imagesavealpha($dst_image,true);
        $transparent = imagecolorallocatealpha($dst_image, 255, 255, 255, 127);
        imagefilledrectangle($dst_image, 0, 0, $width, $height_orig, $transparent);
        
        imagecopyresampled($dst_image, $this->image, 0, 0, 0, 0,
                $width, $height_orig, imagesx($this->image), imagesy($this->image));
        
        return $dst_image;
    }
}