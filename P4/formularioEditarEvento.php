<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);



    if (isset($_GET['ev'])){
		$idEv = $_GET['ev'];
	}else {
		$idEv = -1;
    }
    
	$evento = getEvento($idEv);

    
    echo $twig->render('formularioEditarEvento.html', ['evento'=> $evento]);
    
?>