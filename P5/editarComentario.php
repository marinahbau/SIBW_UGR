<?php
    require __DIR__ . '/vendor/autoload.php';
    include('bd.php');

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    $mysqli = conectar_bd();


    if (isset($_GET['cm'])){
        $idC = $_GET['cm'];
    }else {
        $idC = -1;
    }
    
    if (isset($_GET['ev'])){
		$idEv = $_GET['ev'];
	}else {
		$idEv = -1;
	}

    if(isset($_POST['comentarios_usuario'])){
        $contenido = mysqli_real_escape_string($mysqli,$_REQUEST['comentarios_usuario']);   
        editarComentario($idC,$contenido);
    }
    
    header("Location: evento.php?ev=$idEv");
    	

?>