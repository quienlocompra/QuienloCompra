<?php
// Aplicacion
class App
{
	private $_appID;
	private $_appKey;

	private $_db_server = db_server;
	private $_db_user = db_user;
	private $_db_pass = db_password;
	private $_db_bdata = db_bdata;
	private $_tb_apps = tb_apps;

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

	// Setter

	public function setID($appID){
		$this->_appID = $appID;
	}

	public function setKey($appKey){
		$this->_appKey = $appKey;
	}

	// Getter

	public function turnAccess (){
		if ( $this->consult('appkey', $this->_appID) == $this->_appKey ){
			return 'on';
		}else{
			$this->_error = 'El appKey no coincide con el appID';
			return 'off';
		}
	}

	public function error (){
		return $this->_error;
	}

	public function consult ($what) {
		$query = "SELECT `{$what}` FROM `{$this->_tb_apps}` WHERE `appid` = '{$this->_appID}'";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return $result[$what];
			}
		}
	}

	// Functions

	private function _update ($what, $newVal){
		$conexion = $this->_mysqli;
		$query = "UPDATE `{$this->_tb_apps}` SET `{$what}` = ? WHERE `appid` = '{$this->_appID}'";
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

	public function addUser($user){
		$users = $this->consult("users");
		$users = explode(";", $users);
		if ( !in_array($user, $users) ){
			$newUser = $this->consult("users") . $user . ";";
			$this->_update("users", $newUser);
		}
	}

	public function close (){
		$conexion = $this->_mysqli;
		$conexion->close();
	}
}