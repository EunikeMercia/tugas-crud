<?php
    include 'config.php';
    
    error_reporting(0);

    session_start();

    if(isset($_SESSION['username'])){
        header("Location: list_user.php");
    }

    if (isset($_POST['submit'])) {
        // global $conn;
    
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

?>
<!DOCTYPE html>
<html>
    <style>
        *{
            font-family: 'Poppins';
        }
        body {
            margin: 0;
            padding: 0;
            display: flex;
            background: url("images/bg_space.jpg") no-repeat;
            background-size: cover;
            background-position: center;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins';
        }

        .card-registrasi {
            position: relative;
            width: 450px;
            background: #fff6;
            border: 2px solid #fff5;
            text-align: center;
            padding: 40px;
            box-sizing: border-box;
            border-radius: 10px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px black #0005;
            margin-top: 50px;
        }

        .card-registrasi .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 25px;
        }
        .card-registrasi .input-group input {
            height: 50px;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 18px;
            border: 2px solid #0C134F;
            border-radius: 25px;
            background-color: #fff7;
            transition: all .2s ease-in-out;
            
            
        }
        .card-registrasi .input-group input:hover{
            transform: scale(1.1);
            height: 50px;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 18px;
            border: 3px solid #0C134F;
            border-radius: 25px;
            
        }
        .card-registrasi .input-group .btn {
            height: 50px;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 25px;
            border: 3px solid black;
            border-radius: 10px;
            background-color: #13005A;
            color: white;
            font-family: 'Poppins';
             transition: all .2s ease-in-out;
        }
        .card-registrasi .input-group .btn:hover {
            transform: scale(1.1);
            height: 50px;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 25px;
            border: 3px solid black;
            border-radius: 10px;
            background-color: #060047;
            color: white;
            font-family: 'Poppins';
        }
        a{
            text-decoration: none;
        }
        .label {
            color: #060047;
        }
    </style>
    <head>
        <title>Halaman REGISTRASI</title>
    </head>
    <body>
        <form action="" method="POST">
            <div class="card-registrasi">
                <h1 class="label">REGISTRASI</h1>
                <div class="input-group">
                    <span class="label">Username</span>
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-group">
                    <span class="label">Password</span>
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="input-group">
                    <span class="label">Konfirmasi Password</span>
                    <input type="password" placeholder="Password" name="cekpassword" required>
                </div>
                <div class="input-group">
                    <button name="submit" class="btn" name="register">Konfirmasi</button>
                </div>
                <div class="input-group">
                    <span>Sudah punya akun?</span> <a href="login.php">Login</a>
                </div>
            </div>
        </form>

    </body>
</html>