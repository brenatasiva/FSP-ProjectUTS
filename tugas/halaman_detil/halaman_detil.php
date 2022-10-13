<?php 
session_start();
if(!isset($_SESSION['username'])){
	header("location: login.php");
}
include "db.php";
require_once("class/movie.php");
require_once("class/genre.php");
require_once("class/poster.php");
require_once("class/pemain.php");
$mysqli = new mysqli("localhost","root","","fullstack");
if($mysqli->connect_errno){
	echo "Failed to connect to MySQL: ".$mysqli->connect_error;
}
$idmovie = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detil Movie</title>
</head>
<style type="text/css">
	table,th,td,tr {border-style: solid;}
	table {border-collapse: collapse; width: 80%; text-align: center;}
	img	{height: 175px; margin: 3px 5px}
</style>
<body>
<?php  
	$arr_genre=array();
	$arr_gambar=array();
	$arr_pemain=array();

	$objGenre = new genre($SERVER, $USERID, $PWD, $DB);
	$res_genre = $objGenre->getGenreMovie();

	while($row=$res_genre->fetch_assoc()){
		$arr_genre[$row['idmovie']][]=$row['nama'];
	}

	$objPoster = new poster($SERVER, $USERID, $PWD, $DB);
	$res_gambar = $objPoster->getPoster();

	while($row_gambar=$res_gambar->fetch_assoc()){
		$arr_gambar[$row_gambar['idmovie']][]=$row_gambar['idgambar'].".".$row_gambar['extention'];
	}

	$objPemain = new pemain($SERVER, $USERID, $PWD, $DB);
	$res_pemain = $objPemain->getPemain();

	while ($row_pemain=$res_pemain->fetch_assoc()) {
		$arr_pemain[$row_pemain['idmovie']][]=$row_pemain['nama'];
	}
		
		$objMovie = new movie($SERVER, $USERID, $PWD, $DB);
		$res = $objMovie->getMovie(null, null, null, $idmovie);
?>
<table>
	<thead>
		<tr>
			<th>Judul</th>
			<th>Tgl Rilis</th>
			<th>Skor</th>
			<th>Sinopsis</th>
			<th>Serial</th>
			<th>Genre</th>
			<th>Cast</th>
			<th>Poster</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php  
				$row = $res->fetch_assoc();

				echo "<tr>";
				echo 	"<td>".$row['judul']."</td>";
				echo 	"<td>".$row['rilis']."</td>";
				echo 	"<td>".$row['skor']."</td>";
				echo 	"<td>".$row['sinopsis']."</td>";
				echo 	"<td>".$row['serial']."</td>";
				echo "<td>";
					if(isset($arr_genre[$row['idmovie']])){
						$arr_kumpulan_genre_pada_movie_ini=$arr_genre[$row['idmovie']];
						echo implode(", ",$arr_kumpulan_genre_pada_movie_ini);
					}
				echo "</td>";
				echo "<td>";
					if(isset($arr_pemain[$row['idmovie']])){
						$arr_kumpulan_pemain=$arr_pemain[$row['idmovie']];
						echo implode(", ",$arr_kumpulan_pemain);
					}
				echo "</td>";
				echo "<td>";
					if(isset($arr_gambar[$row['idmovie']])){
						$arr_kumpulan_gambar=$arr_gambar[$row['idmovie']];
						for ($i=0; $i < count($arr_kumpulan_gambar); $i++) { 
							echo "<img src='img/".$arr_kumpulan_gambar[$i]."'>";
						}
					}
				echo "</td>";
			?>
		</tr>
	</tbody>
</table>
</body>
</html>