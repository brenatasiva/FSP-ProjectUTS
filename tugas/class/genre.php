<?php 
//fulstack1/class/genre.php
require_once("parent.php");

class Genre extends ParentClass{
	public function __construct($server, $userid, $pwd, $db){
		parent::__construct($server, $userid, $pwd, $db);
	}
	public function getGenre(){
		$res = $this->mysqli->query("SELECT * from genre");
		return $res;
	}

	public function getGenreMovie($idmovie=null){
		if (!is_null($idmovie)) {
			# code...
		$sql = $sql="select * from genre where idmovie = ?";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("i",$idmovie);
		$stmt->execute();
		$res=$stmt->get_result();
		}
		if(is_null($idmovie)){
			$sql="select idmovie,nama from genre_movie gm inner join genre g on gm.idgenre=g.idgenre";
			$res = $this->mysqli->query($sql);
		}
		return $res;
		
	}

	public function insertGenreMovie($arr_genre, $idmovie){
		foreach($arr_genre as $idgenre){
			$sql = "Insert into genre_movie (idmovie, idgenre) Values(?,?)";
			$stmt = $this->mysqli->prepare($sql);
			$stmt->bind_param("ii", $idmovie, $idgenre);
			$stmt->execute();
		}
	}
	
}