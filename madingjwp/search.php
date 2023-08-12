<?php 
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
				    <li><a href="login.php">Masuk Sebagai Admin</a></li>
			    </ul>
		    </div>
	    </header>

		<!-- search -->
		<div class="search">
			<div class="container">
				<form action="search.php">
					<input type="text" name="search" placeholder="Search..." value="<?php echo $_GET['search'] ?>">
                    <input type="hidden" name="art" value="<?php echo $_GET['art'] ?>">
					<input type="submit" name="cari" value="Cari">
				</form>
			</div>
		</div>

        <!-- Pencarian -->
	    <div class="section">
		    <div class="container">
			    <h3>Produk</h3>
			    <div class="box">
				    <?php 
					    if($_GET['search'] != '' || $_GET['art'] != ''){
						    $where = "AND title LIKE '%".$_GET['search']."%' AND id_artikel LIKE '%".$_GET['art']."%' ";
					    }

					    $produk = mysqli_query($conn, "SELECT * FROM tb_artikel WHERE product_status = 1 $where ORDER BY product_id DESC");
					    if(mysqli_num_rows($produk) > 0){
						    while($p = mysqli_fetch_array($produk)){
				    ?>	
					<a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
					    <div class="col-4">
						    <img src="produk/<?php echo $p['product_image'] ?>">
						    <p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
						    <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
					    </div>
					</a>
				    <?php }}else{ ?>
					    <p>Produk tidak ada</p>
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