<?php 

require_once('parent.php');

/**
 * 
 */
class Gambar extends ParentClass
{
	
	function __construct($server, $userid, $pwd, $db)
	{
		parent::__construct($server, $userid, $pwd, $db);
	}

	public function insertGambar($ext, $idmovie)
	{
		$sql = "INSERT Into gambar (extension, idmovie) VALUES (?, ?)";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("si", $ext, $idmovie);
		$stmt->execute();
		$idphoto = $stmt->insert_id;

		return $idphoto;
	}

	public function getGambar($idmovie=null,$idgambar=null,$value=null)
	{
		$sql = "select * from gambar";
		if (!is_null($idmovie)) {
			$sql = "select * from gambar where idmovie = ?";
			$stmt = $this->mysqli->prepare($sql);
			$stmt->bind_param("i", $idmovie);
			$stmt->execute();
			$res_gambar = $stmt->get_result();
		}
		elseif (!is_null($idgambar)) {
			$sql = "SELECT * FROM gambar WHERE idgambar = ?";
			$stmt = $this->mysqli->prepare($sql);
			$stmt->bind_param("i", $value);
			$stmt->execute();
			$res_gambar = $stmt->get_result();
		}
		else
		{
			$res_gambar = $this->mysqli->query($sql);
		}		

		return $res_gambar;
	}

	public function deleteGambar($idgambar,$value)
	{
		$sql = "DELETE from gambar where idgambar = ?";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("i", $value);
		$stmt->execute();
	}
}


?>