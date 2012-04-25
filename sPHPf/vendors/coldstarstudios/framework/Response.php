<?php
namespace coldstarstudios\framework;

/**
 * This class generates a response in a simple way. Loads the view and
 * uses the array inside $vars.
 * Depending on the file extension will be rendered by different engine.
 * 
 * Then whatever template engine could be added, in this case twig.
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Response implements interfaces\Response{
    public $view;
    public $vars = array();
    public $file_ext;
    private $twig;

    
    function __construct($view, $vars = array()) {
        $this->view = $view;
        $this->vars = $vars;
        
        $splitted = preg_split("/\./", $view);
        $this->file_ext = $splitted[count($splitted)-1];
        
        if($this->twigReady())
            $this->twigConfig();
    }
    
    // The render is provided by twig
    function renderView() {
        // This will show all the view using the model and the controller
        if($this->twigReady() && $this->file_ext == 'twig')
            $this->twigRender();
        else
            $this->phpRender();
    }
    
    function twigReady(){
        return class_exists('\Twig_Loader_Filesystem') && class_exists('\Twig_Environment');
    }
    
    function twigConfig(){
        $twig_config_file = 'config/twig_config.yaml';
        $data = \Spyc\Spyc::YAMLLoad($twig_config_file);

        $filesystem = array_merge(array($data['twig_config']['templates']));
        $loader = new \Twig_Loader_Filesystem($filesystem);

        if(!file_exists($data['twig_config']['cache']) || !is_writable($data['twig_config']['cache']))
            throw new \Exception("The <b>{$data['twig_config']['cache']}</b> folder must exist and be writable.",
                    0xFF0002);

        $this->twig = new \Twig_Environment($loader, array(
            'cache' => $data['twig_config']['cache'],
            'auto_reload' => $data['twig_config']['auto_reload']
        ));

        $this->twig->addGlobal('path', new Path());
    }
    
    function twigRender(){
        $template = $this->twig->loadTemplate($this->view);
        echo $template->render($this->vars);
    }
    
    function phpRender(){
        $this->vars['path'] = new Path();
        extract($this->vars);
        $filesystem = array_merge(array('view'));
        foreach($filesystem as $folder){
            if(file_exists($folder.'/'.$this->view))
                include($folder.'/'.$this->view);
        }
    }
}