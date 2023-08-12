<?php 
	error_reporting(0);
	include 'database.php';

	$artikel = mysqli_query($conn, "SELECT * FROM tb_artikel WHERE id_artikel = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($artikel);

    $komen = mysqli_query($conn, "SELECT * FROM tb_komen WHERE id_komen ='".$_GET['id']."' ");
    $k = mysqli_fetch_object($komen);
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
			    <h1><a href="index.php">Mading Online</a></h1>
			    <ul>
				    <li><a href="artikel.php">Artikel</a></li>
			    </ul>
		    </div>
	    </header>

        <!-- content -->
	    

        <!-- artikel -->
	    <div class="section">
		    <div class="container">
			    <h3><?php echo $p->title ?></h3>
			    <div class="box">
                    <div class="col-2">
					    <img src="postingan/<?php echo $p->gambar ?>" width="100%">
				    </div>

				    <div class="col-2">
					    <p><?php echo $p->konten ?></p>
				    </div>

			    </div>

                <h3>Komentar</h3>
                
                <div class="box">
                    

                    <form action="" method="POST">
                            <input type="text" class="input-control" name="nama" placeholder="nama" required>
                            <input type="text" class="input-control" name="email" placeholder="email" required>
                            <textarea class="input-control" name="komentar" placeholder="komentar..." required></textarea><br>
                            <input type="submit" class="btn" name="submit" value="Submit">
                        </form>

                        <?php
                            if(isset($_POST['submit'])){
                                
                                $artikel    = $_GET['id'];
                                $nama	    = $_POST['nama'];
						        $email   	= $_POST['email'];
                                $komentar	= $_POST['komentar'];

                                $insert = mysqli_query($conn, "INSERT INTO tb_komen VALUES (
                                    null    ,
                                    '".$artikel."',
                                    '".$nama."',
                                    '".$email."',
                                    '".$komentar."') ");

                                if($insert){
                                    echo '<script>alert("Komentar berhasil ditambahkan")</script>';
                                    echo '<script>window.location="read-artikel.php?id=$p[id_artikel]</script>';
                                }else{
                                    echo 'gagal '.mysqli_error($conn);
                                }
                            }
                        ?>

                    <?php
                        $listkomentar = mysqli_query($conn, "SELECT * FROM tb_komen LEFT JOIN tb_artikel USING (id_artikel) ORDER BY id_komen DESC");
                        if(mysqli_num_rows($listkomentar) > 0){
                            while($row = mysqli_fetch_array($listkomentar)){
                    ?>

                          
                    <div class="col-2">
                        <h4>@<?php echo $row['nama'] ?></h4>
                    </div>
                    <div class="col-2">
                        <p><?php echo $row['komentar'] ?></p>
                    </div>

                    <?php }}else{ ?>
                        <p>Belum ada komentar</p>
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