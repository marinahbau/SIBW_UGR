<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);


    if(isset($_POST['busqueda'])){
        $busqueda = $_POST['busqueda'];
    }

    $result = buscarCoincidencias($busqueda);
    $str="";

 
    for($i = 0; $i<count($result); $i++){ //Construimos el resultado
        $evento = $result[$i]['id'];
        $str = $str . "<a href=\"evento.php?ev=$evento\" > ";
        $str = $str . $result[$i]['nombre'];
        $str = $str . "</a>";
    }
  

    echo $str;

?>