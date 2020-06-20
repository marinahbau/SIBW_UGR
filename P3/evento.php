<?php
    require __DIR__ . '/vendor/autoload.php';
	include("bd.php");
	
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
	
	$twig->addExtension(new \Twig\Extension\DebugExtension());

	$style = "templates/styles/stylesevento.css";
	$style_bool = 0;

	if (isset($_GET['ev'])){
		$idEv = $_GET['ev'];
	}else {
		$idEv = -1;
	}

	if (isset($_GET['sty'])){
		$style="templates/styles/imprimirestilo.css";
		$style_bool = 1; //Se trata de la pagina para imprimir
	}
	
	$evento = getEvento($idEv);
	$imagenes = getImagenes($idEv);
	$galeria = array();
	$galeria = getGaleria($idEv);
	$comentarios = array();
	$comentarios = getComentarios($idEv);
	
    echo $twig->render('evento.html', ['estilo_bool'=> $style_bool,'estilo'=> $style, 'evento' => $evento, 'imagenes' => $imagenes, 'galeria' => $galeria, 'comentarios' => $comentarios]);

?>