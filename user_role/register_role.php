<!DOCTYPE html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Register Role | Belajar</title>
</html>
<style>
    #register-header {
        text-align: center;
        color: white;
        margin-bottom: 30px;
    }

    #expanded-button {
        display: block;
        width: 100%;
    }

    #emailHelp {
        color: white;
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

    .text-view {
        text-align: center;
        font-size: 24px;
        color: white;
    }

    .content {
        margin-top: 7em;
    }

    body {
        background-image: url("https://sp-ao.shortpixel.ai/client/q_lossy,ret_img,w_747,h_420/https://academy.alterra.id/blog/wp-content/uploads/2022/07/Untitled-design-4.jpg");
        background-repeat: no-repeat;
    }

    label {
        color: white;
    }

    @media screen and (max-width: 525px) {
        #connection {
            display: none;
        !important;
        }
    }
</style>
<body>
<div class="align-items-center content">
    <div class="container align-content-center my-5">
        <div id="connection" class="rounded d-flex justify-content-center">
            <?php require_once "../user_role/connection.php" ?>
        </div>
        <h2 id="register-header">Register</h2>
        <?php

        /**
         * untuk mengirim / mengisi data yang ada ditable database "sekolah" setelah
         * menekan tombol submit
         **/
        if (isset($_POST['submit'])) {
            $name = strip_tags($_POST['name']);
            $role = strip_tags($_POST['role']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);
            $address = strip_tags($_POST['address']);

            /**
             * membuat sebuah validasi jika salah satu dari mereka kosong maka akan
             * keluar pesan ini:
             */
            if (empty($name) || empty($email) || empty($password) || empty($address)) {
                echo "<div class='rounded test mx-5 bg-warning'>
                        <p class='text-view'>Data must be filled!</p>
                      </div>";

                /**
                 * Lain jika saat kita memasukkan data yang sama seperti yang kita
                 * isi sebelumnya maka yang akan keluar adalah text ini:
                 **/
            } elseif (count((array)$connectMySql->query('SELECT email FROM access WHERE email = "' . $email . '"')->fetch_array()) > 1) {
                echo '<div class=\' rounded test mx-5 bg-info \'>
                        <p class=\'text-view\'>Data was exist!</p>
                      </div>';

                /**
                 * input data ke database.
                 * selain itu data sudah dimasukkan ke dalam database maka setelah
                 * itu kita akan pindah ke halaman berikutnya.
                 **/
            } else {

                /**
                 * Hash adalah proses enkripsi password. Misalnya, password 12345
                 * kalau di hash maka akan menjadi $2y$10$iY30uBx4OOt.
                 */
                $passwdHash = md5($password);
                $input = $connectMySql->query("INSERT INTO access(name, role, email, password, address) VALUES ('$name', '$role', '$email', '$passwdHash', '$address')");
                header("location: ../user_role/login_role.php");
                if ($input) {
                    echo 'success';
                } else {
                    echo 'failure';
                }
            }
        }
        ?>

        <form method="post" id="register-form" class="mx-5">
            <div class="mb-3">
                <label class="form-label">Complete name</label>
                <input type="text" class="form-control" name="name" autocomplete="off"
                       placeholder="Input your full name">
            </div>
            <select name="role" class="form-control">
                <option selected disabled>-- Select Role --</option>
                <option value="admin">Admin</option>
                <option value="guest">Guest</option>
            </select>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Input your email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" name="address" rows="5" placeholder="Isi alamat..."></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" autocomplete="off" id="hide"
                       placeholder="Input your password">
            </div>
            <div class="mb-3 form-check">
                <label class="form-check-label">Show password</label>
                <input type="checkbox" class="form-check-input" onclick="togglePasswd()">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" id="expanded-button">Register</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<!--
 toggle password visibility
-->
<script>
    function togglePasswd() {
        let pass = document.getElementById("hide");
        if (pass.type === "password") {
            pass.type = "text"
        } else {
            pass.type = "password"
        }
    }
</script>
</body>