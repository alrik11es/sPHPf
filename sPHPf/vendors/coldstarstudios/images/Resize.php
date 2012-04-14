<?php
namespace coldstarstudios\images;

/**
 * This class is used to resize multiple images.
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Resize {

    public $image;
    
    function __construct($image){
        $this->image = $image;
    }
    
    function resize($maxSize){
        
        $info = array('height'=>0,'width'=>0);
        $info['width'] = imagesx($this->image);
        $info['height'] = imagesy($this->image);
        
        $width  = isset($info['width'])  ? $info['width']  : $info[0];
        $height = isset($info['height']) ? $info['height'] : $info[1];
 
        // Calculate aspect ratio
        $wRatio = $maxSize / $width;
        $hRatio = $maxSize / $height;
 
        // Calculate a proportional width and height no larger than the max size.
        if (($width <= $maxSize) && ($height <= $maxSize))
        {
            // Input is smaller than thumbnail, do nothing
            return $this->image;
        }
        elseif (($wRatio * $height) < $maxSize)
        {
            // Image is horizontal
            $tHeight = ceil($wRatio * $height);
            $tWidth  = $maxSize;
        }
        else
        {
            // Image is vertical
            $tWidth  = ceil($hRatio * $width);
            $tHeight = $maxSize;
        }
 
        $dst_image = imagecreatetruecolor($tWidth, $tHeight);

        imagealphablending($dst_image, false);
        imagesavealpha($dst_image,true);
        $transparent = imagecolorallocatealpha($dst_image, 255, 255, 255, 127);
        imagefilledrectangle($dst_image, 0, 0, $tWidth, $tHeight, $transparent);
        
        imagecopyresampled($dst_image, $this->image, 0, 0, 0, 0,
                $tWidth, $tHeight, $width, $height);
        
        return $dst_image;
    }
}