<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Home | Belajar</title>
<style>
    body {
        background-image: url("https://cdn1-production-images-kly.akamaized.net/TVjnGDoQlc2JxB_b5NoeNrlMtQg=/640x360/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/4315921/original/090038900_1675743080-cscs.jpg");
    }

    #expanded-button {
        display: block;
        width: 100%;
    }

    .card{
        transform: translate(50%, -50%);
    }
</style>
<body>
<?php
/** untuk menjalankan sesi yang kita panggil **/
session_start();
if (!$_SESSION["name"]){
    echo "<script>alert('login dulu')</script>";
    header("location: login_page.php");
}
?>

<div class="card container w-50 position-absolute top-50">
    <div class="card-body text-center">
        <h5>Yatta kamu berhasil masuk masbro</h5>
        <br>
        <h5 class="card-title">your name is <?php echo $_SESSION["name"] ?></h5>
        <h5 class="card-title">your username is <?php echo $_SESSION["username"] ?></h5>
        <h5 class="card-title">your email is <?php echo $_SESSION["email"] ?></h5>
        <a href="logout_page.php"><button class="btn btn-primary" type="button" id="expanded-button">Logout</button></a>
    </div>
</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</html>
<?php
