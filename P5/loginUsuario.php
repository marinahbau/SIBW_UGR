<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bdUsuarios.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    
    $mysqli = conectar_bd();

    $nick = mysqli_real_escape_string($mysqli,$_REQUEST['nick_login']);
    $pass = mysqli_real_escape_string($mysqli,$_REQUEST['pass_login']);
    if(checkLogin($nick,$pass)){
        
        session_start();

        $_SESSION['nickUsuario'] = $nick; //Guardo en la sesion el nombre de quien se ha logueado correctamente

        /*if(checkLogin($nick,$pass)){
            session_start();

            $_SESSION['nickUsuario'] = $nick; //Guardo en la sesion el nombre de quien se ha logueado correctamente

        }*/

        header("Location: index.php");

        exit();
    }
    echo $twig->render('registrologin.html');