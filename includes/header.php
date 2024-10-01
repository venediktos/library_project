<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<nav class="navbar navbar-expand-lg bg-dark-subtle flex-wrap">
    <div class="container-fluid">
        <a class="navbar-brand mx-auto" href="#">Library</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-house-door-fill"></i>
                        Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
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
                    <a class = "nav-link active" href = "https://github.com/venediktos">
                        <i class="bi bi-github"></i>
                        My Github</a>
                </li>
                <li class = "nav-item">
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    ?>
                        <a class = "nav-link active" href = "/untitled/admin.php">Admin</a>
                    <?php
                    } else {
                        ?>
                        <a class = "nav-link active" href = "/untitled/login.php">Login</a>
                    <?php
                    }
                    ?>


                </li>
                <li class = "nav-item">
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                        ?>
                        <a class = "nav-link active" href = "/untitled/logout.php">Logout</a>
                        <?php
                    } else {
                        ?>
                        <a class = "nav-link active" href = "/untitled/signup.php">Signup</a>
                        <?php
                    }
                    ?>

                </li>
            </ul>
        </div>
    </div>
</nav>