<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<header class="navbar navbar-expand-lg navbar-dark bg-dark flex-wrap fixed-top py-3">
    <div class="container-fluid">
        <a class="navbar-brand mx-auto" href="/untitled/">Library Project</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/untitled/">
                        <i class="bi bi-house-door-fill"></i>
                        Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/untitled/books.php">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Pricing</a>
                </li>

                <li class="nav-item">
                    <form action = "../search.php" method="get" class="d-flex align-items-center">
                        <button type = "button" aria-label = "Search" class="btn btn-dark">
                            <i class="bi bi-search"></i>
                        </button>
                        <input class="form-control me-2" type = "search" name = "search" placeholder = "Search for books" aria-label="Search">
                    </form>
                </li>
            </ul>


            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class = "nav-item">
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                        ?>
                        <div class="dropdown">
                            <button class = "nav-link active dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" ><?php echo $_SESSION["username"] ?></button>

                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                <li><a class="dropdown-item" href = "/untitled/account.php">Manage Account</a></li>

                                <li><a class = "dropdown-item" href = "/untitled/logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <?php
                    } elseif (!(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true)) {
                        ?>
                        <a class = "nav-link active" href = "/untitled/login.php">Login</a>
                        <?php
                    }
                    ?>


                </li>


                <li class = "nav-item">
                    <?php
                    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
                        ?>
                        <a class = "nav-link active" href = "/untitled/admin.php">Admin</a>
                        <?php
                    } elseif (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)) {
                        ?>
                        <a class = "nav-link active" href = "/untitled/admin_login.php">Admin</a>
                        <?php
                    }
                    ?>

                </li>
                <li class = "nav-item">
                    <?php
                    if (!((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)) && !((isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true))){
                        ?>

                        <a class = "nav-link active" href = "/untitled/signup.php">Signup</a>
                        <?php
                    } ?>

                </li>
            </ul>
        </div>
    </div>
</header>
