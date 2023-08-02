<?php
require_once "db_connect.php";
require_once "file_upload.php";

session_start();

if (isset($_SESSION["user"])) {
    header("Location: home.php");
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
}


if (isset($_POST["create"])) {
    $pet_name = $_POST["pet_name"];
    $pet_breed = $_POST["pet_breed"];
    $pet_age = $_POST["pet_age"];
    $picture = fileUpload($_FILES["picture"], "product");
    $pet_location = $_POST["pet_location"];
    $pet_description = $_POST["pet_description"];
    $pet_vaccinated = $_POST["pet_vaccinated"];
    $pet_size = $_POST["pet_size"];
    $pet_status = $_POST["pet_status"];

    $sql = "INSERT INTO `animal`( `pet_name`, `pet_breed`, `pet_age`, `picture`, `pet_location`, `pet_description`, `pet_vaccinated`, `pet_size`, `pet_status`) 
        VALUES ('$pet_name','$pet_breed','$pet_age', '$picture[0]', '$pet_location', '$pet_description', '$pet_vaccinated', '$pet_size', '$pet_status')";

    if (mysqli_query($connect, $sql)) {
        echo "<div class='alert alert-success' role='alert'>
                    New record has been created, {$picture[1]}
                </div>";
        header("refresh: 3; url = index.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                    error found, {$picture[1]}
                </div>";
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- navbar -->
    <?php include 'navadm.php' ?>


    <!-- main -->
    <div>
        <div class="container mt-5">
            <h1>Create a product!</h1>
            <form class="form" method="post" enctype="multipart/form-data">
                <div class="my-2">
                    <label for="picture" class="form-label fw-bold">Picture</label>
                    <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture">
                </div>
                <div class="my-2">
                    <label for="pet_name" class="form-label fw-bold">Name</label>
                    <input type="text" class="form-control" id="pet_name" aria-describedby="pet_name" name="pet_name">
                </div>
                <div class="my-2">
                    <label for="pet_breed" class="form-label fw-bold">Pet breed</label>
                    <input type="text" class="form-control" id="pet_breed" aria-describedby="pet_breed"
                        name="pet_breed">
                </div>
                <div class="my-2">
                    <label for="pet_age" class="form-label fw-bold">Age</label>
                    <input type="number" class="form-control" id="pet_age" aria-describedby="pet_age" name="pet_age">
                </div>
                <div class="my-2">
                    <label for="pet_location" class="form-label fw-bold ">Location</label>
                    <input type="text" class="form-control" id="pet_location" aria-describedby="pet_location"
                        name="pet_location">
                </div>
                <div class="my-2">
                    <label for="pet_description" class="form-label fw-bold">Description</label>
                    <input type="text" class="form-control" id="pet_description" aria-describedby="pet_description"
                        name="pet_description">
                </div>
                <div class="my-2">
                        <label for="pet_vaccinated" class="form-label fw-bold">Vaccinated</label>
                        <select class="form-select" id="pet_vaccinated" aria-describedby="pet_vaccinated" name="pet_vaccinated">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                </div>
                <div class="my-2">
                        <label for="pet_size" class="form-label fw-bold">Size</label>
                        <select class="form-select" id="pet_size" aria-describedby="pet_size" name="pet_size">
                            <option value="large">Large</option>
                            <option value="medium">Medium</option>
                            <option value="small">Small</option>
                        </select>
                </div>
                <div class="mb-3">
                    <label for="pet_status" class="form-label fw-bold">Status</label>
                    <select class="form-select" id="pet_status" aria-describedby="pet_status" name="pet_status">
                        <option value="adopted">Adopted</option>
                        <option value="avalaible">Avalaible</option>
                    </select>
                </div>

                <button name="create" type="submit" class="btn btn-warning my-4">Create product</button>
                <a href="home.php" class="btn btn-success my-2">Back to home page</a>
            </form>
        </div>
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
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>