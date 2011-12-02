<?php
namespace coldstarstudios\databases;
use coldstarstudios\databases\R;

/**
 * This class is used to create a PDO connection, in this case we use RedBean
 * library to make the connection, because uses PDO itself.
 *
 * @author alrik
 */
class Connection {
    
    public $conn = array();
    /** @var \PDOException */
    public $exception;
    
    function create() {
        // If $conn is empty then load from config file.
        if(count($this->conn) <= 0)
        {
            $dbase_config_file = 'config/db_config.yaml';
            if(!file_exists($dbase_config_file))
                return false;
            // Read config file
            $data = \Spyc\Spyc::YAMLLoad($dbase_config_file);
            if(isset($data['db_config']))
                $this->conn = $data['db_config'];
        }
        
        try{
            // Then create connection
            if(isset($this->conn['provider']))
            switch($this->conn['provider']){
                case 'mysql': 
                        $dsn = 'mysql:host='.$this->conn['hostname'].';dbname='.$this->conn['database'];
                    break;
                
                case 'sqlite':
                        $dsn = 'sqlite:'.$this->conn['database'];
                    break;
            }
        
            // We create RedBean database connection.
            // (This could be easily changed by adding your own library)
            if(isset($this->conn['username']) && isset($this->conn['password']))
            {
                R::setup($dsn, $this->conn['username'], $this->conn['password']);
            
                if($this->conn['database'] == null)
                    throw new \PDOException ('SQLSTATE[??????] [????] You have to specify a database');
            }
            
        }  catch (\PDOException $e){
            $this->exception = $e;
            // We return false if the connection cannot be made.
            return false;
        }
    }
}

?>
