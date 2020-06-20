<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if (isset($_GET['cm'])){
        $idC = $_GET['cm'];
    }else {
        $idC = -1;
    }
    $mysqli = conectar_bd();

    $comentario=getComentario($idC);

    eliminarComentario($idC,$comentario['contenido']);

    
    header("Location: index.php");
    	

?>