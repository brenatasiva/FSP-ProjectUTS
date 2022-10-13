<?php 
include 'db.php';
require_once("class/gambar.php");
require_once("class/movie.php");
require_once("class/pemain.php");
$data_per_page = 8;
$halaman_ke = (isset($_GET['page'])) ? $_GET['page'] : 1;
if(!is_numeric($halaman_ke)) $halaman_ke=1;

$offset = $data_per_page * ($halaman_ke - 1);
$objMovie = new Movie($SERVER, $USERID, $PWD, $DB);
$objGambar = new Gambar($SERVER, $USERID, $PWD, $DB);
$objPemain = new Pemain($SERVER, $USERID, $PWD, $DB);

$arr_movie_genre = array();
$res_genre = $objMovie->getMovieGenre();

while($row_genre = $res_genre->fetch_assoc())
{
	$arr_movie_genre[$row_genre['idmovie']][] = $row_genre['nama'];
}

$arr_gambar_movie = array();
$res_gambar = $objGambar->getGambar();

while($row_gambar = $res_gambar->fetch_assoc()){
	$arr_gambar_movie[$row_gambar['idmovie']][] = $row_gambar['idgambar'].".".$row_gambar['extension'];
}

$arr_pemain_movie = array();
$res_pemain = $objPemain->getDetailPemain();

while ($row_pemain = $res_pemain->fetch_assoc()) {
	$arr_pemain_movie[$row_pemain['idmovie']][] = $row_pemain['nama'];
}
$cari= (isset($_GET['keyword'])) ? $_GET['keyword'] : "";

$keyword = "%".$cari."%";


$res = $objMovie->getMovie(null, $keyword);

$total_data = $res->num_rows;


$res = $objMovie->getMovie(null, $keyword, $offset, $data_per_page);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Grid</title>
	<link rel="stylesheet" href="style.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
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
	<div class="paging">
		 	<?php 
		 	$max_page = ceil($total_data/$data_per_page);

			$prev = ($halaman_ke - 1);	
			$next = ($halaman_ke + 1);

			if ($halaman_ke > 1) {
				echo "<a href = '?page=".$prev."'><i class='arrow left'></i>";
			}
			for ($page=1; $page<=$max_page ; $page++) { 
				
				if ($page==$halaman_ke) {
					echo "<a style='color:red' href = '?page=$page&cari=$cari'>$page</a>";		
				}
				else{
						echo "<a href = '?page=$page&cari=$cari'>$page</a>";//page
				}
				echo "&nbsp; ";
			}

			if ($halaman_ke < $max_page) {
				echo "<a href = '?page=".$next."' ><i class='arrow right'></i></a>";
			}		
		 	 ?>
		 </div>
	<main class="main">
		
		<?php 

		while ($row = $res->fetch_assoc()) {
			$date = DateTime::createFromFormat("Y-m-d", $row['rilis']);
			echo "<div class='movie'>";
			echo	"<a href='halaman_detil.php?id=".$row['idmovie']."'>";
			echo		"<div class='gambar'>";
			if (isset($arr_gambar_movie[$row['idmovie']])) {
								$arr_kumpulan_gambar_pada_movie_ini = $arr_gambar_movie[$row['idmovie']];
								foreach ($arr_kumpulan_gambar_pada_movie_ini as $idgambar) {
									echo "<img src='images/".$idgambar."'>";
								}
							}
			echo "			<div class='rating'>".$row['skor']."</div>";
			echo "</div>";
			echo "<div class='judul'>".$row['judul']." </div>";
			echo "<div class='rilis'>".$date->format('F,d Y')."</div>";
			echo "</div>";
		}
		 ?>
	</main>
	<div class="paging">
		 	<?php 
		 	$max_page = ceil($total_data/$data_per_page);

			$prev = ($halaman_ke - 1);	
			$next = ($halaman_ke + 1);

			if ($halaman_ke > 1) {
				echo "<a href = '?page=".$prev."'><i class='arrow left'></i>";
			}
			for ($page=1; $page<=$max_page ; $page++) { 
				
				if ($page==$halaman_ke) {
					echo "<a style='color:red' href = '?page=$page&cari=$cari'>$page</a>";		
				}
				else{
						echo "<a href = '?page=$page&cari=$cari'>$page</a>";//page
				}
				echo "&nbsp; ";
			}

			if ($halaman_ke < $max_page) {
				echo "<a href = '?page=".$next."' ><i class='arrow right'></i></a>";
			}
		 	 ?>
		 </div>
	<footer class="footer"> 
		<p>Fullstack Programming Mario ft. Billy</p>
	</footer>
</div>
	
</body>
</html>