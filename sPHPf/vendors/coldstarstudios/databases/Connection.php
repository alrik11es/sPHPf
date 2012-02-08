<?php
namespace coldstarstudios\databases;
use coldstarstudios\databases\R;

/**
 * This class is used to create a PDO connection, in this case we use RedBean
 * library to make the connection, because uses PDO itself.
 *
 * @author Marcos Sigueros Fernández
 * @license MIT
 */
class Connection {
    
    public $config = array();
    
    /** @var \PDO */
    public $resource = null;
    
    /** @var \PDOException */
    public $exception;
    
    function create() {
        // If $conn is empty then load from config file.
        if(count($this->config) <= 0)
        {
            $dbase_config_file = 'config/db_config.yaml';
            if(!file_exists($dbase_config_file))
                return false;
            // Read config file
            $data = \Spyc\Spyc::YAMLLoad($dbase_config_file);
            if(isset($data['db_config']))
                $this->config = $data['db_config'];
        }
        
        try{
            // Then create connection
            if(isset($this->config['provider']))
            switch($this->config['provider']){
                case 'mysql': 
                        $dsn = 'mysql:host='.$this->config['hostname'].';dbname='.$this->config['database'];
                    break;
                
                case 'sqlite':
                        $dsn = 'sqlite:'.$this->config['database'];
                    break;
            }
        
            // We create RedBean database connection if redbean is installed else we use PDO
            
            if(isset($this->config['username']) && isset($this->config['password']))
            {
                if(class_exists('\RedBean_Facade') && $this->config['engine'] == 'redbean')
                    R::setup($dsn, $this->config['username'], $this->config['password']);
                else if($this->config['engine'] == 'PDO')
                    $this->resource = new \PDO($dsn, $this->config['username'], $this->config['password']);
                else
                    throw new \Exception ('[ERROR] You didn\'t defined the engine in config or its wrong.');
                
                if($this->config['database'] == null)
                    throw new \PDOException ('SQLSTATE[??????] [????] You have to specify a database');
            }
            
        }  catch (\PDOException $e){
            $this->exception = $e;
            // We return false if the connection cannot be made.
            return false;
        }
    }
}
