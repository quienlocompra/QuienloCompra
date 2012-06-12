<?php
// Imagen
class Picture
{
	private $_pid;

	private $_db_server = db_server;
	private $_db_user = db_user;
	private $_db_pass = db_password;
	private $_db_bdata = db_bdata;
	private $_tb_pictures = tb_pictures;

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

	public function pid (){
		return $this->_pid;
	}

	public function error (){
		return $this->_error;
	}

	public function consult ($who, $what) {
		$query = "SELECT `{$what}` FROM `{$this->_tb_pictures}` WHERE `pid` = '{$who}'";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return $result[$what];
			}
		}
	}

	public function geturi ($what) {
		return $this->consult($what, 'uri');
	}

	public function listPictures ($pictures){
		$pictures = substr($pictures, 0, -1);
		$pictures = explode(";", $pictures);
		$pictures_count = count($pictures);
		if ( $pictures_count > 0 ){
			for ( $e = 0; $e < $pictures_count; $e++){
				$pic = $pictures[$e];
				$pictures[$e] = array (
					'pid' => $pic,
					'title' => $this->consult($pic, 'title'),
					'description' => $this->consult($pic, 'description'),
					'date' => $this->consult($pic, 'date'),
					'url' => dirpic . "/" . $this->consult($pic, 'uri')
				);
			}
			return $pictures;
		}else{
			return Array();
		}
	}

	// Functions

	public function newpic ($data){
		$conexion = $this->_mysqli;

		$pid = genKey("pid");
			$this->_pid = $pid;

		date_default_timezone_set("America/Mexico_City");
		$date = date("w Y-m-j g:i:s:a");

		$ext = explode('.', $data['pic']['name']);
		$ext = '.' . end($ext);
		$uri = $pid . $ext;
		move_uploaded_file( $data['pic']['tmp_name'], '../pictures/' . $uri );

		$query = "INSERT INTO `{$this->_tb_pictures}` (`pid`, `author`, `title`, `description`, `date`, `uri`)"
			. "VALUES (?, ?, ?, ?, ?, ?)"
		;
		$ins = $conexion->prepare($query);
		$ins->bind_param( 'ssssss', $pid, $data['author'], $data['title'], $data['description'], $date, $uri );
		$insert = $ins->execute();

		if ( !$insert ) {
			$this->_error = "No se pudo registrar usuario";
			return false;
		}else{
			return true;
		}
	}

	private function _update ($what, $newVal){
		$conexion = $this->_mysqli;
		$query = "UPDATE `{$this->_tb_pictures}` SET `{$what}` = ? WHERE `pid` = '{$this->_user}'";
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