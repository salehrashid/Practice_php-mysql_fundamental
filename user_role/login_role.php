<!DOCTYPE html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Login Role | Belajar</title>
</html>
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
<div class="align-items-center content">
    <div class="container align-content-center my-5">
        <div id="connection" class="rounded d-flex justify-content-center">
            <?php require_once "../user_role/connection.php" ?>
        </div>
        <h2 id="login-header">Login</h2>
        <?php
        /** Menambahkan error list **/
        error_reporting(0);
        /** membuat sebuah sesi start **/
        session_start();
        /** membuat sebuah validasi mencocokan username password didatabase **/
        if (isset($_POST["submit"])) {
            $email = $_POST["email"];
            $password = md5($_POST["password"]);

            $query = "SELECT * FROM access WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($connectMySql, $query);
            if ($result->num_rows > 0) {
                $line = mysqli_fetch_assoc($result);
                $_SESSION["name"] = $line["name"];
                $_SESSION["email"] = $line["email"];
                if ($line["role"] == "admin") {
                    /** akan redirect ke halaman administrator **/
                    header("location: ../user_role/admin_page.php");
                } elseif ($line["role"] == "guest") {

                    /** akan redirect ke halaman guest **/
                    header("location: ../user_role/guest_page.php");
                } else {
                    echo "<script>alert('Hak akses kamu apa?')</script>";
                }
            } else {
                echo "<div class='rounded test mx-5 bg-danger'>
                         <p class='text-view'>Wrong username or password</p>
                      </div>";
            }
        }
        ?>

        <form method="post" class="mx-5">
            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="enter your email">
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

    type = "text/javascript";
    window.history.forward()

    function noBack() {
        window.history.forward()
    }
</script>
</body>