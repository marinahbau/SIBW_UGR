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
		
		
		$res = $mysqli->query("SELECT id,nombre,organizacion,fecha,descripcion,enlace,icono,etiquetas,publicado FROM eventos ");
		
		
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
		
		$stmt = $mysqli->prepare("SELECT id,nombre, organizacion, fecha, descripcion, enlace, etiquetas, publicado FROM eventos WHERE id=?");
		$stmt->bind_param("i", $idEv);
		$stmt->execute();
		//$res = $mysqli->query("SELECT nombre, organizacion, fecha, descripcion, enlace FROM eventos WHERE id=" . $idEv);
		$res = $stmt->get_result();
		
		$evento = array('id'=>'unknown','nombre' => 'unknown', 'organizacion' => 'unknown', 'fecha' => 'unknown' , 'descripcion' => 'unknown', 'enlace' => 'unknown','etiquetas' => 'unknown','publicado' => 'unknown' );
		
		if($res->num_rows > 0) {
			$row = $res->fetch_assoc();
			
			$evento = array('id'=>$row['id'],'nombre' => $row['nombre'], 'organizacion' => $row['organizacion'], 'fecha' => $row['fecha'], 'descripcion' => $row['descripcion'], 'enlace' => $row['enlace'],'etiquetas' => $row['etiquetas'],'publicado' => $row['publicado']);
			
		}
		
		$stmt->close();
		return $evento;
		
		
	}

	function getImagenes($idEv) {
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("SELECT ruta1,pie_foto1,ruta2,pie_foto2 FROM imagenes WHERE id_evento=?");
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
		
		$stmt = $mysqli->prepare("SELECT id,nombre,contenido,fecha,editado FROM comentarios WHERE id_evento= ?");
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

	function getAllComentarios(){
		
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("SELECT * FROM comentarios");
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
	

	function getUser($username){
		$mysqli = conectar_bd();
    
		$res = $mysqli->query("SELECT nick,email,pass,tipo FROM usuarios ");
		 
		$results = array();
		if ($res->num_rows > 0) {
			while($row = $res->fetch_array()) {
				$results[] = $row;
			}
		}
		
		for ($i = 0; $i < sizeof($results); $i++){
			if($results[$i]['nick'] === $username){
				return $results[$i];
			}
		}
		return false;

	}

	function eliminarComentario($id){
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("DELETE from comentarios WHERE id= ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		
	}

	function eliminarEvento($id){
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("DELETE from eventos WHERE id= ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		
	}

	function eliminarImagenes($id){
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("DELETE from imagenes WHERE id_evento= ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		
	}

	function editarComentario($id, $contenido){
		$mysqli = conectar_bd();

   		$sql = "UPDATE comentarios set contenido='$contenido',editado=1 where id='$id'";
		
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function getComentario($idC){
		
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("SELECT id,nombre,contenido,fecha,editado FROM comentarios WHERE id= ?");
		$stmt->bind_param("i", $idC);
		$stmt->execute();
		$res = $stmt->get_result();

		$results = $res->fetch_array();
		
		$stmt->close();
		return $results;
	}

	function modificarNombreEvento($id, $nombre){
		$mysqli = conectar_bd();

   		$sql = "UPDATE eventos set nombre='$nombre' where id=$id";
		
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function modificarOrgEvento($id,$org){
		$mysqli = conectar_bd();

   		$sql = "UPDATE eventos set organizacion='$org' where id=$id";
		
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function modificarFechaEvento($id,$fecha){
		$mysqli = conectar_bd();

   		$sql = "UPDATE eventos set fecha='$fecha' where id=$id";
		
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function modificarContenidoEvento($id,$contenido){
		$mysqli = conectar_bd();

   		$sql = "UPDATE eventos set descripcion='$contenido' where id=$id";
		
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function modificarEtiquetasEvento($id,$etiquetas){
		$mysqli = conectar_bd();

   		$sql = "UPDATE eventos set etiquetas='$etiquetas' where id=$id";
		
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}


	function insertarEvento($nombre, $organizacion, $fecha, $contenido, $enlace , $etiquetas, $icono, $publicado){

		$mysqli = conectar_bd();

		$sql = "INSERT INTO eventos(nombre,organizacion,fecha,descripcion,enlace, etiquetas, icono, publicado) VALUES ('$nombre','$organizacion','$fecha','$contenido','$enlace', '$etiquetas', '$icono', '$publicado') ";

		mysqli_query($mysqli, $sql);
			

		 
		// Close connection
		mysqli_close($mysqli);

		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("SELECT id FROM eventos WHERE nombre=?");
		$stmt->bind_param("s", $nombre);
		$stmt->execute();
		$res = $stmt->get_result();

		$row = $res->fetch_assoc();
		
		$stmt->close();
		return $row;
	}

	function insertarImagenes($evento,$imagen1,$imagen2,$pie1,$pie2){

		$mysqli = conectar_bd();

		$sql = "INSERT INTO imagenes(ruta1,pie_foto1,ruta2,pie_foto2,id_evento) VALUES ('$imagen2','$pie1','$imagen1','$pie2','$evento') ";

		mysqli_query($mysqli, $sql);
			

		 
		// Close connection
		mysqli_close($mysqli);

	}

	function addIcono($id, $icono){
		$mysqli = conectar_bd();

   		$sql = "UPDATE eventos set icono='$icono' where id=$id";
		
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function addImagen1($id, $imagen, $pie){
		$mysqli = conectar_bd();

   		$sql = "UPDATE imagenes set ruta1='$imagen',pie_foto1='$pie' where id_evento='$id'";
		
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function addImagen2($id, $imagen, $pie){
		$mysqli = conectar_bd();

   		$sql = "UPDATE imagenes set ruta2='$imagen',pie_foto2='$pie' where id_evento='$id'";
	
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function getEtiquetas($idEv){
		$mysqli = conectar_bd();
		
		$stmt = $mysqli->prepare("SELECT etiquetas FROM eventos WHERE id= ?");
		$stmt->bind_param("i", $idEv);
		$stmt->execute();
		$res = $stmt->get_result();

		
		$row = $res->fetch_assoc();
		
		$stmt->close();
		return $row;
	}

	function publicarEvento($idEv){
		$mysqli = conectar_bd();

   		$sql = "UPDATE eventos set publicado='1' where id='$idEv'";
	
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function borradorEvento($idEv){
		$mysqli = conectar_bd();

   		$sql = "UPDATE eventos set publicado='0' where id='$idEv'";
	
			
    	mysqli_query($mysqli, $sql);
   
		 
		// Close connection
		mysqli_close($mysqli);
	}

	function buscarCoincidencias($busqueda){
		$mysqli = conectar_bd();

   		$sql = "SELECT * from eventos where publicado='1' and (nombre LIKE '%$busqueda%' or descripcion LIKE '%$busqueda%')";
	
			
    	$res = mysqli_query($mysqli, $sql);
   
		$results = array();
		if ($res->num_rows > 0) {
			while($row = $res->fetch_array()) {
				$results[] = $row;
			}
		}
		// Close connection
		mysqli_close($mysqli);

		return $results;
	}
?>