<?php 
session_start();
include "db.php";
require_once("class/movie.php");
require_once("class/genre.php");
require_once("class/poster.php");
require_once("class/pemain.php");
$mysqli = new mysqli("localhost","root","","fullstack");
if($mysqli->connect_errno){
	echo "Failed to connect to MySQL: ".$mysqli->connect_error;
}
$data_per_page = 4;
$halaman_ke = (isset($_GET['page'])) ? $_GET['page'] : 1;
if(!is_numeric($halaman_ke)) $halaman_ke=1;
$offset = $data_per_page * ($halaman_ke - 1);
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Movie</title>
	<link rel="stylesheet" href="style.css">
	<script type="text/javascript" src="jquery.js"></script>
</head>

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
		<div id=content>
	
			<div id="div-list-movie">
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

						$cari=(isset($_GET['btncari'])) ? $_GET['txtcari'] : "";
						$keyword="%".$cari."%";
						$objMovie = new movie($SERVER, $USERID, $PWD, $DB);
						$res = $objMovie->getMovie($keyword);

						$total_data=$res->num_rows;
						$res = $objMovie->getMovie($keyword, $offset, $data_per_page, null);
					
						
					while($row=$res->fetch_assoc()){
						echo "<a href='halaman_detil.php?id=".$row['idmovie']."' id='a_movie'><div id='div-movie'>";
						echo 	"<div id='div-gambar'>";
							if(isset($arr_gambar[$row['idmovie']])){
								$arr_kumpulan_gambar=$arr_gambar[$row['idmovie']];
								echo "<img src='../w1/gambar/".$arr_kumpulan_gambar[0]."'>";
							}
							echo "</div>";
							echo "<div id='div-deskripsi'>";
							echo 	"<h1 id='judul'>".$row['judul']."</h1>";
							echo 	"<p id='tgl-rilis'>Tanggal Rilis: ".date("d M Y",strtotime($row['rilis']))."</p>";
							echo 	"<p id='sinopsis'>".$row['sinopsis']."</p>";
							echo "</div>";
						echo "</div></a>";
					}
					
				?>
			</div>
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
			
			
		</div>
		<footer class="footer"> 
		<p>Fullstack Programming Mario ft. Billy</p>
		</footer>
	</div>

</body>
</html>
<?php  
$mysqli->close();
?>