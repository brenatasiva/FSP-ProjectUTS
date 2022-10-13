<?php 

require_once('parent.php');

/**
 * 
 */
class Pemain extends ParentClass
{
	
	function __construct($server, $user, $pwd, $db)
	{
		parent::__construct($server, $user, $pwd, $db);
	}

	public function insertDetailPemain($arr_pemain, $arr_peran, $idmovie)
	{

		$i = 0;
		foreach ($arr_pemain as $idpemain){
			$sql = "Insert into detail_pemain (idmovie, idpemain, peran) value(?, ?, ?)";
			$stmt = $this->mysqli->prepare($sql);
			$stmt->bind_param("iis",$idmovie,$idpemain,$arr_peran[$i]);
			$stmt->execute();
			$i = $i +1;
		}
	}

	public function getDetailPemain($idmovie=null)
	{
		$sql = "SELECT idmovie, nama FROM detail_pemain dp INNER JOIN pemain p on p.idpemain = dp.idpemain";
		if (!is_null($idmovie)) 
		{
			$sql = "SELECT idmovie, dp.idpemain, nama, peran FROM detail_pemain dp INNER JOIN pemain p on p.idpemain = dp.idpemain where idmovie = ?";
				$stmt = $this->mysqli->prepare($sql);
				$stmt->bind_param("i", $idmovie);
				$stmt->execute();
				$res_pemain = $stmt->get_result();
		}
		else
		{
			$res_pemain = $this->mysqli->query($sql);
		}
		

		return $res_pemain;
	}

	public function getPemain($idmovie=null)
	{
		$sql = "SELECT * FROM pemain";
		if (!is_null($idmovie)) {
			# code...
		}
		$res = $this->mysqli->query($sql);

		return $res;
	}

	public function deleteDetailPemain($idmovie)
	{
		$sql = "DELETE FROM detail_pemain where idmovie = ?";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("i", $idmovie);
		$stmt->execute();
	}
}

 ?>