<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bdUsuarios.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    //Se encarga de registrar a un usuario en la BD
    
    $mysqli = conectar_bd();

    session_start(); //Comprueba y si ya se habia conectado, la variable $_SESSION se rellena con la info

    $usuario = [];

    if(isset($_SESSION['nickUsuario'])){
        $usuario=$_SESSION['nickUsuario'];
    }


    if(isset($_POST['email'])){
        $email = mysqli_real_escape_string($mysqli,$_REQUEST['email']);
        modificarEmail($email,$usuario);
    }
    session_destroy();
    
    header("Location: registrologin.php");

?>