<?php
namespace coldstarstudios;
use coldstarstudios\forms\Input;

/**
 * This class generates a response in a simple way. Loads the view and
 * uses the array inside $vars.
 *
 * Then whatever template engine could be added, in this case twig.
 *
 * @author ALRIK
 */
class Response{
    public $view;
    public $vars = array();
    private $twig;
    
    function __construct($view, $vars = array()) {
        $this->view = $view;
        $this->vars = $vars;
        
        $twig_config_file = 'config/twig_config.yaml';
        $data = \Spyc\Spyc::YAMLLoad($twig_config_file);
        
        $loader = new \Twig_Loader_Filesystem($data['twig_config']['templates']);
        
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => $data['twig_config']['cache'],
            'auto_reload' => $data['twig_config']['auto_reload']
        ));
        $this->twig->addGlobal('path', new Path());
        $this->twig->addFilter('input', new \Twig_Filter_Function('coldstarstudios\forms\Input::draw'));
        
    }
    
    // The render is provided by twig
    function renderView() {
        // This will show all the view using the model and the controller
        $template = $this->twig->loadTemplate($this->view);
        echo $template->render($this->vars);
    }

}
?>