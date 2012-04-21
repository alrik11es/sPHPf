<?php
namespace coldstarstudios\framework;

/**
 * This class will allow you to use the Widget's in the framework. Please
 * refer to docs to know how the widget approach is.
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Widget {
    
    public $widget_view_folders = array();
    
    function __construct(){
        $this->getWidgets();
    }
    
    function getWidgets(){
        // Load from widget folder
        if(file_exists('widget/')){
            $widget_folder = scandir('widget/');
            array_shift($widget_folder);array_shift($widget_folder);
            foreach($widget_folder as $widget){
                if(is_dir('widget/'.$widget)){
                    array_push($this->widget_view_folders, 'widget/'.$widget.'/view');
                }
            }
        }
    }
}
