<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bdUsuarios.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    //Se encarga de registrar a un usuario en la BD
    
    $mysqli = conectar_bd();
    
    $nick = mysqli_real_escape_string($mysqli,$_REQUEST['nick_registro']);
    $email = mysqli_real_escape_string($mysqli,$_REQUEST['email_registro']);
    $pass = mysqli_real_escape_string($mysqli,$_REQUEST['pass_registro']);

    registrarUsuario($nick,$email,$pass);
    	
    echo $twig->render('registrologin.html' );

?>