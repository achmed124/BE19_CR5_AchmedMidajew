<?php
require_once "db_connect.php";

session_start();


$sql = "SELECT * FROM user";
$resultuser = mysqli_query($connect, $sql);
$rows = mysqli_fetch_assoc($resultuser);


$sql = "SELECT * FROM animal WHERE pet_age > 8";
$result = mysqli_query($connect, $sql);

$layout = "";


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $layout .= "
            <div class='card d-flex justify-content-start my-4'>
                <img src='{$row["picture"]}' class='card-img-top' alt='...' style='width: auto; height: 16rem; padding: 7px; border-radius: 15px;'>
                <div class='card-body'>
                    <h5 class='card-title fw-bold text-center py-1'>{$row["pet_name"]}</h5>
                    <p class='card-text fw-bold'>Breed:</p><p>{$row["pet_breed"]}</p>
                    <p class='card-text fw-bold'>Age:</p><p>{$row["pet_age"]}</p>
                    <p class='card-text fw-bold'>Status:</p><p>{$row["pet_status"]}</p>

                    <div class='buttons text-center'>
                        <a href='details.php?id={$row['id']}' class='btn btn-success'>Details</a>
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
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <!-- navbar -->
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Home</a>
</nav>
    <!-- main -->
    <div class="container">
        <div id="layout" class="row row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
            <?= $layout ?>
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