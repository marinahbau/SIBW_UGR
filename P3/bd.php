<?php

	function conectar_bd(){
		$mysqli = new mysqli("localhost", "marina", "mhb", "SIBW");
		if ($mysqli->connect_errno) {
			echo ("Fallo al conectar: " . $mysqli->connect_error);
		}
		return $mysqli;
	}

	
	function getEventos(){
		$mysqli = conectar_bd();
		
		
		$res = $mysqli->query("SELECT id,nombre,organizacion,fecha,descripcion,enlace,icono FROM eventos ");
		
		
		//$results = array('nombre' => 'unknown', 'organizacion' => 'unknown', 'fecha' => 'unknown' , 'descripcion' => 'unknown', 'enlace' => 'unknown' , 'icono' => 'unknown');
		
		$results = array();
		if ($res->num_rows > 0) {
			while($row = $res->fetch_array()) {
				$results[] = $row;
				//echo($row['icono']);
			}
		}
		
		return $results;
		
	}

	function getEvento($idEv){
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("SELECT id,nombre, organizacion, fecha, descripcion, enlace FROM eventos WHERE id=?");
		$stmt->bind_param("i", $idEv);
		$stmt->execute();
		//$res = $mysqli->query("SELECT nombre, organizacion, fecha, descripcion, enlace FROM eventos WHERE id=" . $idEv);
		$res = $stmt->get_result();
		
		$evento = array('id'=>'unknown','nombre' => 'unknown', 'organizacion' => 'unknown', 'fecha' => 'unknown' , 'descripcion' => 'unknown', 'enlace' => 'unknown' );
		
		if($res->num_rows > 0) {
			$row = $res->fetch_assoc();
			
			$evento = array('id'=>$row['id'],'nombre' => $row['nombre'], 'organizacion' => $row['organizacion'], 'fecha' => $row['fecha'], 'descripcion' => $row['descripcion'], 'enlace' => $row['enlace']);
			
		}
		
		$stmt->close();
		return $evento;
		
		
	}

	function getImagenes($idEv) {
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("SELECT ruta1,pie_foto1,ruta2,pie_foto2 FROM imagenes WHERE id=?");
		$stmt->bind_param("i", $idEv);
		$stmt->execute();
		$res = $stmt->get_result();
		//$res = $mysqli->query("SELECT ruta1,pie_foto1,ruta2,pie_foto2 FROM imagenes WHERE id=" . $idEv);
    
		$imagenes = array('ruta1' => '?', 'pie_foto1' => '?', 'ruta2' => '?', 'pie_foto2' => '?');
    
		if ($res->num_rows > 0) {
			$row = $res->fetch_assoc();
      
			$imagenes = array('ruta1' => $row['ruta1'],'pie_foto1' => $row['pie_foto1'],'ruta2' => $row['ruta2'],'pie_foto2' => $row['pie_foto2']);
		}
	
		$stmt->close();
		return $imagenes;
    }

	function getGaleria($idEv){
		
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("SELECT ruta,pie_foto FROM galeria WHERE id_evento= ?");
		$stmt->bind_param("i", $idEv);
		$stmt->execute();
		$res = $stmt->get_result();

		//$res = $mysqli->query("SELECT ruta,pie_foto FROM galeria WHERE id_evento=" . $idEv);
		
		$results = array();
		if ($res->num_rows > 0) {
			while($row = $res->fetch_array()) {
				$results[] = $row;
			
			}
		}
		
		$stmt->close();
		return $results;
	}

	function getComentarios($idEv){
		
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("SELECT nombre,contenido,fecha FROM comentarios WHERE id_evento= ?");
		$stmt->bind_param("i", $idEv);
		$stmt->execute();
		$res = $stmt->get_result();

		
	
		$results = array();
		if ($res->num_rows > 0) {
			while($row = $res->fetch_array()) {
				$results[] = $row;
			
			}
		}
		
		$stmt->close();
		return $results;
	}
	
	function insertarComentario($idEv, $nombre, $email, $contenido ){

		
		$fecha = date("d") . "/" . date("m") . "/" . date("Y") . " " . date("H") . ":" . date("i");
		
		$mysqli = conectar_bd();

		$sql = "INSERT INTO comentarios(id_evento,nombre,contenido,fecha) VALUES ('$idEv','$nombre','$contenido','$fecha') ";

		mysqli_query($mysqli, $sql);
			
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function palabrasProhibidas(){
		$mysqli = conectar_bd();
    	$sql = "SELECT palabra FROM censuradas";

    	$resultado = $mysqli->query($sql);
    	$palabras = array();

    	while($res = $resultado->fetch_assoc()) {
      		$palabras[] = $res['palabra'];
    	}

    return $palabras;
		
	
	}
	
?>