<?php 
    include 'config.php';
    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        
        $sql = "DELETE FROM `tabel_data` WHERE id=$id";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            header("Location: list_user.php");
            echo "<script>alert('Data berhasil dihapus')</script>";
        }
        else {
            header("Location: list_user.php");
            echo "<script>alert('Terjadi kesalahan. Data gagal untuk dihapus')</script>";    
        }
    }
?>