<?php
/*
   Gomosoft, Creando soluciones en software
 */

session_start();

include("config_face.php");
include("obt_gente.php");

function main(){

  $post = array(
      "name" => (isset($_POST["name"]) and !empty($_POST['name'])) ? $_POST["name"] : false,
      "detalles" => (isset($_POST["detalles"]) and !empty($_POST['detalles'])) ? $_POST["detalles"] : false,
      "link" => (isset($_POST["link"]) and !empty($_POST['link'])) ? $_POST["link"] : false,
      "descri" =>  (isset($_POST["descri"]) and !empty($_POST['descri'])) ? $_POST['descri'] : false
  );

  foreach($post as $p)
      if(!$p)
          die(error("Error de parametros los que tienen * son obligatorios.",1));

  $post["det_ext"] =  (isset($_POST["det_ex"]) and !empty($_POST['det_ex'])) ? $_POST["det_ex"] : false;
  $post["img"] =  (isset($_POST["img_url"]) and !empty($_POST['img_url'])) ? $_POST["img_url"] : false;
  $post["actions"] =  (isset($_POST["actions"]) and !empty($_POST['actions'])) ? true : false;
  $post["mostrar"] =  (isset($_POST["m_nom"]) and !empty($_POST['m_nom'])) ? $_POST['m_nom'] : false;
  

  if($post["actions"]){

      $datos = $_POST["actions"];
      $datos = explode(",",$datos);

      $actions = array();

      foreach($datos as $ac){

          $temp = explode(";",$ac);



          if(count($temp) < 2)
              die(error("Formato de action invalido",1));

             if(!filter_var($temp[1],FILTER_VALIDATE_URL))
                  die(error("Formato de action url inválida, se requiere url absoluta ej. http://quienlocompra.com",1));

          $actions[] = array(
              "name" => $temp[0],
              "link" => $temp[1]
          );

      }

      $post["actions"] = $actions;

  }

if($post["link"] !== false)
 if(!filter_var($post["link"],FILTER_VALIDATE_URL))
     die(error("Formato de action url inválida para link del post, se requiere url absoluta ej. http://quienlocompra.com",1));

if($post["img"] !== false)
 if(!filter_var($post["img"],FILTER_VALIDATE_URL))
     die(error("Formato de action url inválida para imagen, se requiere url absoluta ej. http://quienlocompra.com",1));


  face::void_main();


 $fb = new Facebook( face::$conf );
 $usuarios = main_us("array");


  foreach($usuarios as $id){


       try{

   $info = array(
        'message' => $post["descri"],
        'name' => $post["name"],
        'link' => $post["link"],
        'caption' =>  $post['detalles']
                 );
           
  if($post["det_ext"] !== false)
    $info['description'] =  $post['det_ext'];

  if($post["img"] !== false)
      $info["picture"] = $post["img"];

  if($post["actions"] !== false)
      $info["actions"] = $post["actions"];





    $res = $fb->api("/{$id['id']}/feed", 'POST', $info);


   if(!$res)
     echo 'Ha ocurrido un error indeterminado';
        elseif($res->error)
     echo "Ha ocurrido un error: {$res->error}";
       else
    echo "OK";  


       }
       catch(FacebookApiException $e){

          die($e->getMessage());

           publicar($post,$id,$ind,$fb);

       }

  }

    die( error("Genial, todo se ha publicado sin problemas",1));

}

  main();
