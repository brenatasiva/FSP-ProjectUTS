<?php 
//fulstack1/class/parent.php

class ParentClass{
	protected $mysqli;

	public function __construct($server, $userid, $pwd, $db){
		$this->mysqli = new mysqli($server, $userid, $pwd, $db);
	}
	
	function __detruct(){
		$this->mysqli->close();
	}
}


?>