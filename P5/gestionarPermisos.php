<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bdUsuarios.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    
    $usuarios=array();
    $usuarios= getAllUsers();

    session_start(); //Comprueba y si ya se habia conectado, la variable $_SESSION se rellena con la info

    

    if(isset($_SESSION['nickUsuario'])){
       $yo=$_SESSION['nickUsuario'];
    }

   echo $twig->render('gestionarPermisos.html', ['yo' => $yo,'usuarios'=> $usuarios]);
    
?>