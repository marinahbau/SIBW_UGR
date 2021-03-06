/* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "400px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function botonEnviar() {
  //Comprobamos que todos los parametros estan rellenos

  if(document.getElementById("nombre_usuario").value.length==0 || document.getElementById("email_usuario").value.length==0 ||
    document.getElementById("comentarios_usuario").value.length==0){
    alert("Faltan campos en rojo"); //Si falta alguno, enviamos un mensaje de error
  }
  else{ //Si todo está bien, enviamos el comentario
    
    //Comprobamos si el email está bien introducido
    if(validarEmail(document.getElementById("email_usuario").value)){

      var nuevoDiv = document.createElement("DIV");
      nuevoDiv.classList.add("comentario_individual");

      var contenido_nombre = document.createElement("B");
      contenido_nombre.innerHTML= document.getElementById("nombre_usuario").value;
    
      var contenido_comentario = document.createElement("P");
      contenido_comentario.innerHTML = document.getElementById("comentarios_usuario").value
      
      var contenido_fecha = document.createElement("P");
      var fecha = new Date();
      contenido_fecha.classList.add("fechayhora");
      contenido_fecha.innerHTML = fecha.getDate() + "/" + fecha.getMonth() + "/" + fecha.getFullYear() + " " + fecha.getHours() + ":" + fecha.getMinutes();
      
      
      nuevoDiv.appendChild(contenido_nombre);
      nuevoDiv.appendChild(contenido_comentario);
      nuevoDiv.appendChild(contenido_fecha);

      document.getElementById("ultimo_comentario").insertAdjacentElement("afterend",nuevoDiv);
      
    }
    else{
      alert("La direccion de correo es incorrecta");
      document.getElementById("email_formulario").style.color="red";
    }
    
  }
  //Los campos que faltan se ponen en rojo. Si se rellenan, vuelven al color original
  if(document.getElementById("nombre_usuario").value.length==0)
      document.getElementById("nombre_formulario").style.color="red";
  else
     document.getElementById("nombre_formulario").style.color="white";

  if(document.getElementById("email_usuario").value.length==0)
      document.getElementById("email_formulario").style.color="red";
  else
      document.getElementById("email_formulario").style.color="white";

  if(document.getElementById("comentarios_usuario").value.length==0)
      document.getElementById("comentarios_formulario").style.color="red";
  else
      document.getElementById("comentarios_formulario").style.color="white";
  


}

function validarEmail(valor) {
  if ( (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i).test(valor)){
   return true;
  } else {
   return false;
  }
}

//Vector global de palabras malsonantes
prohibidas = ["tonto", "estupido", "caca", "gilipollas", "puta", "tonta", "maricon", "cerda", "lisiada", "mierda"];
palabra= "";
longitud = 0; //variable que sirve para saber cuanta longitud tiene el mensaje actualmente

function comprobarPalabras(event){
  var tecla = String.fromCharCode(event.keyCode).toLowerCase();
  var re = /[a-zA-Z]/;
  var mensaje = document.getElementById("comentarios_usuario");

  if(re.test(tecla)){
    palabra += tecla;
  }
  else{
    if(tecla === " " || tecla === "."){ //Si acabamos la palabra, comprobamos si es una de las prohibidas
      censurar(palabra);
      palabra=""; //Reseteamos para comprobar la siguiente palabra
    }
  }

  longitud = mensaje.value.length; //guardamos la longitud del mensaje
}

function censurar(palabra){
  var i;
  var j;
  var mensaje = document.getElementById("comentarios_usuario");
  var censura = " ";

  for(i=0; i<prohibidas.length; i++){
    if(palabra === prohibidas[i]){
      
      for(j=0; j<palabra.length; j++){ //Rellenamos tantos * como letras tenga la palabra malsonante
        censura+="*";
      }

      //Sustituimos esa palabra por la nueva cadena censurada
      var mensaje_censurado = mensaje.value.substring(0, longitud - palabra.length) + censura + " "; 
      mensaje.value = mensaje_censurado;
    }
  }
}