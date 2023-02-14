<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login | Belajar</title>
</head>
<style>
    #login-header {
        text-align: center;
        color: white;
        margin-bottom: 30px;
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
<!--
    method post untuk mengirim data
-->
<div class="align-items-center content">
    <div class="container align-content-center my-5">
        <div id="connection" class="rounded d-flex justify-content-center">
            <?php require_once "koneksi.php" ?>
        </div>
        <h2 id="login-header">Login</h2>
        <?php

        /**
         * jika tombol submit diklik
         */
        if (isset($_POST["submit"])) {
            $username = strip_tags($_POST["username"]);
            $password = strip_tags($_POST["password"]);
        }

        /**
         * validasi data
         * jika data tidak ada maka kamu akan mengisinya
         */
        if (empty($username) || empty($password)) {
            echo "<div class='rounded test mx-5 bg-info'>
                    <p class='text-view'>Fill your own data</p>
                  </div>";

            /**
             * yang lain jika user memasukkan username yang selain dimasukkan sebelumnya misalnya:
             * yang pertama salvaz dan yang dimasukin adalah salva maka yang
             * akan muncul adalah tulisan berikut:
             */
        } elseif (count((array)$connect->query('SELECT username FROM users WHERE username = "' . $username . '"')->fetch_array()) == 0) {
            echo "<div class='rounded test mx-5 bg-warning'>
                    <p class='text-view'>Username or password not registered</p>
                  </div>";
        } else {

            /**
             * fungsi assoc = konversi dari bahasa query ke format bahasa pemrograman
             */
            $user = $connect->query("SELECT username, password FROM users")->fetch_assoc();

            /**
             * pencocokan password dan username ketikan dengan yang ada di database, jika benar maka
             * akan pindah ke halaman home, dan jika salah maka akan masuk ke block else nya
             */
            if (password_verify($password, $user['password'])) {
                $_SESSION['is_login'] = true;
                $_SESSION['nama'] = $user['nama'];
                header("location: home_page.php");

                /**
                 * jika user salah memasukkan username atau password yang salah satunya salah
                 **/
            } else {
                echo "<div class='rounded test mx-5 bg-danger'>
                        <p class='text-view'>Wrong username or password</p>
                      </div>";
            }
        }
        ?>
        <form method="post" class="mx-5">
            <div class="mb-2">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="enter your email">
            </div>
            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="hide" placeholder="enter your password">
            </div>
            <div class="mb-3 form-check">
                <label class="form-check-label">Show password</label>
                <input type="checkbox" class="form-check-input" onclick="togglePasswd2()">
            </div>
            <button type="submit" class="btn btn-primary" name="submit" id="expanded-button">Login</button>
        </form>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<!--
    toggle password visibility
-->
<script>
    function togglePasswd2() {
        let pass = document.getElementById("hide");
        if (pass.type === "password") {
            pass.type = "text"
        } else {
            pass.type = "password"
        }
    }
</script>
</html>
