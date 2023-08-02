<?php

session_start();

if (isset($_SESSION["user"])) {
    header("Location: home.php");
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
}

require_once "db_connect.php";

$sql = "SELECT * FROM user WHERE id = {$_SESSION["adm"]}";

$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

$sqlUsers = "SELECT * FROM user WHERE status != 'adm'";

$resultUsers = mysqli_query($connect, $sqlUsers);

$layout = "";

if (mysqli_num_rows($resultUsers) > 0) {
    while ($userRow = mysqli_fetch_assoc($resultUsers)) {
        $layout .= "<div>
            <div class='card' style='width: 18rem;'>
                <img src='pictures/{$userRow["picture"]}' class='card-img-top' alt='...' style='width: 40px;'>
                <div class='card-body'>
                <h5 class='card-title'>{$userRow["first_name"]} {$userRow["last_name"]}</h5>
                <p class='card-text'>{$userRow["email"]}</p>
                <p class='card-text'>{$userRow["address"]}</p>
                <p class='card-text'>{$userRow["date_of_birth"]}</p>
                <a href='update.php?id={$userRow["id"]}' class='btn btn-warning'>Update</a>
            </div>
        </div>
      </div>";
    }
} else {
    $layout .= "No results found!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome
        <?= $row["first_name"] ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Pets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="create.php">Create</a>
                    </li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Filter
                        </a>
                        <ul class="dropdown-menu active">
                            <li>
                                <a class="dropdown-item" href="senior.php">Senior</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="adopted.php">Adopted</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="available.php">Available</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php?logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- main -->
    <h2 class="text-center my-4">Welcome
        <?= $row["first_name"] . " " . $row["last_name"] ?> !
    </h2>
    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
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