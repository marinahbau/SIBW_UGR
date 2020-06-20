<?php

require __DIR__ . '/vendor/autoload.php';
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$twig->addExtension(new \Twig\Extension\DebugExtension());


$mysqli = conectar_bd();

$nombre = mysqli_real_escape_string($mysqli,$_REQUEST['nombre_evento']);
$organizacion = mysqli_real_escape_string($mysqli,$_REQUEST['org_evento']);
$fecha = mysqli_real_escape_string($mysqli,$_REQUEST['fecha_evento']);
$contenido = mysqli_real_escape_string($mysqli,$_REQUEST['contenido_evento']);
$enlace = mysqli_real_escape_string($mysqli,$_REQUEST['enlace_evento']);
$etiquetas = mysqli_real_escape_string($mysqli,$_REQUEST['etiquetas_evento']);
$publicado = mysqli_real_escape_string($mysqli,$_REQUEST['publicado_evento']);

$icono="templates/images/icon.png"; //Definimos un icono default
$imagen1="templates/images/foto2.png";
$pie="Sin pie de foto";
$imagen2="templates/images/foto1.png";


$evento=insertarEvento($nombre, $organizacion, $fecha, $contenido, $enlace, $etiquetas, $icono, $publicado );
insertarImagenes($evento['id'],$imagen1,$imagen2,$pie,$pie);

echo $twig->render('formularioAniadirIcono.html',['evento_actual' => $evento]);

?>