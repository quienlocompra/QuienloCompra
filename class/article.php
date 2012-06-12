<?php
// Imagen
class Article
{
	private $_aid;

	private $_db_server = db_server;
	private $_db_user = db_user;
	private $_db_pass = db_password;
	private $_db_bdata = db_bdata;
	private $_tb_articles = tb_articles;

	private $_mysqli;
	private $_error = "No hay error";

	public function __construct (){
		$mysqli = new mysqli($this->_db_server, $this->_db_user, $this->_db_pass, $this->_db_bdata);
		if ( mysqli_connect_errno ()) {
			$this->_error = "No se pudo conectar con la base de datos";
			return false;
		}else{
			$this->_mysqli = $mysqli;
			return true;
		}
	}

	// Getter

	public function aid (){
		return $this->_aid;
	}

	public function error (){
		return $this->_error;
	}

	public function consult ($who, $what) {
		$query = "SELECT `{$what}` FROM `{$this->_tb_articles}` WHERE `aid` = '{$who}'";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return $result[$what];
			}
		}
	}

	public function listArticles ($articles){
		$articles = substr($articles, 0, -1);
		$articles = explode(";", $articles);
		$articles_count = count($articles);
		if ( $articles_count > 0 ){
			for ( $e = 0; $e < $articles_count; $e++){
				$art = $articles[$e];

				$pic = new Picture ();
				$pictures = $pic->listPictures( $this->consult($art, 'pics') );

				$articles[$e] = array (
					'aid' => $art,
					'title' => $this->consult($art, 'title'),
					'description' => $this->consult($art, 'description'),
					'date' => $this->consult($art, 'create'),
					'price' => $this->consult($art, 'price'),
					'region' => $this->consult($art, 'money'),
					'pics' => $pictures
				);
			}
			return $articles;
		}else{
			return Array();
		}
	}

	// Setter

	public function setAid ($uid) {
		$this->_aid = $uid;
	}

	// Functions

	public function newarticle (){
	}

	private function _update ($what, $newVal){
		$conexion = $this->_mysqli;
		$query = "UPDATE `{$this->_tb_articles}` SET `{$what}` = ? WHERE `aid` = '{$this->_user}'";
		$up = $conexion->prepare($query);
		$up->bind_param ( 's', $newVal );
		$upd = $up->execute();
		if ( !$upd ) {
			$this->_error = "No se pudo actualizar";
			return false;
		}else{
			return true;
		}
	}

	public function close (){
		$conexion = $this->_mysqli;
		$conexion->close();
	}
}