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
        <title>Dashboard | MadingJWP</title>
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
			    <h3>Dashboard</h3>
			    <div class="box">
				    <h4>Selamat Datang</h4>
			    </div>

				<div class="box">
				    <h4>Komentar Terbaru</h4>

                    <table border="1" cellspacing="0" class="table">
					    <thead>
						    <tr>
                                <th>Nama</th>
                                <th>Komentar</th>
							    <th>Judul Artikel</th>
							    <th width="150px">Aksi</th>
						    </tr>
					    </thead>
					    <tbody>
                            <?php
                                $listkomentar = mysqli_query($conn, "SELECT * FROM tb_komen LEFT JOIN tb_artikel USING (id_artikel) ORDER BY id_komen DESC");
                                if(mysqli_num_rows($listkomentar) > 0){
                                    while($row = mysqli_fetch_array($listkomentar)){
                            ?>
						    <tr>
                                <td><?php echo $row['nama'] ?></td>
                                <td><?php echo $row['komentar'] ?></td>
							    <td><?php echo $row['title'] ?></td>
							    <td> 
                                    <a class="edit" href="proses-hapus.php?id_k=<?php echo $row['id_komen'] ?>" onclick="return confirm('Yakin ingin hapus ?')">Hapus</a>
                                </td>
						    </tr>
						    <?php }}else{ ?>
							    <tr>
                                    <td>Tidak ada data</td>
                                    <td>Tidak ada data</td>
								    <td>Tidak ada data</td>
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