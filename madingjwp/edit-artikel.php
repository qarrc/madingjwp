<?php 
	session_start();
	include 'database.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	$artikel = mysqli_query($conn, "SELECT * FROM tb_artikel WHERE id_artikel = '".$_GET['id']."' ");
	if(mysqli_num_rows($artikel) == 0){
		echo '<script>window.location="data-artikel.php"</script>';
	}
	$a = mysqli_fetch_object($artikel);
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
			    <h3>Buat Artikel</h3>
			    <div class="box">
				    <form action="" method="POST" enctype="multipart/form-data">
                        
                        <img src="postingan/<?php echo $a->gambar ?>" width="100px">
                        <input type="hidden" name="foto" value="<?php echo $a->gambar ?>">
					    <input type="file" name="gambar" class="input-control" required>
                        <input type="text" name="title" class="input-control" placeholder="Judul" value="<?php echo $a->title ?>" required>
					    <textarea class="input-control" name="konten" placeholder="Konten" value="<?php echo $a->konten ?>" required></textarea><br>
					    <input type="submit" name="submit" value="Submit" class="btn">
				</form>
				<?php 
					if(isset($_POST['submit'])){

						// print_r($_FILES['gambar']);
						// menampung inputan dari form
						$artikel 	= $_POST['artikel'];
						$title 	    = $_POST['title'];

						// menampung data file yang diupload
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

                        // jika admin ganti gambar
                        if($filename !=''){
						    $type1 = explode('.', $filename);
						    $type2 = $type1[1];
                        
						    $newname = 'artikel'.time().'.'.$type2;

						    // menampung data format file yang diizinkan
						    $tipe_diizinkan = array('jpg', 'jpeg', 'png');

						    // validasi format file
						    if(!in_array($type2, $tipe_diizinkan)){
							    // jika format file tidak ada di dalam tipe diizinkan
							    echo '<script>alert("Gunakan format file .jpg, .jpeg, atau .png")</scrtipt>';

						    }else{
                                unlink('./postingan/'.$foto);
                                move_uploaded_file($tmp_name, './posting/'.$newname);
                                $namagambar = $newname;
                            }
                        }else{

                            //jika admin tidak ganti gambar
                            $namagambar = $foto;
                        }

                        //query update data produk
						$update = mysqli_query($conn, "UPDATE tb_artikel SET
									title  =	'".$title."',
									konten =	'".$konten."',
									gambar =	'".$namagambar."'
                                    WHERE id_artikel = '".$a->id_artikel."'");

						if($update){
							echo '<script>alert("Ubah data berhasil")</script>';
							echo '<script>window.location="data-artikel.php"</script>';
						}else{
							echo 'gagal '.mysqli_error($conn);
                        }
					}
					
				?>
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