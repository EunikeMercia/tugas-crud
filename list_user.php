<?php 
    require_once "config.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }

?>
<!DOCTYPE html>
<html>
    <style type="text/css">
        * {
            font-family: "Poppins";
        }
        body {
            /* background-image: linear-gradient(to bottom right, #9E4784, #D27685); */
            background-color: #917FB3;
            background-size: cover;
            background-position: center;
            width: 100%;
            max-height: 100vh;
            justify-content: center;
            align-items: center;
        }
        h1 {
            text-transform: uppercase;
            color: whitesmoke;
            text-align: center;
        }
        .btn-tambah {
            margin: 10px 10px 10px auto;
        }
        .btn-tambah .btn {
            height: 40px;
            width: 15%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 20px;
            border: 3px solid black;
            border-radius: 10px;
            background-color: #484c7f;
            color: white;
            font-family: 'Poppins';
        }
        .btn-logout .btn {
            height: 50px;
            width: 20%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 25px;
            border: 3px solid black;
            border-radius: 10px;
            background-color: #484c7f;
            color: white;
            font-family: 'Poppins';
        }
        .btn-tambah .btn:hover {
            height: 40px;
            width: 15%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 20px;
            border: 3px solid black;
            border-radius: 10px;
            background-color: #2A2F4F;
            color: white;
            font-family: 'Poppins';
        }
        .btn-logout .btn:hover {
            height: 50px;
            width: 20%;
            padding: 0 20px;
            box-sizing: border-box;
            font-size: 25px;
            border: 3px solid black;
            border-radius: 10px;
            background-color: #2A2F4F;
            color: white;
            font-family: 'Poppins';
        }
        .foto {
            padding: 30px;
            width: 120px;
        }
        /* th{
            padding: 30px;
            font-size: 50px;
        }
        td{
            padding: 30px;
            font-size: 30px;

        } */
        a{
            padding: 10px;
            text-decoration: none;
        }
        .container {
            background-color: #ffff;
            width: 900px;
            min-height: 100px;
            padding: 20px 15px;
            box-sizing: border-box;
            border-radius: 10px;
            margin: 0 auto;
            
        }
        .btn-logout{
            position: absolute;
            bottom: 20px;
            right: 20px;
        
        } 
        table {
            border: 1px solid black;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            margin: 10px auto 10px auto;
            background-color: white;
        }
        table thead th {
            background-color: #484c7f;
            border: 1px solid black;
            color: white;
            text-align: center;
            padding: 10px;
        }
        table tbody td {
            border: 1px solid black;
            text-align: center;
            color: black;
            padding: 10px;
        }
    </style>
    <head>
        <title>Tabel Data</title>
    </head>
    <body>
        <header>
            <h1>TABEL DATA</h3>
        </header>
        <div class="container">
            <div class="btn-tambah">
                <a href="form.php"><button name="tambah" class="btn">Tambah</button></a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor = 1;
                        $sql = "SELECT * FROM tabel_data";
                        if($result = mysqli_query($conn, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $nomor++; ?></td>
                                        <td><?php echo $row['nama'] ?></td>
                                        <td><?php echo $row['kelas'] ?></td>
                                        <td><img src='foto/<?php echo $row['foto'] ?>' class='foto'></img></td>
                                        <td>
                                        <a href='form_edit.php?id="<?php echo $row['id'] ?>"'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                                        <a href='detail.php?id="<?php echo $row['id'] ?>"'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                        <a href='hapus.php?id="<?php echo $row['id'] ?>"' onclick="return confirm('apakah anda ingin menghaspus data <?php $row['nama'] ?>?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#CD0404" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                                        </td>
                                    </tr>
                                <?php 
                                    $nomor++;
                                  } 
                                ?>    
                                <?php } else {        ?>    
                                    <tr>
                                        <td colspan="5">Tidak ada data</td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="btn-logout">
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </body>
</html>