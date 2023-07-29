<?php
require_once "db_connect.php";
require_once "file_upload.php";


$id = $_GET["id"];
$sql = "SELECT * FROM animal WHERE id = $id";
$result = mysqli_query($connect, $sql);




$layout = "";


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $layout = "
                <div class='card mb-3'>
                <div class='flex'> 
                <img src='{$row["pet_photo"]}' class='card-img-top' alt='...' style='width: auto; height: 16rem; padding: 7px; border-radius: 15px;'>
                    <div class='card-body'>
                        <p class='card-title'><p class='fw-bold'>Name:</p> {$row["pet_name"]}</p>
                        <p class='card-text'><p class='fw-bold'>Breed:</p>{$row["pet_breed"]}</p>
                        <p class='card-text'><p class='fw-bold'>Age:</p>{$row["pet_age"]}</p>
                        <p class='card-text'><p class='fw-bold'>Location:</p> {$row["pet_location"]}</p>
                        <p class='card-text'><p class='fw-bold'>Description:</p>{$row["pet_description"]}</p>
                        <p class='card-text'><p class='fw-bold'>Vaccinated:</p>{$row["pet_vaccinated"]}</p>
                        <p class='card-text'><p class='fw-bold'>Size:</p>{$row["pet_size"]}</p>

                        <p class='card-text'><p class='fw-bold'>Status:</p> ";

        if ($row["pet_status"] == "1") {
            $layout .= "<span class='text-success'>Available</span>";
        } else {
            $layout .= "<span class='text-danger'>Adopted</span>";
        }

        $layout .= "
                    </p>
                        <a href='update.php?id={$row["id"]}' class='btn btn-warning'>Update</a>
                        <a href='index.php' class='btn btn-success'>Back to home page</a>
                    </div>
                </div>
            </div>    
                ";
    }
} else {
    $layout .= "<p> No Results was found</p>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Home</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Create</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container my-4">
        <?= $layout ?>
    </div>

    <div class="bg-dark">
        <p class="text-light text-center p-4">&#169; Achmed Midajew 2023</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>