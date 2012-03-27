<?php
namespace coldstarstudios\databases;

/**
 * This class is used to use a new data type called DataTable that allows
 * the user add data inside a memory table. The DataTable could be rendered
 * to show as a table.
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class DataTable {
    
    private $table_fields = array();
    private $table_content = array();
    
    function getRows($start, $end){
        
    }
    
    /**
     * Fills a DataTable with data from an array.
     * Must be only a table $array['column'] = 'data';
     */
    function fill($data = array()){
        if(count($data) == 0)
            return false;
        
    }
    
    function deleteRow(){
        
    }
    
    function emptyData(){
        
    }
}
