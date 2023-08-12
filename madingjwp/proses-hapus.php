<?php 
	
	include 'database.php';

	if(isset($_GET['id_a'])){
		$delete = mysqli_query($conn, "DELETE FROM tb_artikel WHERE id_artikel = '".$_GET['id_a']."' ");
		$delete = mysqli_query($conn, "DELETE FROM tb_komen WHERE id_artikel = '".$_GET['id_a']."' ");
		echo '<script>window.location="data-artikel.php"</script>';
	}

	if(isset($_GET['id_k'])){
		$delete = mysqli_query($conn, "DELETE FROM tb_komen WHERE id_komen = '".$_GET['id_k']."' ");
		echo '<script>window.location="dashboard.php"</script>';
	}

?>