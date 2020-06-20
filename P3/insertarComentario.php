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

$evento = getEvento($idEv);
$imagenes = getImagenes($idEv);
$galeria = array();
$galeria = getGaleria($idEv);

$mysqli = conectar_bd();

$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre_usuario']);
$email = mysqli_real_escape_string($mysqli,$_REQUEST['email_usuario']);
$contenido = mysqli_real_escape_string($mysqli,$_REQUEST['comentarios_usuario']);

insertarComentario($idEv, $nombre, $email, $contenido );


$comentarios = array();
$comentarios = getComentarios($idEv);

echo $twig->render('evento.html', ['evento' => $evento, 'imagenes' => $imagenes, 'galeria' => $galeria, 'comentarios' => $comentarios]);


?>