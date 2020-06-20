<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bdUsuarios.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if (isset($_GET['us'])){
        $idU = $_GET['us'];
    }else {
        $idU = -1;
    }

    if (isset($_GET['ti'])){
        $tipo = $_GET['ti'];
    }else {
        $tipo = -1;
    }
    $mysqli = conectar_bd();

    
    setTipo($idU,$tipo);


    header("Location: gestionarPermisos.php");
    
?>