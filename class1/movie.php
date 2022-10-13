<?php 
//fulstack1/class/movie.php
require_once("parent.php");

class Movie extends ParentClass{
	public function __construct($server, $userid, $pwd, $db){
		parent::__construct($server, $userid, $pwd, $db);
	}

	public function getMovie($keyword=null, $offset=null, $limit=null, $idmovie=null){
		if(!is_null($idmovie)){
			$sql = "Select * from movie where idmovie = ?";
			$stmt = $this->mysqli->prepare($sql);
			$stmt->bind_param("i",$idmovie);
		}else{
			$sql = "select * from movie where judul like ?";
			if(!is_null($offset)){
				$sql .= " limit ?,?";
			}
			// echo "-".$offset."-<br>";
			// echo "-".$limit."-<br>"; 
			// die();
			$stmt = $this->mysqli->prepare($sql);
			if(!is_null($offset)){
				$stmt->bind_param("sii",$keyword, $offset, $limit);
			} else{
				$stmt->bind_param("s",$keyword);
			}
		}
		
		$stmt->execute();
		$res = $stmt->get_result();	
		return $res;
	}

	public function insertMovie($judul, $rilis, $skor, $sinopsis, $serial){
		$sql = "Insert into movie (judul, rilis, skor, sinopsis, serial) 
			values(?, ?, ?, ?, ?)";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("ssdsi", $judul, $rilis, $skor, $sinopsis, $serial);
		$stmt->execute();
		$idmovie = $stmt->insert_id;
		return $idmovie;
	}

	public function updateMovie($judul, $rilis, $skor, $sinopsis, $serial, $idmovie){
		$sql = "update movie set judul = ?, rilis = ?, skor = ?, sinopsis = ?, serial = ? where idmovie = ?";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("ssdsii", $judul, $rilis, $skor, $sinopsis, $serial, $idmovie);
		$stmt->execute();
	}
}
?>