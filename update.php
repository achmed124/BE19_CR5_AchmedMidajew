<?php

require_once "db_connect.php";
require_once "file_upload.php";

$id = $_GET["id"];
$sql = "SELECT * FROM animal WHERE id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["create"])) {
    $pet_name = $_POST["pet_name"];
    $pet_breed = $_POST["pet_breed"];
    $pet_age = $_POST["pet_age"];
    $pet_photo = file_upload($_FILES["pet_photo"]);
    $pet_location = $_POST["pet_location"];
    $pet_description = $_POST["pet_description"];
    $pet_vaccinated = $_POST["pet_vaccinated"];
    $pet_size = $_POST["pet_size"];
    $pet_status = $_POST["pet_status"] === "available" ? 1 : 0;
    ;

    if ($_FILES["pet_photo"]["error"] == 0) {
        if ($row["pet_photo"] != "product.png") {
            unlink("pictures/$row[pet_photo]");
        }
        $sql = "UPDATE `animal` SET pet_name = '$pet_name', pet_breed = '$pet_breed', `pet_age` = '$pet_age', pet_photo = '$pet_photo[0]', `pet_location` = '$pet_location', pet_description = '$pet_description', pet_description = '$pet_description', pet_vaccinated = '$pet_vaccinated', 
        pet_size = '$pet_size', `pet_status`= $pet_status WHERE id = {$id}";
    } else {
        $sql = "UPDATE `animal` SET pet_name = '$pet_name', pet_breed = '$pet_breed', `pet_age` = '$pet_age', `pet_location` = '$pet_location', pet_description = '$pet_description', pet_description = '$pet_description', pet_vaccinated = '$pet_vaccinated', 
        pet_size = '$pet_size', `pet_status`= $pet_status WHERE id = {$id}";
    }

    if (mysqli_query($connect, $sql)) {
        echo "<div class='alert alert-warning' role='alert'>
            product has been updated, {$pet_name[1]}
            </div>";
        header("refresh: 3; url= home.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>
            error found, {$pet_name[1]}
            </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Update</title>
</head>

<body>

    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Home</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Create</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="senior.php">Senior</a>
                </li>
            </ul>
        </div>
    </div>
    </div>

    <div>
        <div class="container mt-5">
            <h1>Update the products!</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="my-2">
                    <label for="pet_photo" class="form-label fw-bold">Photo</label>
                    <input type="file" class="form-control" id="image" aria-describedby="pet_photo" name="pet_photo">
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
                <div class="my-2">
                    <label for="pet_vaccinated" class="form-label fw-bold">Vaccinated</label>
                    <input type="text" class="form-control" id="pet_vaccinated" aria-describedby="pet_vaccinated"
                        name="pet_vaccinated" value="<?= $row["pet_vaccinated"] ?>">
                </div>
                <div class="my-2">
                    <label for="pet_size" class="form-label fw-bold">Size</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pet_size" id="large" value="large"
                            <?= $row["pet_size"] == 2 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="pet_size_large">large</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pet_size" id="medium" value="medium"
                            <?= $row["pet_size"] == 1 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="pet_size_medium">medium</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pet_size" id="small" value="small"
                            <?= $row["pet_size"] == 0 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="pet_size_small">small</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pet_status" class="form-label fw-bold">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pet_status" id="pet_status_available"
                            value="available" <?= $row["pet_status"] == 1 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="pet_status_available">Available</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pet_status" id="status_not_available"
                            value="not_available" <?= $row["pet_status"] == 0 ? "checked" : ""; ?>>
                        <label class="form-check-label" for="pet_status_not_available">Adopted</label>
                    </div>
                </div>

                <button name="create" type="submit" class="btn btn-warning my-3">Update Media</button>
                <a href="home.php" class="btn btn-success my-3">Back to home page</a>
            </form>
        </div>
    </div>

    <div class="bg-dark">
        <p class="text-light text-center p-4">&#169; Achmed Midajew 2023</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>