<?php
/*
   Gomosoft, Creando soluciones en software
 */
 
  function main_us($respuesta){

    include("../util.php");

    $id_f["usuario"] = array();


     $sql = ini_sql("facebook");


     if(  mysqli_num_rows( $res =$sql->obt_query("SELECT `id_f`,`usuario` FROM  {$sql->obt_tabla()}") ) == 0 )
          die ("Error no hay datos");


     while($fil = mysqli_fetch_assoc($res)){

         $datos = $fil["usuario"];

         $dato = explode("|",$datos);

         $dato = explode(";",$dato[1]);

          $datox = explode("|",$datos);

          $datox = explode(";",$datox[0]);

         $id_f["usuario"][] = array(
             "id" =>$fil["id_f"],
             "token" =>$dato[1],
             "nombre" => $datox[1]
             );

     }

     $sql->desco();

   switch($respuesta){

       case "json":

           header("Content - Type : application/json , charset = utf-8");
           return json_encode($id_f);

        break;

       case "array":

           return $id_f;



   }



}

if(isset($_GET["prev"]))
     die(main_us("json"));
