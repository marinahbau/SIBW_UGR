<?php
    include("bd.php");
    
    
    $palabras = palabrasProhibidas();
    
    $myJSON = json_encode($palabras);

    echo $myJSON;

?>