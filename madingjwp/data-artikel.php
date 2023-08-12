<?php 
	session_start();
    include 'database.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
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
        <title>Artikel | MadingJWP</title>
    </head>

    <body>
        <!-- header -->
        <header>
		    <div class="container">
			    <h1><a href="dashboard.php">Mading Online</a></h1>
			    <ul>
				    <li><a href="dashboard.php">Dashboard</a></li>
				    <li><a href="data-artikel.php">Artikel</a></li>
				    <li><a href="keluar.php">Keluar</a></li>
			    </ul>
		    </div>
	    </header>

        <!-- content -->
	    <div class="section">
		    <div class="container">
			    <h3>Artikel</h3>
			    <div class="box">
				    <p><a class="edit" href="buat-artikel.php">Buat Artikel</a></p>
					<br>
				    <table border="1" cellspacing="0" class="table">
					    <thead>
						    <tr>
							    <th>Judul</th>
							    <th width="150px">Aksi</th>
						    </tr>
					    </thead>
					<tbody>
						<?php
							$artikel = mysqli_query($conn, "SELECT * FROM tb_artikel ORDER BY id_artikel DESC");
							if(mysqli_num_rows($artikel) > 0){
							while($row = mysqli_fetch_array($artikel)){
						?>
						<tr>
							<td><?php echo $row['title'] ?></td>
							<td>
                                <a class="edit" href="edit-artikel.php?id=<?php echo $row['id_artikel'] ?>">Edit</a> 
                                <a class="edit" href="proses-hapus.php?id_a=<?php echo $row['id_artikel'] ?>" onclick="return confirm('Yakin ingin hapus ?')">Hapus</a>
                            </td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="7">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
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