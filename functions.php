<?php 
include 'config.php';


// if (isset($_SESSION['username'])) {
    //     header("Location: list.php");
    // }

function login(){
    global $conn;
    
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            header("Location: list.php");
        } else {
            echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
        }
    }
}

function registrasi(){
    if (isset($_POST['submit'])) {
        global $conn;
    
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cekpassword = $_POST['cekpassword'];
    
        if ($password == $cekpassword) {
            $sql =  "SELECT * FROM user WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if (!$result->num_rows > 0){
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user` (username, password) VALUES ('$username', '$password')";
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                    $username = "";
                    $password = "";
                    $_POST['password'] = "";
                    $_POST['cekpassword'] = "";
                }
                else {
                    echo "<script>alert('Terjadi kesalahan.')</script>";    
                }
            } else {
                echo "<script>alert('Username sudah terdaftar')</script>";
            }
        } else {
            echo "<script>alert('Password tidak sesuai')</script>";
        }
    
    }
}

?>