<?php
/** membuat sebuah fungsi delete data **/
require_once("../user_role/connection.php");

/** memanggil parameter id yang akan dihapur **/
$id = $_GET['id'];

/** membuat query untuk menghapus data berdasarkan parameter id **/
$result = mysqli_query($connectMySql, "DELETE FROM siswa WHERE id=$id");

/** membuat query menjadi array **/
$delete = mysqli_fetch_array($result);

/** jikalau ada fotonya maka akan dihapus bersama foto yang ada didirectorynya **/
if (is_file("../user_role/" . $delete['foto'])) {
    /** fungsi hapus file difolder **/
    unlink("../user_role/" . $delete['foto']);
    /** membuat query untuk menghapus data didatabase **/
    mysqli_query($connectMySql, "DELETE FROM siswa WHERE id='$id'");
    echo "<script>alert('Successfully delete data')</script>";
    header("location: ../user_role/admin_page.php");
} else {

    /** jikalau fotonya tidak ada **/
    $deleteWithoutFolder = mysqli_query($connectMySql, "DELETE FROM siswa WHERE id='$id'");
    if ($deleteWithoutFolder) {
        echo "<script>alert('Successfully delete data')</script>";
        header("location: ../user_role/admin_page.php");
    } else {
        echo "<script>alert('Failed delete data')</script>";
    }
}

