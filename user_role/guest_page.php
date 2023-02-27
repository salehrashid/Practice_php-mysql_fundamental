<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Home | Belajar</title>
<style>
    body {
        background-image: url("https://external-preview.redd.it/eli5-capybara-meme-asalnya-darimana-nih-masbro-v0-BOE938E6M6j3V48LNpZud4MhnB9puDZqeuvv1uRCV_Y.png?width=640&crop=smart&auto=webp&s=bc87f798ad857966994d5dab5e3e18c855a9eb9f");
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
        transform: translate(35em, -50%);
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
<div class="card container position-absolute top-50" style="width: 30em">
    <div class="card-body text-center">
        <h5>Yatta, kamu berhasil masuk sebagai guest masbro</h5>
        <br>
        <h5 class="card-title">your name is <?php echo $_SESSION["name"] ?></h5>
        <h5 class="card-title">your email is <?php echo $_SESSION["email"] ?></h5>
        <a href="../user_role/logout_role.php">
            <button class="btn btn-primary" type="button" id="expanded-button">Logout</button>
        </a>
    </div>
</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</html>
<?php
