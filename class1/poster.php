<?php 
//fulstack1/class/poster.php
require_once("parent.php");

class Poster extends ParentClass{
	public function __construct($server, $userid, $pwd, $db){
		parent::__construct($server, $userid, $pwd, $db);
	}

	public function getPoster($idmovie=null, $idgambar=null){
		if(is_null($idgambar) && is_null($idmovie)){
			$sql = "select * from gambar";
			$stmt = $this->mysqli->query($sql);
			return $stmt;
		}
		else{
			$sql = "select * from gambar where idmovie = ?";

			if(!is_null($idgambar)){
				$sql = "select * from gambar where idgambar = ?";
			}

			$stmt = $this->mysqli->prepare($sql);
			if(!is_null($idgambar)){
				$stmt->bind_param("i", $idgambar);
			}
			else{
				$stmt->bind_param("i", $idmovie);
			}

			$stmt->execute();
			$res = $stmt->get_result();	
			return $res;
		}
	}

	public function insertPoster($ext, $idmovie){
		$sql="Insert into gambar (extention,idmovie) values (?,?)";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("si", $ext, $idmovie);
		$stmt->execute();
		return $stmt;
	}
	
	public function deletePoster($idgambar){
		$sql="delete from gambar where idgambar=?";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("i",$idgambar);
		$stmt->execute();
	}
}