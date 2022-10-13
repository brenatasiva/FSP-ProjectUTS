<?php 
//fulstack1/class/pemain.php
require_once("parent.php");

class Profile extends ParentClass{
	public function __construct($server, $userid, $pwd, $db){
		parent::__construct($server, $userid, $pwd, $db);
	}

	private function generateSalt(){
		$salt = substr(session_id(), 0, 5);
		return $salt;
	}
}