<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Tambah Data | Belajar</title>
<style>
    body {
        background-image: url("https://cdn.idntimes.com/content-images/duniaku/post/20230206/fobyhuzayaaqpmh-2c54de9ea7f53720cc2d435913d8149b.jpg");
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

    #addData-header {
        text-align: center;
        margin-top: 3em;
        color: white;
        margin-bottom: 30px;
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

    .container {
        margin-bottom: 50px;
    }
</style>
<body>
<!-- buat fungsi ke halaman data admin -->
<a href="../user_role/admin_page.php" class="previous round">&#8249;&#8249;</a>

<div class="container mt-5">
    <div id="connection" class="rounded d-flex justify-content-center">
        <?php require_once "../user_role/connection.php" ?>
    </div>
    <h2 id="addData-header">Add your data</h2>

    <!-- multipart/form-data = untuk mengupload gambar, pdf dll -->
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nik</label>
            <input type="number" class="form-control" placeholder="Your nik" name="nik">
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" placeholder="Enter name" name="nama">
        </div>
        <div class="form-group">
            <label>Foto</label>
            <input type="file" class="form-control" placeholder="Add picture" name="foto">
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <input type="text" class="form-control" placeholder="Enter class" name="kelas">
        </div>
        <div class="form-group">
            <label>Jurusan</label>
            <select name="jurusan" class="form-control">
                <option selected disabled>-- Pilih Jurusan --</option>
                <!-- value yang nantinya akan masuk ke database -->
                <option value="RPL">RPL</option>
                <option value="TKJ">TKJ</option>
                <option value="DMM">DMM</option>
            </select>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-4" name="submit">Submit</button>
    </form>
</div>
<?php

/**
 * untuk mengirim / mengisi data yang ada ditable database "sekolah" setelah
 * menekan tombol submit
 **/
if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];


    /** untuk membuat sebuah nilai random
     * jika ada foto dengan nama, format, tanggal yang sama tapi beda foto maka foto
     * yang sebelumnya tidak akan direplace dengan yang baru.
     **/
    $random = rand();

    /** untuk menampung extension / format yang boleh diupload **/
    $extension = ["png", "jpg", "jpeg", "svg"];

    /** menampung req file **/
    $fileName = $_FILES['foto']['name'];

    /** menampung req ukuran file **/
    $size = $_FILES['foto']['size'];

    /** mengambil format extesion file **/
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);

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

        /** jika ukuran foto kurang dari 10mb maka akan dimasukkan kedatabase **/
        if ($size < 1044070) {
            $xx = $random . '_' . $fileName;

            /** untuk memasukkan foto ke folder image **/
            move_uploaded_file($_FILES['foto']['tmp_name'], '../user_role/' . $random . '_' . $fileName);

            /** untuk memasukkan foto ke database **/
            $connectMySql->query("INSERT INTO siswa(nik, nama, foto, kelas, jurusan, alamat) VALUES ('$nik', '$nama', '$xx', '$kelas', '$jurusan', '$alamat')");
            echo "<script>alert('Successfully add data')</script>";
            header("location: ../user_role/admin_page.php");
        } else {
            echo '<div id="failure" class="rounded-lg d-flex justify-content-center ">
                    <p>Failed to upload photo</p>
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
