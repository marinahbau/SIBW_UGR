<?php
    require __DIR__ . '/vendor/autoload.php';
	include("bd.php");
	
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
	
	$twig->addExtension(new \Twig\Extension\DebugExtension());

	if (isset($_GET['ev'])){
		$idEv = $_GET['ev'];
	}else {
		$idEv = -1;
	}
    
    $style = "templates/styles/imprimirestilo.css";
	$evento = getEvento($idEv);
	$imagenes = getImagenes($idEv);
	$galeria = array();
	$galeria = getGaleria($idEv);
	$comentarios = array();
	$comentarios = getComentarios($idEv);
	
    echo $twig->render('evento_imprimir.html', ['estilo_bool'=> $style_bool,'estilo'=> $style, 'evento' => $evento, 'imagenes' => $imagenes, 'galeria' => $galeria, 'comentarios' => $comentarios]);

?>