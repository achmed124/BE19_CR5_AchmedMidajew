<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: home.php");
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
}

require_once "db_connect.php";
require_once "file_upload.php";

$id = $_GET["id"];
$sql = "SELECT * FROM animal WHERE id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
    $pet_name = $_POST["pet_name"];
    $pet_breed = $_POST["pet_breed"];
    $pet_age = $_POST["pet_age"];
    $picture = fileUpload($_FILES["picture"], "product");
    $pet_location = $_POST["pet_location"];
    $pet_description = $_POST["pet_description"];
    $pet_vaccinated = $_POST["pet_vaccinated"];
    $pet_size = $_POST["pet_size"];
    $pet_status = $_POST["pet_status"];
    ;

    if ($_FILES["picture"]["error"] == 0) {
        if ($row["picture"] != "product.png") {
            unlink("pictures/$row[picture]");
        }
        $sql = "UPDATE animal SET pet_name = '$pet_name', pet_breed = '$pet_breed', pet_age = '$pet_age', picture = '$picture[0]', pet_location = '$pet_location', pet_description = '$pet_description', pet_description = '$pet_description', pet_vaccinated = '$pet_vaccinated', pet_size = '$pet_size', pet_status= '$pet_status' WHERE id = $id";
    } else {
        $sql = "UPDATE animal SET pet_name = '$pet_name', pet_breed = '$pet_breed', pet_age = '$pet_age', pet_location = '$pet_location', pet_description = '$pet_description', pet_description = '$pet_description', pet_vaccinated = '$pet_vaccinated', pet_size = '$pet_size', pet_status = '$pet_status' WHERE id = $id";
    }

    if (mysqli_query($connect, $sql)) {
        echo "<div class='alert alert-success' role='alert'>
            Product has been updated, {$picture[1]}
            </div>";
        header("refresh: 3; url= index.php");
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
            <h1>Update the products!</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="my-2">
                    <label for="picture" class="form-label fw-bold">Picture</label>
                    <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture"
                        value="<?= $row["picture"] ?>">
                </div>
                <div class="my-2">
                    <label for="pet_name" class="form-label fw-bold">Name</label>
                    <input type="text" class="form-control" id="title" aria-describedby="pet_name" name="pet_name"
                        value="<?= $row["pet_name"] ?>">
                </div>
                <div class="my-2">
                    <label for="pet_breed" class="form-label fw-bold">Pet breed</label>
                    <input type="text" class="form-control" id="pet_breed" aria-describedby="pet_breed" name="pet_breed"
                        value="<?= $row["pet_breed"] ?>">
                </div>
                <div class="my-2">
                    <label for="pet_age" class="form-label fw-bold">Age</label>
                    <input type="number" class="form-control" id="pet_age" aria-describedby="pet_age" name="pet_age"
                        value="<?= $row["pet_age"] ?>">
                </div>
                <div class="my-2">
                    <label for="pet_location" class="form-label fw-bold ">Location</label>
                    <input type="text" class="form-control" id="pet_location" aria-describedby="pet_location"
                        name="pet_location" value="<?= $row["pet_location"] ?>">
                </div>
                <div class="my-2">
                    <label for="pet_description" class="form-label fw-bold">Description</label>
                    <input type="text" class="form-control" id="pet_description" aria-describedby="pet_description"
                        name="pet_description" value="<?= $row["pet_description"] ?>">
                </div>
                <div class="mb-3">
                    <label for="pet_vaccinated" class="form-label fw-bold">Vaccinated</label>
                    <select class="form-select" id="status" aria-describedby="pet_vaccinated" name="pet_vaccinated">
                        <option value="yes" <?= $row["pet_vaccinated"] == "yes" ? "selected" : ""; ?>>Yes</option>
                        <option value="no" <?= $row["pet_vaccinated"] == "no" ? "selected" : ""; ?>>No</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pet_size" class="form-label fw-bold">Size</label>
                    <select class="form-select" id="status" aria-describedby="pet_size" name="pet_size">
                        <option value="large" <?= $row["pet_size"] == "large" ? "selected" : ""; ?>>Large</option>
                        <option value="medium" <?= $row["pet_size"] == "medium" ? "selected" : ""; ?>>Medium</option>
                        <option value="small" <?= $row["pet_size"] == "small" ? "selected" : ""; ?>>Small</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pet_status" class="form-label fw-bold">Status</label>
                    <select class="form-select" id="status" aria-describedby="pet_status" name="pet_status">
                        <option value="adopted" <?= $row["pet_status"] == "adopted" ? "selected" : ""; ?>>Adopted</option>
                        <option value="available" <?= $row["pet_status"] == "available" ? "selected" : ""; ?>>Available</option>
                    </select>
                </div>
                <button name="update" type="submit" class="btn btn-warning my-3">Update Media</button>
                <a href="home.php" class="btn btn-success my-3">Back to home page</a>
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