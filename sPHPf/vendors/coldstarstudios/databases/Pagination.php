<?php
namespace coldstarstudios\databases;

class Pagination{

    public $reg_num, $var_name, $page, $start_num;
    public $total;
    public $debug = false;
    public $next_term = 'Siguientes';
    public $before_term = 'Anteriores';
    
    /**
     * This class allows you to paginate any query.
     * $reg_num is the elements per page.
     * $var_name allows you to change the ?_varname_=%%%%%
     * in case that it smash with one yours.
     */
    function __construct($reg_num = 10, $var_name = 'p1'){
        $this->var_name = $var_name;
        $this->reg_num = $reg_num;
                
        $this->setCleanPath();
        $this->checkStartNumber();
        
        if($this->debug)
            echo 'Page: '.$this->page.'<br>';
    }
    
    function checkStartNumber(){
        if(!isset($_GET[$this->var_name]))
            $this->start_num = 0;
        else
            $this->start_num = $_GET[$this->var_name];
        
        if($this->start_num < 0)
            $this->start_num = 0;
        
        if($this->debug)
            echo 'Start Num: '.$this->start_num.'<br>';
    }
    
    function setCleanPath(){
        $path = new \coldstarstudios\framework\Path();
        
        $i = 0;
        foreach($_GET as $num => $value){
            if($num == 'page'){
                $path .= $value;
            } else {
                if($num != $this->var_name){
                    if($i == 0)
                        $path .= '?'.$num.'='.$value;
                    else
                        $path .= '&'.$num.'='.$value;
                    $i++;
                }
            }
        }
        $this->page = $path;
    }
    
    /**
     * $actual_count means the count of elements this time, to know if
     * the next button must appear or not.
     */
    function simpleFooter($results_in_page){
        $pagination = '';
        if(preg_match('/\?/', $this->page))
            $separator = '&';
        else
            $separator = '?';
        
        if($this->start_num >= $this->reg_num){
            $fl = $this->start_num - $this->reg_num;
            $pagination .= "<input type=\"button\" onclick=\"window.location='$this->page$separator$this->var_name=$fl';\" value=\"$this->before_term\">";
        }
        
        echo $this->start_num + $this->reg_num .' ++++++++ '.$this->total;
        if($this->start_num + $this->reg_num + $results_in_page < $this->total){
            $fr = $this->start_num + $this->reg_num;
            $pagination .= "<input type=\"button\" onclick=\"window.location='$this->page$separator$this->var_name=$fr';\" value=\"$this->next_term\">";
        }
        return $pagination;
    }
    
    function advancedFooter($total_num, $reg_num){
    
    }
}