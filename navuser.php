<nav class="navbar navbar-expand-lg navbar-dark bg-dark navi">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="pictures/<?= $userRow["picture"] ?>" alt="user pic" width="30" height="24">
        </a>
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="updateuser.php?id=<?= $userRow["id"] ?>">Edit Profile</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Filter</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item nav1" href="senior.php">Senior</a>
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