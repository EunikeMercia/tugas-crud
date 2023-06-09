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
        
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            // $_SESSION['username'] = $row['username'];
            // header("Location: list.php");

            if( password_verify($password, $row['password']) ) {
				$_SESSION['submit'] = true;
				$_SESSION["username"] = $username;
				// arah url
				echo "<script>
					alert('Berhasil Login');
					document.location.href='list_user.php';
					</script>";
				// exit;
			}
        } else {
            echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
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

        .card-login {
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

        .card-login .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 25px;
        }
        .card-login .input-group input {
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
        .card-login .input-group input:hover{
            transform: scale(1.1);
            height: 50px;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 18px;
            border: 3px solid #0C134F;
            border-radius: 25px;
            
        }
        .card-login .input-group .btn {
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
        .card-login .input-group .btn:hover{
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
        <title>Halaman LOGIN</title>
    </head>
    <body>
        <div class="bg-img">
            <form action="" method="POST">
                <div class="card-login">
                    <h1 class="label">LOGIN</h1>
                    <div class="input-group">
                        <span class="label">Username</span>
                        <input type="text" placeholder="Username" name="username">
                    </div>
                    <div class="input-group">
                        <span class="label">Password</span>
                        <input type="password" placeholder="Password" name="password">
                    </div>
                    <div class="input-group">
                        <button name="submit" class="btn">Login</button>
                    </div>
                    <div class="input-group">
                        <span>Belum punya akun?</span> <a href="register.php">Registrasi</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>