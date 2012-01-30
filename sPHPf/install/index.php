<?php
/**
 * This file will check out if you have the proper configuration set to run the
 * framework.
 */

class Check{
    public $ok = '<span style="background-color: lightgreen;">OK</span>';
    public $bad = '<span style="background-color: lightred;">BAD</span>';
    const TEST = '60cae09d692ab797c6093756f847442b';
    
    function for_permissions($folder){

        if(file_exists($folder)){
        echo '<b>'.$folder.'</b> -> ';
        $perms = substr(decoct(fileperms($folder)),2);
        if($perms == 777)
            echo $this->ok;
        else
            echo $this->bad;
        echo ', permission is:  '.$perms;
        echo '<br/>';
        } else
            echo '<b>'.$folder.'</b> must exist.<br/>';
    }

    function for_PDO(){
        echo 'Checking for PDO class ->';
        if(class_exists('PDO'))
            echo $this->ok;
        else
            echo $this->bad;
        echo '<br/>';
    }
    
    function for_ModRewrite(){
        // make test connection back to server
        if($_SERVER["SERVER_ADDR"] == '::1')
            $server = 'localhost';
        else
            $server = $_SERVER["SERVER_ADDR"];
        
        $fp = fsockopen($server, $_SERVER["SERVER_PORT"]);
        if ($fp) {
            socket_set_timeout($fp, 5);
            $header = "HEAD {$_SERVER['REQUEST_URI']}/".Check::TEST." HTTP/1.0\r\n<br/>";
            fputs($fp, $header);
            fputs($fp, "Host: {$_SERVER['SERVER_NAME']}\r\n\r\n");
            $response = fgets($fp);
            fclose($fp);

            // check for predefined response
            if (strpos($response, " 202")) {
                echo "mod_rewrite rules -> $this->ok";
            } else {
                echo "mod_rewrite rules -> $this->bad";
            }
        } else {
            echo "Unable to make connection";
        }
    }
}

if (isset($_GET["page"]) && $_GET["page"] == Check::TEST) {
    header("HTTP/1.0 202 Accepted");
    exit();
}

echo '<div style="font-size: 20px;width: 600px; margin-left: auto; margin-right: auto;">';
$check = new Check();
$check->for_permissions('../config/');
$check->for_permissions('../cache/');
echo 'Optional: '; $check->for_PDO();
$check->for_ModRewrite();
echo '</div>';
?>