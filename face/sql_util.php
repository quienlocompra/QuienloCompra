<?php
class sql{
	function sql(){
	}
function filtrar($str){
   if (!isset($GLOBALS["carateres_latinos"])){
      $todas = get_html_translation_table(HTML_ENTITIES, ENT_NOQUOTES);
      $etiquetas = get_html_translation_table(HTML_SPECIALCHARS, ENT_NOQUOTES);
      $GLOBALS["carateres_latinos"] = array_diff($todas, $etiquetas);
   }
   $str = strtr($str, $GLOBALS["carateres_latinos"]);
   return $str;
}

function conectar($host,$user,$pass){ 
   $link=mysqli_connect($host,$user,$pass) or die ("<h1 style='margin:10px'>Oops, Error conectando con SQL estamos trabajando pronto lo solucionaremos...</h1></div>");
   return $link; 
}

function sdb($db,$con){
	if(mysqli_select_db($con,$db))
	return true;
	else return false;
	
	}

function existe($tb,$bd,$con){

$sql = "SHOW TABLES FROM $bd";
$result = mysqli_query($con,$sql);

if (!$result) {
	return false;
    echo "DB Error, no se pudo listar las tablas\n";
    echo 'MySQL Error: ' . mysqli_error();
}

while ($row = mysqli_fetch_row($result)) {
    if($tb==$row[0]){
		return true;
		exit;
	}
}
return false;
mysqli_free_result($result);
}

function query($query,$con){
	if(!mysqli_query($con,$query)){
	    return false;
	}else{
	    return true;
	}
}

function mcie($c){
	mysqli_close($c);
}

 
}
?>