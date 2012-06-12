<?php
/*
   Gomosoft, Creando soluciones en software
 */
 
include("src/facebook.php");



class face{

    static $conf;

    public function obt_dats(){

        return face::desc_datos();

    }


static function void_main(){

   $confi = face::obt_dats();

    self::$conf =  array(
        "appId" => $confi[0],
        "secret" => $confi[1],
        "cookie" => $confi[2]
    );

  }


 static function void_ini_datos($app_id,$secret){

     $ruta = "src/";

     if(!is_dir($ruta))
         if(!mkdir($ruta,0700))
              return false;

    if(!is_file($ruta."plano.txt"))
        if(!fopen($ruta."plano.txt","w+"))
        return false;



     if($plano = fopen($ruta."plano.txt","a")){


         $codi = base64_encode($app_id.".".$secret.".true");

         fwrite($plano,$codi);
     }

      if($plano)
          return true;
      else
          return false;

 }

   private function desc_datos(){

    $ruta = "src/";
 
      if(is_file($ruta."plano.txt"))
        if(!$plano = file($ruta."plano.txt"))
          return false;

       $cod = base64_decode($plano[0]);

       $cod = str_replace(".",";",$cod);

       $cod = explode(";",$cod);

       return $cod;

    }
    
}

try{
 if(isset($_GET["id"]) and isset($_GET["secret"]))
  face::void_ini_datos($_GET["id"],$_GET["secret"]);
}
catch(Exception $e){
    die($e->getMessage());
}