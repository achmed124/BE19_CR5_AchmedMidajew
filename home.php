<?php
require_once "db_connect.php";

$sql = "SELECT * FROM `animal`";
$result = mysqli_query($connect, $sql);

$layout = "";



if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $layout .= "
            <div class='card d-flex justify-content-start my-4'>
                <img src='{$row["pet_photo"]}' class='card-img-top' alt='...' style='width: auto; height: 16rem; padding: 7px; border-radius: 15px;'>
                <div class='card-body'>
                    <h5 class='card-title fw-bold text-center py-1'>{$row["pet_name"]}</h5>
                    <p class='card-text fw-bold'>Breed:</p><p>{$row["pet_breed"]}</p>
                    <p class='card-text fw-bold'>Age:</p><p>{$row["pet_age"]}</p>
                    <p class='card-text fw-bold'>Status:</p><p>{$row["pet_status"]}</p>

                    <div class='buttons text-center'>
                        <a href='details.php?id={$row['id']}' class='btn btn-success'>Details</a>
                        <a href='update.php?id={$row["id"]}' class='btn btn-warning'>Update</a>
                        <a href='delete.php?id={$row["id"]}' class='btn btn-danger'>Delete</a>
                    </div>
                </div>
            </div>
            ";
    }
} else {
    $layout .= "<p> No Results was found</p>";
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

    <div class="container">
        <div id="layout" class="row row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
            <?= $layout ?>
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