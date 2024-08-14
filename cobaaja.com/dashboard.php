<?php 
    #memulai sebuah sessiom
    session_start();
    
    //session keluar/ logout
    if (isset($_POST['logout'])) {

        #clear semua data
        session_unset();
        #mengakhir semua session
        session_destroy();

        #melempar keluar halaman utama
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
</head>
<body>
   <?php include "layout/header.html" ?>

    <!-- Session ini diambil dari ketika awal login -->
    <h3>Selamat datang <?=$_SESSION["username"] ?></h3>
    <form action="dashboard.php" method="POST">
        <button type="submit" name="logout">logout</button>
    </form>

   <?php include "layout/footer.html" ?>
</body>
</html>