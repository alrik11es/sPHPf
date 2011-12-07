<?php
namespace coldstarstudios;
/**
 * This class is used to handle image operations.
 *
 * @author alrik
 */
class Image {
    
    /**
     * This method will resize a image to a selected width and height.
     * Will return the resized image as resource.
     * 
     * @param type $image
     * @param type $width
     * @param type $height
     * @return image 
     */
    static function resize($image, $width, $height){
        $resize = new \coldstarstudios\images\Resize($image, $width, $height);
        return $resize->Resize();
    }
    
    /**
     * This method will create a image from a file and a mime type.
     * Returns the created image as resource.
     * 
     * @param type $filename
     * @param type $mime
     * @return image
     */
    static function create($filename, $mime){
        switch($mime){
            case 'image/jpeg':
                $image = imagecreatefromjpeg($filename);
                break;
            case 'image/png':
                $image = imagecreatefrompng($filename);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($filename);
                break;
            default:
                return false;
        }
        return $image;
    }
}

?>