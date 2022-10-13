	<?php 
//fulstack1/class/pemain.php
require_once("parent.php");

class Pemain extends ParentClass{
	public function __construct($server, $userid, $pwd, $db){
		parent::__construct($server, $userid, $pwd, $db);
	}

	public function getPemainOnly(){
		$res=$this->mysqli->query("SELECT * from pemain");
		return $res;
	}

	public function getPemain($idmovie=null){
		$sql = "select * from pemain p inner join detail_pemain dp on p.idpemain = dp.idpemain";
		
		if(!is_null($idmovie)){
			$sql = "select nama, peran, dp.idpemain as idpemain from pemain p inner join detail_pemain dp on p.idpemain=dp.idpemain where idmovie = ?";
		}
		$stmt = $this->mysqli->prepare($sql);
		if(!is_null($idmovie)){
			$stmt->bind_param("i",$idmovie);
		}
		$stmt->execute();
		$res = $stmt->get_result();	
		return $res;
	}

	public function insertPemain($idgenre, $idmovie){
		
	}

	public function insertDetilPemain($idmovie, $arr_pemain, $arr_peran){
		$i=0;
		foreach($arr_pemain as $idpemain) {
			$sql="Insert into detail_pemain (idmovie,idpemain,peran) Values(?,?,?)";
			$stmt = $this->mysqli->prepare($sql);
			$stmt->bind_param("iis", $idmovie, $idpemain, $arr_peran[$i]);
			$stmt->execute();
			$i+=1;
		}
	}
}