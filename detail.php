<?php 
    include 'config.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }
    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        
        $sql = "SELECT * FROM `tabel_data` WHERE id=$id";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $data = mysqli_fetch_assoc($query);

            if (!count($data)) {
                echo "<script>alert('Masukan data id.')</script>";    
                header("Location: list_user.php");
            }
  
        }
        else {
            echo "<script>alert('Masukan data id.')</script>";    
            header("Location: list_user.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <style>
        body {
            margin: 0;
            padding: 50px;
            display: flex;
            background-color: #484c7f;
            height: 600px;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins';
        }

        .card-form {
            background-color: #ffff;
            width: 800px;
            text-align: center;
            padding: 40px;
            box-sizing: border-box;
            border-radius: 10px;
            
        }
        .grid-container {
            display: grid;
            grid-template-columns: auto auto;
            padding: 10px;
        }
        .grid-item {
            padding: 20px;
            text-align: center;
        }

        .card-form .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 25px;
            text-align: left;
        }
        .card-form .input-group input {
            height: 50px;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 18px;
            border: 3px solid black;
            border-radius: 10px;
            color: black;
            
        }
        .card-form .btn-exit{
            height: 40px;
            width: 40px;
            position: absolute;
            top: 60px;
            left: 375px;
            box-sizing: border-box;
            font-size: 15px;
            border: 3px solid black;
            border-radius: 10px;
            background-color: #484c7f;
            color: white;
        }
        .card-form .input-group .btn {
            height: 50px;
            width: 100%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 25px;
            border: 3px solid black;
            border-radius: 10px;
            background-color: #484c7f;
            color: white;
            font-family: 'Poppins';
        }
    </style>
    <head>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>Detail Data</title>
    </head>
    <body>
        <div class="card-form">
            <a href="list_user.php"><button name="btn-exit" class="btn-exit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button></a>
            <form action="" method="POST" enctype="multipart/form-data">
                <h1>Detail Data</h1>
                <input name="id" value="<?php echo $data['id']; ?>" hidden>
                <div class="grid-container">
                    <div class="grid-item">
                        <div class="input-group image">    
                            <img src="foto/<?php echo $data['foto']; ?>" style="width: 150px; float:left; margin-bottom: 5px;">
                        </div>
                    </div>
                    <div class="grid-item">
                        <div class="input-group">
                            <span>Nama:</span>
                            <input type="text" name="nama" required value="<?php echo $data['nama']; ?>" disabled/>
                        </div>
                        <div class="input-group">
                            <span>Kelas:</span>
                            <input type="text" name="kelas" required value="<?php echo $data['kelas']; ?>" disabled/>
                        </div>
                        <div class="input-group">
                            <span>Telepon:</span>
                            <input type="text" name="telepon" value="<?php echo $data['telepon']; ?>" required disabled/>
                        </div>
                        <div class="input-group">
                            <span>Alamat:</span>
                            <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required disabled/>
                        </div>
                    </div> 
                </div>
            </form>
        </div>
    </body>
</html>