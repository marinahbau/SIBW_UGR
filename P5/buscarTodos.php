<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    
    if (isset($_GET['search'])){
		$busqueda = $_GET['search'];
	}else {
		$busqueda = -1;
	}

    $eventos = buscarCoincidencias($busqueda);

    echo $twig->render('buscarTodos.html', ['eventos'=> $eventos]);
    
?>