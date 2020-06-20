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

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_FILES['imagen'])){
            $errores = array();
            $file_name = $_FILES['imagen']['name'];
            $file_size = $_FILES['imagen']['size'];
            $file_tmp = $_FILES['imagen']['tmp_name'];
            $file_type = $_FILES['imagen']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));

            $extensions = array("jpeg","jpg","png");

            if(in_array($file_ext,$extensions) === false){
                $errores[] = "Extension no permitida, elige una imagen JPG, JPEG o PNG";
            }
            if($file_size > 2097152){
                $errores[] = "Tamanio del fichero muy grande";
            }
            if(empty($errores)==true){
                move_uploaded_file($file_tmp, "templates/images/" . $file_name);
                $imagen = "templates/images/" . $file_name;

                addIcono($idEv,$imagen);
            }
           
        }
    }
    
    echo $twig->render('formularioAniadirPrimeraImagen.html', ['evento_actual' => $idEv]);
    
?>