<?php   
    //Nyambungkan Ke Database
    include "service/database.php";

    #session dimulai
    session_start();
    
    #inisiasi pesan awal masuk
    $login_msg="";

    //membuat validasi supaya tidak bisa keluar dari sesei Dashboard
    if (isset($_SESSION["is_login"])){
        header("location:dashboard.php");
    }

    #memvalidasi ketika user login
    if (isset($_POST['login'])) {
        $username =$_POST['username'];
        $password=$_POST['password'];
        $hash_password = hash("sha256",$password);
    
        #perintah Buat Mencari user dan password
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";
        $result =$db->query($sql);

        #jika data yg dimasukkan ada dan jumlah barisnya lebih dari nol
        if($result->num_rows>0){ 
            // echo "datanya Ada";
            #fetch_assoc(); -> buat ngambil nampilin nanti yg diambil dari database
            $data = $result->fetch_assoc();
           
            #buat session untuk bisa ditampilkan seperti di dashboard
            $_SESSION["username"] = $data["username"];
            
            #akan digunakan untuk validasi session login or logout
            $_SESSION["is_login"] = true;

            #melempar setelah login ke halaman dashboard
            header("location: dashboard.php");

        }else{
           $login_msg="akun tidak ditemukan";
        }

        #close semua db setelah digunakan
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
    <h3>MASUK AKUN</h3>
    
    <!-- menampilkan pesan yang diambil dari PHP -->
    <i><?=$login_msg ?></i>
    <form action="login.php" method="POST">            
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <button type="submit" name="login">Masuk Sekarang</button>
    </form>
    
    <!--Menampilkan footer  -->
    <?php include "layout/footer.html" ?>
</body>
</html>






