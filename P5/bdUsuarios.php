<?php

function conectar_bd(){
    $mysqli = new mysqli("localhost", "marina", "mhb", "SIBW");
    if ($mysqli->connect_errno) {
        echo ("Fallo al conectar: " . $mysqli->connect_error);
    }
    return $mysqli;
}

function registrarUsuario($nick,$email,$pass){
    $mysqli = conectar_bd();
    $pass = password_hash($pass,PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios(nick,email,pass,tipo) VALUES ('$nick','$email','$pass', 'registrado') ";
    
	mysqli_query($mysqli, $sql);
		 
	// Close connection
	mysqli_close($mysqli);
}

function checkLogin($nick, $pass){ //Comprueba si el usuario esta registrado en la BD
    $mysqli = conectar_bd();
    
    $res = $mysqli->query("SELECT nick,pass FROM usuarios ");
     
    $results = array();
	if ($res->num_rows > 0) {
		while($row = $res->fetch_array()) {
			$results[] = $row;
		}
    }
    
    for ($i = 0; $i < sizeof($results); $i++){
        
        if($results[$i]['nick'] === $nick){
            echo($results[$i]['nick']);
            if(password_verify($pass,$results[$i]['pass'])){
                return true;
            }
        }
    }
    return false;
	
}

function modificarNombre($nick, $usuario){
    $mysqli = conectar_bd();

    $sql = "UPDATE usuarios set nick='$nick' where nick='$usuario'";
    
    mysqli_query($mysqli, $sql);
   
		 
	// Close connection
	mysqli_close($mysqli);
}

function modificarPass($pass, $usuario){
    $mysqli = conectar_bd();

    $pass=password_hash($pass,PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios set pass='$pass' where nick='$usuario'";
    
    mysqli_query($mysqli, $sql);
   
		 
	// Close connection
	mysqli_close($mysqli);
} 

function modificarEmail($nick, $usuario){
    $mysqli = conectar_bd();

    $sql = "UPDATE usuarios set email='$nick' where nick='$usuario'";
    
    mysqli_query($mysqli, $sql);
   
		 
	// Close connection
	mysqli_close($mysqli);
}


function setTipo($usu, $tipo){
    $mysqli = conectar_bd();

        $stmt = $mysqli->prepare("UPDATE usuarios set tipo='$tipo' where id=?");
		$stmt->bind_param("i", $usu);
        $stmt->execute();
        
        $stmt->close();
		 
	// Close connection
	mysqli_close($mysqli);
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

function getAllUsers(){
    $mysqli = conectar_bd();

    $res = $mysqli->query("SELECT * FROM usuarios ");
     
    $results = array();
    if ($res->num_rows > 0) {
        while($row = $res->fetch_array()) {
            $results[] = $row;
        }
    }

    return $results;

}

?>