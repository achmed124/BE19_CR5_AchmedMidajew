<?php
session_start();

require_once "db_connect.php";
require_once "file_upload.php";

$Id = $_SESSION["user"];
$userSql = "SELECT * FROM user WHERE id = $Id";
$userResult = mysqli_query($connect, $userSql);
$userRow = mysqli_fetch_assoc($userResult);

$backBtn = "home.php";

$fname = $lname = $pass = $phone = $email = $address = "";


if (isset($_SESSION["adm"])) {
    $backBtn = "dashboard.php";
}

if (isset($_POST["update"])) {
    $fname = $_POST["first_name"];
    $lname = $_POST["last_name"];
    $pass = $_POST["password"];
    $phone = $_POST["phone_number"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $date_of_birth = $_POST["date_of_birth"];
    $picture = fileUpload($_FILES["picture"]);

    if ($_FILES["picture"]["error"] == 0) {
        if ($userRow["picture"] != "avatar.png") {
            unlink("pictures/$userRow[picture]");
        }

        $userSql="UPDATE `user` SET `first_name`='$fname',`last_name`='$lname',`password`='$pass',`phone_number`='$phone',`address`='$address',`date_of_birth`='$date_of_birth',`email`='$email',`picture`=  '$picture[0]' WHERE id = {$Id}";  
     } else {
        $userSql="UPDATE `user` SET `first_name`='$fname',`last_name`='$lname',`password`='$pass',`phone_number`='$phone',`address`='$address',`date_of_birth`='$date_of_birth',`email`='$email' WHERE id = {$Id}"; 
    }

    if (mysqli_query($connect, $userSql)) {
        echo "<div class='alert alert-success' role='alert'>
       user has been updated, {$picture[1]}
     </div>";
        header("refresh: 3; url=$backBtn");
    } else {
        echo "<div class='alert alert-danger' role='alert'>
       error found, {$picture[1]}
     </div>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit profile </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<link rel="stylesheet" href="style.css">

<body>

    <!-- navbar -->
    <?php include 'navuser.php' ?>


    <!-- main -->
    <div class="container">
        <h1 class="text-center">Edit profile </h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="first_name" class="form-label"> First name </label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name"
                    value="<?= $userRow["first_name"] ?> ">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last name </label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name"
                    value="<?= $userRow["last_name"] ?> ">
            </div>
            
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of birth </label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                    value="<?= $userRow["date_of_birth"] ?>">
            </div>

            <div class="mb-3">
                <label for="picture" class="form-label">Profile picture </label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address"
                    value="<?= $userRow["email"] ?> ">
            </div>
            <div class=" mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="************" name="password">
            </div>
            <div class="mb-3 mt-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?= $userRow["address"] ?>">
            </div>
            <div class=" mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" value="<?= $userRow["phone_number"] ?>">
            </div>
            <div class="mb-5">
                <button name="update" type="submit" class="btn btn-warning">Update profile </button>
                <a href="<?= $backBtn ?>" class="btn btn-success">Back</a>
            </div>
        </form>
    </div>


    <!-- footer -->
    <div class="bg-dark text-light text-center">
        <h1 class="display-4 smiley">&#128526; My Fancy Website &#128526;</h1>
        <p class="lead">&#169; Midajew Cooperation & Co 2023</p>
        <p class="text-light m-0">Website created by Achmed Midajew |
            <a class="github-link " href="https://github.com/achmed124/" target="_blank">GitHub</a>
            <hr>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>