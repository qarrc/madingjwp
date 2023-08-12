<!DOCTYPE html>
<html>
    <head lang="en" dir="ltr">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        <title>Login | MadingJWP</title>
    </head>

    <body id="bg-login">
        <div class="box-login">
            <h2>Login Sebagai Admin<h2>
            <form action="" method="POST">
                <input type="text" class="input-control" name="admin" placeholder="username" required>
                <input type="password" class="input-control" name="password" placeholder="password" required>
                <input type="submit" class="btn" name="submit" value="Login">
            </form>

            <?php
                if(isset($_POST['submit'])){
                    session_start();
                    include 'database.php';
                    
                    $admin = $_POST['admin'];
                    $password = $_POST['password'];

                    $check = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$admin."' AND password = '".MD5($password)."'");
                    if(mysqli_num_rows($check) > 0){
                        $d = mysqli_fetch_object($check);
                        $_SESSION['status_login'] = true;
                        $_SESSION['admin_globar'] = $d;
                        $_SESSION['id'] = $d->admin_id;
                        echo '<script>window.location="dashboard.php"</script>';
                    }else{
                        echo '<script>alert("Username atau password Anda salah!")</script>';
                    }
                    

                }
            ?>
        </div>
    </body>
</html>