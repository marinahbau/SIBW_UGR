<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    //Comprobamos si el usuario ya se ha logueado
    session_start(); //Comprueba y si ya se habia conectado, la variable $_SESSION se rellena con la info

    $usuario = [];

    if(isset($_SESSION['nickUsuario'])){
        $usuario = getUser($_SESSION['nickUsuario']);
    }

   
    	
    echo $twig->render('perfil.html', ['usuario' => $usuario]);

?>