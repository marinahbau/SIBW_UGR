<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    
    $eventos=array();
    $eventos= getEventos();


    echo $twig->render('gestionarEventos.html', ['eventos'=> $eventos]);
    
?>