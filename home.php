<?php

session_start();

if (isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
}

require_once "db_connect.php";


$userId = $_SESSION["user"];
$userSql = "SELECT * FROM user WHERE id = $userId";
$userResult = mysqli_query($connect, $userSql);
$userRow = mysqli_fetch_assoc($userResult);


$sqlProducts = "SELECT * FROM animal";
$resultProducts = mysqli_query($connect, $sqlProducts);

$layout = "";

if (mysqli_num_rows($resultProducts) > 0) {
    while ($rowProduct = mysqli_fetch_assoc($resultProducts)) {
        $layout .= "
            <div class='card d-flex justify-content-start my-4'>
                <img src='{$rowProduct["picture"]}' class='card-img-top' alt='...' style='width: auto; height: 16rem; padding: 7px; border-radius: 15px;'>
                <div class='card-body'>
                    <h5 class='card-title fw-bold text-center py-1'>{$rowProduct["pet_name"]}</h5>
                    <p class='card-text fw-bold'>Breed:</p><p>{$rowProduct["pet_breed"]}</p>
                    <p class='card-text fw-bold'>Age:</p><p>{$rowProduct["pet_age"]}</p>
                    <p class='card-text fw-bold'>Age:</p><p>{$rowProduct["pet_status"]}</p>

                    <div class='buttons text-center d flex'>
                    <a href='details.php?id={$rowProduct['id']}' class='btn btn-success mb-2'>Details</a>";

        if ($rowProduct["pet_status"] === 'available' && isset($_SESSION["user"])) {
            $layout .= "<form action='home.php' method='POST'>
                            <input type='hidden' name='id' value='{$rowProduct['id']}'>
                            <button type='submit' name='adopt' class='btn btn-success'>Adopt me!</button>
                        </form>";
        } else {
            $status = $rowProduct["pet_status"] === 'adopted' ? 'adopted' : 'available';
            $layout .= "<p>Status: $status</p>";
        }
        $layout .= "</div>
            </div>
        </div>";
    }

} else {
    $layout .= "No results found!";
}

if (isset($_POST["adopt"]) && isset($_SESSION["user"])) {
    $pet_id = $_POST["id"];
    $user_id = $_SESSION["user"];
    $adoption_date = date("Y-m-d");

    $sql = "UPDATE animal SET pet_status = 'Adopted' WHERE id = $pet_id";
    mysqli_query($connect, $sql);

    $sql = "INSERT INTO pet_adoption (user_id, pet_id, adoption_date) VALUES ('$user_id', '$pet_id', '$adoption_date')";
    mysqli_query($connect, $sql);

    header("Location: home.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome
        <?= $userRow["first_name"] ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navuser.php' ?>

    <h2 class="text-center mt-4">Welcome
        <?= $userRow["first_name"] . " " . $userRow["last_name"] ?> !
    </h2>

    <div class="container">
        <div class="row row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
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
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>