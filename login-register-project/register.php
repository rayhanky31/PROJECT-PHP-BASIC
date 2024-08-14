<?php 
    #Nyambungkan ke database
    include "service/database.php";

    #memulai session
    session_start();

    //inisiasi untuk pesan akan ditampilkan
    $register_msg = "";

        //membuat validasi supaya tidak bisa keluar dari sesi dashboard
        if (isset($_SESSION["is_login"])){
            header("location:dashboard.php");
        }

        //POST proses input data pada register
        if (isset($_POST["register"])){
            $username = $_POST["username"];
            $password = $_POST["password"];

            #disini passwordnya akan dihash
            $hash_password = hash("sha256",$password);

            #jikalau apa yg dimasukkan benar dan tidak ada maka..
            try {
                $sql = "INSERT INTO users (username, password) VALUES ('$username','$hash_password')";

                if ($db->query($sql)) {
                    $register_msg ="daftar akun berhasil, silahkan login";
                }else{
                    $register_msg="daftar akun gagal";
                }

                #jika username yg disudah ada maka...
            } catch (mysqli_sql_exception $e) {
                $register_msg = "user sudah ada";
            }
            
            #close database
            $db->close();
        }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cobaaja.com</title>
</head>
<body>
    
    <!--Menampilkan headaer  -->
    <?php include "layout/header.html" ?>
    <h3>DAFTAR AKUN</h3>

    <!-- menampilkan pesan yang diambil dari PHP -->
    <i><?=$register_msg ?></i>

    <form action="register.php" method="POST">            
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <button type="submit" name="register">Daftar Sekarang</button>
    </form>
    
     
    <!--Menampilkan footer  -->
    <?php include "layout/footer.html" ?>
</body>
</html>






