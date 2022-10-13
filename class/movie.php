<?php 

require_once("parent.php");

class Movie extends ParentClass
{

	public function __construct($server, $userid, $pwd, $db)
	{
		parent::__construct($server, $userid, $pwd, $db);
	}

	public function getMovie($idmovie=null, $keyword=null, $offset=null, $limit=null)
	{
		$sql = "SELECT * from movie Where judul LIKE ?";
		if (!is_null($offset)) 
		{
			$sql .= " LIMIT ?,?";
		}
		elseif (!is_null($idmovie)) {
			$sql = "SELECT * FROM movie WHERE idmovie = ?";
		}
		$stmt = $this->mysqli->prepare($sql);

		if(!is_null($offset))
		{
			$stmt->bind_param("sii",$keyword,$offset,$limit);
		}
		elseif(!is_null($keyword))
		{
			$stmt->bind_param("s", $keyword);
		}
		else
		{
			$stmt->bind_param("i", $idmovie);
		}
		$stmt->execute();
		$res = $stmt->get_result();

		return $res;
	}

	public function getMovieGenre()
	{
		$sql = "select gm.idmovie, g.nama From genre_movie gm inner join genre g on gm.idgenre=g.idgenre";
		$res_genre = $this->mysqli->query($sql);
		return $res_genre;
	}

	public function insertMovie($judul, $rilis, $skor, $sinopsis, $serial, $arr_genre)
	{
		$sql = "INSERT Into movie (judul,rilis,skor,sinopsis, serial) Values (?, ?, ?, ?, ?)";
		$stmt = $this->mysqli->prepare($sql);
		// i=integer, d=double, s=string, b=blob
		$stmt->bind_param("ssdsi", $judul, $rilis, $skor, $sinopsis, $serial);
		$stmt->execute();

		$idmovie = $stmt->insert_id;

		// if(!empty($idmovie)){

		// 	foreach($arr_genre as $idgenre){
		// 		$sql = "Insert into genre_movie (idmovie, idgenre) value(?,?)";
		// 		$stmt = $this->mysqli->prepare($sql);
		// 		$stmt->bind_param("ii",$idmovie,$idgenre);
		// 		$stmt->execute();
		// 	}

		// 	$jumlahGambar = count($_FILES['gambar']['name']);
		// 	for ($i=0; $i < $jumlahGambar; $i++) { 
		// 		if (!empty($_FILES['gambar']['name'][$i])) {
		// 			$file_info = getimagesize($_FILES['gambar']['tmp_name'][$i]);
		// 			if (!empty($file_info)) 
		// 			{
		// 				if ($_FILES['gambar']['type'][$i] == 'image/jpeg' || $_FILES['gambar']['type'][$i] == 'image/png') 
		// 				{
		// 					$ext = pathinfo($_FILES['gambar']['name'][$i],PATHINFO_EXTENSION);
		// 					$sql = "INSERT Into gambar (extension, idmovie) VALUES (?, ?)";
		// 					$stmt = $mysqli->prepare($sql);
		// 					$stmt->bind_param("si", $ext, $idmovie);
		// 					$stmt->execute();
		// 					$idphoto = $stmt->insert_id;

		// 					move_uploaded_file($_FILES['gambar']['tmp_name'][$i], "gambar/".$idphoto.".".$ext);
		// 				}
		// 			}
		// 		}
		// 	}
		// }
		// $arr_pemain = $_POST['pemain'];
		// $arr_peran = $_POST['peran'];
		// $i = 0;
		// foreach ($arr_pemain as $idpemain)
		// {
		// 	$sql = "Insert into detail_pemain (idmovie, idpemain, peran) value(?, ?, ?)";
		// 	$stmt = $this->mysqli->prepare($sql);
		// 	$stmt->bind_param("iis",$idmovie,$idpemain,$arr_peran[$i]);
		// 	$stmt->execute();
		// 	$i = $i +1;
		// }

		// $stmt->close();
		return $idmovie;
	}

	public function insertMovieGenre($arr_genre, $idmovie)
	{
		foreach($arr_genre as $idgenre){
			$sql = "Insert into genre_movie (idmovie, idgenre) value(?,?)";
			$stmt = $this->mysqli->prepare($sql);
			$stmt->bind_param("ii",$idmovie,$idgenre);
			$stmt->execute();
		}
	}

	public function editMovie($judul, $rilis, $skor, $sinopsis, $serial, $idmovie)
	{
		$sql = "UPDATE movie SET judul = ?, rilis = ?, skor = ?, sinopsis = ?, serial = ? where idmovie = ?";
		$stmt = $this->mysqli->prepare($sql);
		// i=integer, d=double, s=string, b=blob
		$stmt->bind_param("ssdsii", $judul, $rilis, $skor, $sinopsis, $serial, $idmovie);
		$stmt->execute();
	}

	
}

 ?>