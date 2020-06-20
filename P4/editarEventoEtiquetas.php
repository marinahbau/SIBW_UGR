<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    //Se encarga de registrar a un usuario en la BD
    
    $mysqli = conectar_bd();

    
    if (isset($_GET['ev'])){
		$idEv = $_GET['ev'];
	}else {
		$idEv = -1;
    }


    if(isset($_POST['etiquetas_evento'])){
        $etiquetas = mysqli_real_escape_string($mysqli,$_REQUEST['etiquetas_evento']);
       
        modificarEtiquetasEvento($idEv,$etiquetas);
    }
   
    
    header("Location: formularioEditarEvento.php?ev=$idEv");

?>