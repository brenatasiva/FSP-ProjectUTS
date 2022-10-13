<?php 

include "db.php";
require_once("class/movie.php");
require_once("class/genre.php");
require_once("class/poster.php");
require_once("class/pemain.php");
$mysqli = new mysqli("localhost","root","","webprog");
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
<link rel="stylesheet" href="style.css">
<!-- <style type="text/css">
	table,th,td,tr {border-style: solid;}
	table {border-collapse: collapse; width: 80%; text-align: center;}
	img	{height: 175px; margin: 3px 5px}
</style> -->
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
		$arr_gambar[$row_gambar['idmovie']][]=$row_gambar['idgambar'].".".$row_gambar['extension'];
	}

	$objPemain = new pemain($SERVER, $USERID, $PWD, $DB);
	$res_pemain = $objPemain->getPemain();

	while ($row_pemain=$res_pemain->fetch_assoc()) {
		$arr_pemain[$row_pemain['idmovie']][]=$row_pemain['nama'];
	}
		
		$objMovie = new movie($SERVER, $USERID, $PWD, $DB);
		$res = $objMovie->getMovie(null, null, null, $idmovie);
?>
<div class="container">
	<header class="header">
		<nav class="nav">
			<div class="logo"><img src="images/mbflix.png" ></div>
			<ul>
				<li><a href="">Genre</a></li>
				<li><a href="">Pemain</a></li>
			</ul>
		</nav>
		<div class="search">
			<div class="textbox">
				<input type="text" placeholder="Cari Judul Film">
				<a href="#" class="fa fa-search"></a>
			</div>
			<a href="#" class='fas fa-user-alt'></a>
		</div>	
	</header>
	<main class="content">
<?php  

				$row = $res->fetch_assoc();

						if(isset($arr_gambar[$row['idmovie']])){
						$arr_kumpulan_gambar=$arr_gambar[$row['idmovie']];

					}
						
							if(isset($arr_genre[$row['idmovie']])){
								$arr_kumpulan_genre_pada_movie_ini=$arr_genre[$row['idmovie']];
							}
			$date = DateTime::createFromFormat("Y-m-d", $row['rilis']);
			?>

		<div class="title">
			<div class="picture"><?php 
							echo "<img src='../w1/gambar/".$arr_kumpulan_gambar[0]."'>";
						?></div>
			<div class="attr">
				<div class="detil-judul">
					<div class="juduljuga"><?php echo $row['judul']." (".$date->format('Y').")"; ?></div>
					<div class="tahun-rilis"><?php echo $date->format('d F Y')?></div>
				</div>
				<div class="detil-rating"><div class="rating-film"><?php echo $row['skor']; ?></div></div>
				<div class="genre">
					<ul>
						<?php 
						foreach ($arr_kumpulan_genre_pada_movie_ini as $key => $value) {
							echo "<li>$value</li>";
						}
						 ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="sinopsis">
			<div class="judul-sinopsis">
				Synopsis
			</div>
			<div class="isi">
				<p><?php echo $row['sinopsis'] ?></p>
			</div>
		</div>
	
	</main>
	<footer class="footer"> 
		<p>Fullstack Programming Mario ft. Billy</p>
	</footer>
</div>
</body>
</html>