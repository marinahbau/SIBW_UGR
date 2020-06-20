<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if (isset($_GET['ev'])){
        $idEv = $_GET['ev'];
    }else {
        $idEV = -1;
    }
    $mysqli = conectar_bd();

    

    eliminarEvento($idEv);
    eliminarImagenes($idEv);
    
    header("Location: index.php");
    	

?>