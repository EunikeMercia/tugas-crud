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
    if (isset($_POST['edit'])) {
        // global $conn;
    
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];
        $foto = $_FILES['foto']['name'];
       
        // $sql = "INSERT INTO `tabel_data` (nama, telepon) VALUES ('$nama', '$telepon')";
        // $result = mysqli_query($conn, $sql);

        if ($foto != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $foto);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['foto']['tmp_name'];
            $ukuran = $_FILES['foto']['size'];
            $angka_acak = rand(1, 999);
            $nama_foto_baru = $angka_acak . '-' . $foto; //menggabungkan angka acak dengan nama file

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if($ukuran < 1000000){
                    if (is_file("foto/" .$data['foto'])) {
                        unlink("foto/" .$data['foto']);
                    }
                    move_uploaded_file($file_tmp, 'foto/' . $nama_foto_baru);
                    $sql = "UPDATE `tabel_data` SET nama = '$nama', kelas = '$kelas', telepon = '$telepon', alamat = '$alamat', foto = '$nama_foto_baru' WHERE id=$id";
                    $result = mysqli_query($conn, $sql);
    
                    if ($result) {
                        echo "<script>alert('Data berhasil diedit')</script>";
                        header("Location: list_user.php");
                    }
                    else {
                        echo "<script>alert('Terjadi kesalahan. Data gagal untuk diedit')</script>";    
                        header("Location: list_user.php");
                    }
                }
            } else {
                echo "<script>alert('Ekstensi gamabar yang boleh hanya jpg, png dan jpeg')</script>";    
            }
        } else {
            $sql = "UPDATE `tabel_data` SET nama = '$nama', kelas = '$kelas', telepon = '$telepon', alamat = '$alamat' WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Data berhasil diedit')</script>";
                header("Location: list_user.php");
            }
            else {
                echo "<script>alert('Terjadi kesalahan. Data gagal untuk diedit')</script>";    
                header("Location: list_user.php");
            }
        }
        
    
    }
?>
<!DOCTYPE html>
<html>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #484c7f;
            height: 800px;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins';
        }

        .card-form {
            background-color: #ffff;
            width: 500px;
            text-align: center;
            padding: 40px;
            box-sizing: border-box;
            border-radius: 10px;
            margin-top: 150px;
            
        }

        .card-form .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 25px;
        }
        .card-form .input-group input {
            height: 50px;
            width: 100%;
            padding: 10px 20px;
            box-sizing: border-box;
            font-size: 18px;
            border: 3px solid black;
            border-radius: 10px;
        }
        .card-form .input-group input {
            height: 50px;
            width: 100%;
            padding: 10px 20px;
            box-sizing: border-box;
            font-size: 18px;
            border: 3px solid black;
            border-radius: 10px;
        }
        .card-form .btn-exit{
            height: 40px;
            width: 40px;
            position: absolute;
            top: 65px;
            left: 540px;
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
        input[type=file]::file-selector-button {
            margin-right: 20px;
            border: none;
            background: #484c7f;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #484c8f;
            transform: scale(1.1);
        }
    </style>
    <head>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <title>Edit Data</title>
    </head>
    <body>
        <div class="bg-img">
            <div class="card-form">
                <div>
                    <a href="list_user.php"><button name="btn-exit" class="btn-exit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button></a>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <h1>Form Edit</h1>
                    <input name="id" value="<?php echo $data['id']; ?>" hidden>
                    <div class="input-group">
                        <span>Nama</span>
                        <input type="text" name="nama" required value="<?php echo $data['nama']; ?>" required/>
                    </div>
                    <div class="input-group">
                        <span>Kelas</span>
                        <input type="text" name="kelas" required value="<?php echo $data['kelas']; ?>" required/>
                    </div>
                    <div class="input-group">
                        <span>Telepon</span>
                        <input type="text" name="telepon" value="<?php echo $data['telepon']; ?>" required/>
                    </div>
                    <div class="input-group">
                        <span>Alamat</span>
                        <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required/>
                    </div>
                    <span>Foto</span>
                    <div class="input-group">
                        <img src="foto/<?php echo $data['foto']; ?>" style="width: 120px; float:center; margin-bottom: 5px;">
                        <input type="file" name="foto"/>
                    </div>
                    <div class="input-group">
                        <button name="edit" class="btn">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>