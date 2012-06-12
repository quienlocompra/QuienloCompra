<?php

include("sql_util.php");

function alert($msg){
	echo "<script>alert('$msg');</script>";
}

function eli_slashes($var)
{
  if (is_array($var))
  {
    return array_map('fix', $var);
  }
  elseif (get_magic_quotes_gpc())
  {
    return stripslashes($var);
  }
  return $var;
}

class tiempo{
	var $dia,$mes,$anio,$hora,$minu,$seg,$mesn;
	function tiempo(){
		putenv('TZ=America/Bogota');
		$this->dia=date("d");
		$this->mes=date("m");
		$this->anio=date("Y");
		$this->mesn=date('m');
	}
	private function obt_hora(){
		return $this->hora=date("h:m");
	}
	function obt_fecha(){
		return $this->dia."/".$this->mes."/".$this->anio;
	}
	function obt_anio(){
		return $this->anio;
	}
}



function success($x,$l){
	$_SESSION['success'] = $x;
		if(is_numeric($l))
	   $l = $_SERVER['HTTP_REFERER'];
	header("location:$l");
}

function error($x,$l){
	$_SESSION['error'] = $x;
	echo  "<script>history.back()</script>";
}

function gen_llave(){
	$llave = nombre_ale(5);
	$_SESSION['llav'] = base64_encode($llave);
	return $llave;
	unset($llave);
	}


function nombre_ale($x){
	$randomCaracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUWXYZ";
	$ranum = "1234567890";
	$nombre = "";
	for ( $i = 0; $i < $x; $i++ ){
		if( ($i % 2) == 0 )
		$nombre .= $randomCaracteres{ rand(0,49) };
		else
		$nombre .= $ranum{ rand(0,9) };
	}
	return $nombre;
}

function ini_sql($x){
$dtsql=new datos_sql($x);
$sql=new conexsql($dtsql->obt_server());
$sql->con_sql();
$sql->sel_db() or die("error");

return $sql;
}



class obj_info_sql{
	public $bd,$host,$user,$pass,$tabla;
	 function obj_info_sql($bd,$host,$user,$pass,$tabla){
		     $this->bd=$bd;
			 $this->host=$host;
			 $this->user=$user;
			 $this->pass=$pass;
			 $this->tabla=$tabla;
	 }
}

class datos_sql{
	 private $local;
	 function datos_sql($tabla){
		 if($_SERVER['SERVER_NAME']=='localhost'){
		 $this->local=new obj_info_sql("castle","localhost","root","2857811",$tabla);
		 }else{
		 $this->local=new obj_info_sql("gomosoft_castle","localhost","gomosoft_gomo","chester.1612",$tabla);
		 }
	 }
	 function obt_local(){
		 return $this->local;
	 }
	  function obt_server(){
		 return $this->local;
	 }
}


class conexsql extends sql{
	
  private $dts,$con,$query,$db;
      
	  function conexsql(obj_info_sql $x){
	    $this->dts=$x;
	  }
	  
	  function obt_sent(){
		  
		  return $this->query;
		  
	  }
	  

	  function get_limp($x){
		  return str_replace(array("|","/",",","/","*","]","&","limit","where","select","join","or","and")," ",$x);
	  }
	  
	  function par_db($x){
		  $this->db = "`$x`";
	  }
	  
	  function crea_db(){
		  $this->obt_query("CREATE DATABASE {$this->db}") or die ("Error creando base de datos...");
		  $this->con_sql();
	  }
	  
	  function select($tabla,$que,$where){
		  
          return $this->obt_query("SELECT $que FROM $tabla $where");	
		  
	  }
	  
	  function con_sql(){
		  		  
		  $this->con=$this->conectar($this->dts->host,$this->dts->user,$this->dts->pass);
	  }
	  
	  function exist(){
		try{
		if($this->obt_query("DESCRIBE {$this->obt_tabla()}")){
			return true;
		  }
		}catch(Exception $e){
			return false;
		}
	  }
	  
	  function exists($x){
		try{
		if($this->obt_query("DESCRIBE $x")){
			return true;
		}
		}catch(Exception $e){
			return false;
		}
	  }
	  
	  function obt_tabla(){
		  return $this->dts->tabla;
	  }
	  
	  function desco(){
		  $this->mcie($this->con);
	  }
	  
	  function crea_tabla($datos){
	    $query="CREATE TABLE ".$this->dts->tabla." ".$datos;
		$this->queri($query);
      }
	  
	   function crea_tabl($tabla,$datos){

        if(is_numeric($tabla)) $tabla = $this->obt_tabla();
           
	    $query="CREATE TABLE `$tabla` (id int auto_increment,$datos,primary key(id))";
		return $this->obt_query($query);
      }
	 
	 function sel_db(){
		 return $this->sdb($this->dts->bd,$this->con);
		 }
     
	 function obt_bd(){
		 return $this->dts->bd;
	 }
	 
	 function queri($query){
		 $this->query($query,$this->con);
	 }
	 
	 function set_tabla($tabla){
		$this->dts->tabla=$tabla;
	 }
	 
	 function error(){
		echo mysqli_error($this->obt_con());
        $this->desco();
	 }
	 
   function otra_bd($bd){
     $this->dts->bd=$bd;
     $this->queri("use $bd");
    }

	function obt_query($query){

         $re = mysqli_query($this->con,$query);

      if( mysqli_affected_rows($this->obt_con()) > 0)
		return $re;
        
      if(mysqli_affected_rows($this->obt_con()) == 0 and mysqli_errno($this->obt_con()) == "")
        return $re;

        return false;
        
	}

    function _obt_query($query){

         $re = mysqli_query($this->con,$query);

      if( mysqli_affected_rows($this->obt_con()) > 0)
		return $re;

        return false;

	}
    
	//evitando el sql inyect
	public function fil_sql_inyec($query){
	  return $query;							
	}
	
	function obt_con(){
		return $this->con;
	}
    
	function lib_resul($x){
		mysqli_free_result($x);
	}
	
	function coun_col($x){
		return mysqli_num_rows($this->obt_query($x));
	}
	
	function coun_result($x){
		return mysqli_num_rows($x);
	}
	
	function hay_valor($x,$t,$v){
		if($this->coun_col($this->obt_query("SELECT * FROM `$t` WHERE $v = '$x'"))>0){
			return true;
		}
		return false;
	}
	
	function fetch($x){
		return mysqli_fetch_assoc($x);
	}
	
	function insert($tabla,$cuales,$valores,$donde){
		return $this->_obt_query("INSERT INTO $tabla ($cuales) VALUES ($valores) $donde");
	}
	
	function insert_big($tabla,$cuales,$valores){
		return $this->_obt_query("INSERT INTO $tabla ($cuales) VALUES $valores");
	}
	
	function drop(){
		return $this->obt_query("DROP TABLE `{$this->obt_tabla()}`");
	}

    function obt_ar(){
        return mysqli_affected_rows($this->obt_con());
    }
	
	function limpia($user){
		
				$user = str_replace(" ", "_", $user);
				$user = addSlashes($user);
				$user = htmlentities($user);
					
				return $this->get_limp($this->limp_cadena($user));
		
	}

    /*
	function preparar($query){
				
		if($this->obt_query(str_replace("?","a",$query))){
			
			echo $query;
			
			$this->query = $query;
			return true;
			
		}else{
			
			return false;
			
		}
		
	}
	
	function enlazar_vars($t,$x){
	
	try{
	  
	if( empty($this->query) ) { throw new ErrorException("No has preparado el query."); }
			
	$tipo = str_split($t);

    if(count($tipo) != count($x)){
		throw new ErrorException("Error falta un parametro ");
	}
		
	 for($i=0 ; $i < count($tipo) ; $i++){
		 
		 switch($tipo[$i]){
		
		    case "s" :        str_replace("?","'{$x[$i]}'",$this->query);  break;
	        case "d" :        str_replace("?","{$x[$i]}",$this->query);  break;
		    case "f" :        str_replace("?","{$x[$i]}",$this->query);  break;
		
		  }
         
	 }
		
	
	    }  catch(Exception $e){
		    
			echo "Erron no coinciden los parametros pasados con los valores a asignar";
			exit;
			
	   }
	
    }
    */
}




function redondear($cantidad) { 
   $modulo= $cantidad%1; 

   if ($modulo[0]>5) return ($cantidad-$modulo); 
   else 
   
   return (($cantidad-$modulo[0])+1); 
}