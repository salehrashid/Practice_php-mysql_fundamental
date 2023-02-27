<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Home | Belajar</title>
<style>
    body {
        background-image: url("https://cdn.idntimes.com/content-images/post/20230212/9-2f3a91dcad416b6bf5d4b59f8214efbd.jpeg");
    }

    #expanded-button {
        display: block;
        width: 100%;
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

    .card {
        transform: translate(50%, -50%);
    }

    a {
        text-decoration: none;
    }

    table, th, td {
        text-align: center;
        border: 3px solid black;
    }
</style>
<body>
<?php
/** untuk menjalankan sesi yang kita panggil **/
session_start();
if (!$_SESSION["name"]) {
    echo "<script>alert('login dulu')</script>";
    header("location: ../user_role/login_role.php");
}

?>
<div id="connection" class="rounded d-flex justify-content-center">
    <?php require_once "../user_role/connection.php" ?>
</div>
<div class="card container position-absolute top-50" style="width: 50em">
    <div class="card-body text-center">
        <h5>Yatta, kamu berhasil masuk sebagai admin masbro</h5>
        <br>
        <h5 class="card-title">your name is <?php echo $_SESSION["name"] ?></h5>
        <h5 class="card-title mb-4">your email is <?php echo $_SESSION["email"] ?></h5>

        <a href="../user_role/logout_role.php">
            <button class="btn btn-primary mb-4" type="button" id="expanded-button">Logout</button>
        </a>

        <!-- buat fungsi ke halaman tambah data -->
        <a href="../user_role/add_admin.php">
            <button class="btn btn-info mb-4" type="button" id="expanded-button">Tambah Data</button>
        </a>

        <!-- buat form pencarian data -->
        <form method="get">
            <!-- form input untuk mengisi data yang akan dicari -->
            <div class="row">
                <div class="col-md-10">
                    <input class="form-control" type="text" name="search" placeholder="search..."
                           value="<?php if (isset($_GET['search'])) {
                               echo $_GET['search'];
                           } ?>">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <!-- buat table untuk menambah data -->
        <table width="100%" border="2">
            <tr>
                <th>Nik</th>
                <th>Nama</th>
                <th>Foto</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Alamat</th>
                <th>Opsi</th>
            </tr>
            <!-- buat fungsi read data -->
            <?php
            /** ketika mengklik search **/
            if (isset($_GET["search"])) {

                /** variabel ini buat patokan kita mencari sebuah kata **/
                $searchWord = $_GET['search'];

                /**  **/
                $query = "SELECT * FROM siswa WHERE nama LIKE '%" . $searchWord . "%' ORDER BY id ASC";
            } else {
                $query = "SELECT * FROM siswa ORDER BY id ASC";
            }
            $results = mysqli_query($connectMySql, $query);

            /** looping hasil query dari $result
             * pada line 96 tanda tanya merupakan patokan pencarian
             */
            if ($results->num_rows > 0) {
                foreach ($results as $result) {
                    if ($result['foto'] == null) {
                        echo "<tr>
                        <td>" . $result['nik'] . "</td>
                        <td>" . $result['nama'] . "</td>
                        <td>gak upload doang</td>
                        <td>" . $result['kelas'] . "</td>
                        <td>" . $result['jurusan'] . "</td>
                        <td>" . $result['alamat'] . "</td>
                        <td>
                            <a href='edit_admin.php?id=" . $result['id'] . "'>
                               <button class='btn btn-info'>Edit</button>
                            </a>
                            <a href='delete_admin.php?id=" . $result['id'] . "'>
                               <button class='btn btn-danger'>Delete</button>
                            </a>
                       </td>
                      </tr>";
                    } else {
                        echo "<tr>
                        <td>" . $result['nik'] . "</td>
                        <td>" . $result['nama'] . "</td>
                        <td><img src='../user_role/" . $result['foto'] . "' width='35' height='40'></td>
                        <td>" . $result['kelas'] . "</td>
                        <td>" . $result['jurusan'] . "</td>
                        <td>" . $result['alamat'] . "</td>
                        <td>
                            <a href='edit_admin.php?id=" . $result['id'] . "'>
                               <button class='btn btn-info'>Edit</button>
                            </a>
                            <a href='delete_admin.php?id=" . $result['id'] . "'>
                               <button class='btn btn-danger'>Delete</button>
                            </a>
                       </td>
                      </tr>";
                    }
                }
            } else {
                echo "<tr>
                         <td colspan='6'>Data masih kosong</td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</div>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</html>
<?php
