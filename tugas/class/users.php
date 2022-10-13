<?php  
require_once("parent.php");

class Users extends ParentClass{
	public function __construct($server, $userid, $pwd, $db){
		parent::__construct($server, $userid, $pwd, $db);
	}

	private function generateSalt(){
		$salt = substr(session_id(), 0, 5);
		return $salt;
	}

	private function generateSaltedPwd($plainPwd, $salt){
		$saltedPwd = sha1($plainPwd.$salt);
		return $saltedPwd;
	}

	private function getSalt($username){
		$sql = "SELECT salt from users where username=?";
		$salt = $this->mysqli->prepare($sql);
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		$salt = "";
		if($row != false) $salt = $row['salt'];
		return $salt;
	}

	public function doLogin($username, $plainPwd){
		$salt = $this->generateSalt();
		$saltedPwd = $this->generateSaltedPwd($plainPwd, $salt);
		
		$sql = "SELECT * from users where username=? and password=?";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("ss", $username, $saltedPwd);
		$stmt->execute();
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		if($row != false){
			$_SESSION['username'] = $username;
			$_SESSION['nama'] = $row['nama'];
			$_SESSION['profile'] = $row['idprofile'];
			return 1;
		}else{
			return "salah";
		}
	}

	public function doLogout(){
		unset($_SESSION['username']);
		unset($_SESSION['nama']);
		unset($_SESSION['profile']);
	}

	public function registrasiUser($username, $name, $plainPwd, $idprofile){
		$salt = $this->generateSalt();
		$saltedPwd = $this->generateSaltedPwd($plainPwd, $salt);

		$sql = "INSERT into users (nama, username, password, salt, idprofile) values(?,?,?,?,?)";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("ssssi", $name, $username, $saltedPwd, $salt, $idprofile);
		$stmt->execute();
		return $stmt->affected_rows;
	}
}
?>