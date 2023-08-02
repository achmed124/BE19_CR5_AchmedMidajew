<?php
require_once "db_connect.php";
require_once "file_upload.php";

session_start();

if (isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
}

if (isset($_SESSION["user"])) {
    header("Location: home.php");
}

$error = false;

$fname = $lname = $email = $date_of_birth = $email = "";
$fnameError = $lnameError = $dateError = $emailError = $passError = "";

function cleanInput($param)
{
    $data = trim($param);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
}

if (isset($_POST["sign-up"])) {
    $fname = cleanInput($_POST["fname"]);
    $lname = cleanInput($_POST["lname"]);
    $email = cleanInput($_POST["email"]);
    $password = $_POST["password"];
    $date_of_birth = cleanInput($_POST["date_of_birth"]);
    $picture = fileUpload($_FILES["picture"]);

    if (empty($fname)) {
        $error = true;
        $fnameError = "Please, enter your first name";
    } elseif (strlen($fname) < 3) {
        $error = true;
        $fnameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $error = true;
        $fnameError = "Name must contain only letters and spaces.";
    }

    if (empty($lname)) {
        $error = true;
        $lnameError = "Please, enter your last name";
    } elseif (strlen($lname) < 3) {
        $error = true;
        $lnameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
        $error = true;
        $lnameError = "Name must contain only letters and spaces.";
    }

    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "date of birth can't be empty!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        $query = "SELECT email FROM user WHERE email = '$email'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Provided Email is already in use";
        }
    }

    if (empty($password)) {
        $error = true;
        $passError = "Password can't be empty!";
    } elseif (strlen($password) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    if (!$error) {
        $password = hash("sha256", $password);
        $sql = "INSERT INTO `user`( `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`) VALUES ('$fname','$lname','$password','$date_of_birth','$email','$picture[0]') ";

        if (mysqli_query($connect, $sql)) {
            echo "<div class='alert alert-success'>
               <p>New account has been created, $picture[1]</p>
                </div>";
        } else {
            echo "<div class='alert alert-danger'>
                    <p>Something went wrong, please try again later ...</p>
                </div>";
        }

    }

}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- main -->
    <div class="container bg-dark text-light">
        <h1 class="text-center">Sign Up </h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="fname" class="form-label">First name </label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First name"
                    value="<?= $fname ?>">
                <span class="text-danger">
                    <?= $fnameError ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last name </label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name"
                    value="<?= $lname ?>" required>
                <span class="text-danger">
                    <?= $lnameError ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date of birth</label>
                <input type="date" class="form-control" id="date" name="date_of_birth" value="<?= $date_of_birth ?>">
                <span class="text-danger">
                    <?= $dateError ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Profile picture </label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address"
                    value="<?= $email ?>">
                <span class="text-danger">
                    <?= $emailError ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger">
                    <?= $passError ?>
                </span>
            </div>
            <button name="sign-up" type="submit" class="btn btn-primary">Create account </button>

            <span>You have an account already? <a href="login.php">Sign in here </a></span>
        </form>
    </div>
<br><br>

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
        crossorigin="anonymous">
    </script>
</body>

</html>