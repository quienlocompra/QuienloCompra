<?php
// Usuario
class User
{
	private $_uid;
	private $_user;

	private $_db_server = db_server;
	private $_db_user = db_user;
	private $_db_pass = db_password;
	private $_db_bdata = db_bdata;
	private $_tb_users = tb_users;

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

	public function uid (){
		return $this->_uid;
	}

	public function error (){
		return $this->_error;
	}

	public function consult ($what, $key = "user") {
		if ( $what == "pass" ){
			$this->_error = "No se puede consultar este dato";
			return false;
		}else{
			switch( $key ){
				case "uid": $query = "SELECT `{$what}` FROM `{$this->_tb_users}` WHERE `uid` = '{$this->_uid}'"; break;
				default: $query = "SELECT `{$what}` FROM `{$this->_tb_users}` WHERE `user` = '{$this->_user}'"; break;
			}
			$conexion = $this->_mysqli;
			if ($get_data = $conexion->query($query)){
				while($result = $get_data->fetch_assoc()){
					return $result[$what];
				}
			}
		}
	}

	private function _password () {
		$query = "SELECT `pass` FROM `{$this->_tb_users}` WHERE `user` = '{$this->_user}'";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return $result['pass'];
			}
		}
	}

	// Setter

	public function setUid ($uid) {
		$this->_uid = $uid;
		$this->_user = $this->consult("user", "uid");
	}

	public function setUser ($user) {
		$this->_user = $user;
		$this->_uid = $this->consult("uid");
	}

	// Functions

	public function register ($data){
		$conexion = $this->_mysqli;

		$uid = genKey("uid");
			$this->_uid = $uid;

		$this->_user = $data['user'];

		$pass = md5($data['pass']);

		date_default_timezone_set("America/Mexico_City");
		$date = date("w Y-m-j g:i:s:a");
		$login = "1";
		$status = "1";

		$query = "INSERT INTO `{$this->_tb_users}` (`uid`, `user`, `email`, `pass`, `register`, `login`, `status`)"
			. "VALUES (?, ?, ?, ?, ?, ?, ?)"
		;
		$ins = $conexion->prepare($query);
		$ins->bind_param( 'sssssss', $uid, $data['user'], $data['email'], $pass, $date, $login, $status );
		$insert = $ins->execute();

		if ( !$insert ) {
			$this->_error = "No se pudo registrar usuario";
			return false;
		}else{
			return true;
		}
	}

	public function regcomplete( $data ){
		$this->_update( 'name', $data['name'] );
		$this->_update( 'bird', $data['bird'] );
		$this->_update( 'gen', $data['gen'] );
		$this->_update( 'country', $data['country'] );
		$this->_update( 'type', $data['type'] );
		return true;
	}

	public function exist ( $who ){
		$conexion = $this->_mysqli;
		$sql = "SELECT `user` FROM `{$this->_tb_users}` WHERE `user` = '{$who}'";
		$conexion->query($sql);
		if ( $conexion->affected_rows > 0 ){
			return true;
		}else{
			return false;
		}
	}

	private function _update ($what, $newVal){
		$conexion = $this->_mysqli;
		$query = "UPDATE `{$this->_tb_users}` SET `{$what}` = ? WHERE `user` = '{$this->_user}'";
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

	public function login ($pass){
		if ( $this->_password() == md5($pass) ){
			$this->_update('login', '0');
			return true;
		}else{
			$this->_error = "La contraseña no coincide";
			return false;
		}
	}

	public function logout (){
		$this->_update('login', '0');
	}

	public function addApp($app){
		$apps = $this->consult("apps");
		$apps = explode(";", $apps);
		if ( !in_array($app, $apps) ){
			$newApp = $this->consult("apps") . $app . ";";
			$this->_update("apps", $newApp);
		}
	}

	public function setpic ( $pid ){
		$this->_update("pic", $pid);
		return true;
	}

	public function close (){
		$conexion = $this->_mysqli;
		$conexion->close();
	}
}