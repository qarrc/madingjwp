<?php 
	error_reporting(0);
	include 'database.php';
?>

<!DOCTYPE html>
<html>
    <head lang="en" dir="ltr">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        <title>Home | MadingJWP</title>
    </head>

    <body>
        <!-- header -->
        <header>
		    <div class="container">
			    <h1><a href="index.php">Mading Online</a></h1>
			    <ul>
					<li><a href="artikel.php">Artikel</a></li>
			    </ul>
		    </div>
	    </header>

		<!-- search -->
		<div class="search">
			<div class="container">
				<form action="artikel.php">
					<input type="text" name="search" placeholder="Search..." value="<?php echo $_GET['search'] ?>">
					<input type="submit" name="cari" value="Cari">
				</form>
			</div>
		</div>

        <!-- newest -->
	    <div class="section">
		    <div class="container">
			    <h3>Artikel</h3>
			    <div class="box">
				    <?php 
					    if($_GET['search'] != ''){
						    $where = "title LIKE '%".$_GET['search']."%' AND konten LIKE '%".$_GET['search']."%' ";
							$artikel = mysqli_query($conn, "SELECT * FROM tb_artikel WHERE $where ORDER BY id_artikel DESC");
					    }else{
					    	$artikel = mysqli_query($conn, "SELECT * FROM tb_artikel ORDER BY id_artikel DESC");
						}
					    if(mysqli_num_rows($artikel) > 0){
						    while($p = mysqli_fetch_array($artikel)){
				    ?>	
					    <a href="read-artikel.php?id=<?php echo $p['id_artikel'] ?>">
						    <div class="col-4">
							    <img src="postingan/<?php echo $p['gambar'] ?>">
							    <p class="title"><?php echo substr($p['title'], 0, 100) ?> ...</p>
								<p class="konten"><?php echo substr($p['konten'], 0, 200) ?> ...</p>
                                <p class="read">Selengkapnya</p>
						    </div>
					    </a>
				    <?php }}else{ ?>
					    <p>Artikel tidak ada</p>
				    <?php } ?>

					
			    </div>
		    </div>
	    </div>

        <!-- footer -->
        <footer>
            <div class="container">
                <p>Hak Cipta &copy; 2023 Junior Web Program</p>
            </div>
        </footer>
    </body>
</html>