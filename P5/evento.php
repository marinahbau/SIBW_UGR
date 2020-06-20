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

	session_start(); //Comprueba y si ya se habia conectado, la variable $_SESSION se rellena con la info

	if(isset($_SESSION['nickUsuario'])){
        $usuario = getUser($_SESSION['nickUsuario']);
    }
	
	$evento = getEvento($idEv);
	$imagenes = getImagenes($idEv);
	$galeria = array();
	$galeria = getGaleria($idEv);
	$comentarios = array();
	$comentarios = getComentarios($idEv);
	$etiquetas = array();
	$etiquetas = getEtiquetas($idEv);

	if($etiquetas != ""){
		$etiquetas = explode(',',$etiquetas['etiquetas']);
	}
	else{
		$etiquetas=array();
	}
    echo $twig->render('evento.html', ['etiquetas'=>$etiquetas, 'estilo_bool'=> $style_bool,'estilo'=> $style, 'evento' => $evento, 'imagenes' => $imagenes, 'galeria' => $galeria, 'comentarios' => $comentarios, 'usuario' => $usuario]);

?>