<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Edit Data | Belajar</title>
<style>
    body {
        background-image: url("https://coconuts.co/wp-content/uploads/2023/02/Masbro-memes.jpg");
    }

    #connection {
        position: absolute;
        top: 10px;
        left: 50%;
        width: 25%;
        margin-top: 50px;
        padding: 7px;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
        background-color: dodgerblue;
        font-size: 24px;
    }

    #editData-header {
        text-align: center;
        margin-top: 3em;
        color: white;
        margin-bottom: 30px;
    }

    #failure{
        position: absolute;
        bottom: -20px;
        left: 50%;
        width: 20%;
        height: 50px;
        padding: 7px;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
        background-color: crimson;
        font-size: 24px;
    }

    .previous {
        display: block;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        background-color: black;
        color: white;
        font-size: 40px;
        margin-left: 40px;
        text-align: center;
    }

    a {
        text-decoration: none;
    }

    table, th, td {
        text-align: center;
        border: 3px solid black;
    }

    label{
        color: white;
    }

    .container {
        margin-bottom: 50px;
    }
</style>
<body>
<!-- buat fungsi ke halaman data admin -->
<a href="../user_role/admin_page.php" class="previous round">&#8249;&#8249;</a>


<div id="connection" class="rounded d-flex justify-content-center">
    <?php require_once "../user_role/connection.php" ?>
</div>

<!-- fungsi edit data -->
<?php
/** jikalau tombol update diklik **/
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    /** membuat query untuk update data **/
    $result = mysqli_query($connectMySql, "UPDATE siswa SET nik='$nik', nama='$nama', kelas='$kelas', jurusan='$jurusan', alamat='$alamat' WHERE id='$id'");

    if ($result) {
        echo "<script>alert('Successfully edit data')</script>";
        header("location: ../user_role/admin_page.php");
    } else {
        echo "<script>alert('Failed edit data')</script>";
    }
}

/** untuk memanggil parameter id yang akan diedit **/
$id = $_GET['id'];

/** membuat query untuk mengedit data berdasarkan parameter id.
 * dalam fungsi mysqli_query memiliki 2 paramater yaitu koneksi dari database dan query nya
 **/
$result = mysqli_query($connectMySql, "SELECT * FROM siswa WHERE id=$id");

/** membuat loopingan object berdasarkan paramater id **/
while ($edit = mysqli_fetch_assoc($result)) {
    $nik = $edit['nik'];
    $nama = $edit['nama'];
    $kelas = $edit['kelas'];
    $jurusan = $edit['jurusan'];
    $alamat = $edit['alamat'];
}
?>

<div class="container">
    <h2 id="editData-header">Add your data</h2>
    <form method="post">
        <div class="form-group">
            <label>Nik</label>
            <input type="number" class="form-control" placeholder="Your nik" name="nik" value="<?php echo $nik ?>">
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" placeholder="Enter name" name="nama" value="<?php echo $nama ?>">
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <input type="text" class="form-control" placeholder="Enter class" name="kelas" value="<?php echo $kelas ?>">
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <select name="jurusan" class="form-control">
                <option selected disabled>-- Pilih Jurusan --</option>
                value yang nantinya akan masuk ke database
                <option <?php if ($jurusan == "RPL") {
                    echo "selected";
                } ?> value="RPL">RPL
                </option>
                <option <?php if ($jurusan == "TKJ") {
                    echo "selected";
                } ?> value="TKJ">TKJ
                </option>
                <option <?php if ($jurusan == "DMM") {
                    echo "selected";
                } ?> value="DMM">DMM
                </option>
            </select>
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="alamat"><?php echo $alamat ?></textarea>
        </div>
        <tr>
            <td><input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"></td>
            <td>
                <button class="btn btn-primary mt-5" type="submit" name="update">Update</button>
            </td>
        </tr>
    </form>
</div>
<?php

/**
 * untuk mengirim / mengisi data yang ada ditable database "sekolah" setelah
 * menekan tombol submit
 **/
if (isset($_POST['submit'])) {
    $nik = strip_tags($_POST['nik']);
    $nama = strip_tags($_POST['nama']);
    $kelas = strip_tags($_POST['kelas']);
    $jurusan = strip_tags($_POST['jurusan']);
    $alamat = strip_tags($_POST['alamat']);

    /**
     * membuat sebuah validasi jika salah satu dari mereka kosong maka akan
     * keluar pesan ini:
     */
    if (empty($nik) || empty($nama) || empty($jurusan) || empty($alamat) || empty($kelas)) {
        echo "<div class='rounded test mx-5 bg-warning'>
                 <p class='text-view'>Data must be filled!</p>
              </div>";

        /**
         * Lain jika saat kita memasukkan data yang sama seperti yang kita
         * isi sebelumnya maka yang akan keluar adalah text ini:
         **/
    } elseif (count((array)$connectMySql->query('SELECT nik FROM siswa WHERE nik = "' . $nik . '"')->fetch_array()) > 1) {
        echo '<div class=\' rounded test mx-5 bg-info \'>
                 <p class=\'text-view\'>Data was exist!</p>
              </div>';

        /**
         * input data ke database.
         * selain itu data sudah dimasukkan ke dalam database maka setelah
         * itu kita akan pindah ke halaman berikutnya.
         **/
    } else {
        $input = $connectMySql->query("INSERT INTO siswa(nik, nama, kelas, jurusan, alamat) VALUES ('$nik', '$nama', '$kelas', '$jurusan', '$alamat')");
        if ($input) {
            echo "<script>alert('Successfully update data')</script>";
            header("location: ../user_role/admin_page.php");
        } else {
            echo '<div id="failure" class="rounded-lg d-flex justify-content-center ">
                    <p>Failed to update data</p>
                  </div>';
        }
    }
}
?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</html>
