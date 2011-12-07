<?php
/**
 * This file will check out if you have the proper configuration set to run the
 * framework.
 */

function check($folder){
    
    if(file_exists($folder)){
    echo '<b>'.$folder.'</b> -> ';
    $perms = substr(decoct(fileperms($folder)),2);
    if($perms == 777)
        echo '<span style="background-color: lightgreen;">OK ';
    else
        echo '<span style="background-color: lightred;">BAD ';
    echo $perms;
    echo '</span><br/>';
    } else
        echo '<b>'.$folder.'</b> must exist.<br/>';
}

echo '<div style="font-size: 20px;width: 600px; margin-left: auto; margin-right: auto;">';
check('../config/');
check('../cache/');
echo '</div>';
?>