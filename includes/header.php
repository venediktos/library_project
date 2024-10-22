<header class="navbar navbar-expand-lg navbar-dark bg-dark flex-wrap fixed-top py-3">
    <div class="container-fluid">
        <a class="navbar-brand " href="/library_project/">Library Project</a>
        <form action = "../search.php" method="get" class="d-flex align-items-center ">
            <!-- Search button -->
            <button type = "submit" aria-label = "Search" class="btn btn-dark">
                <i class="bi bi-search"></i>
            </button>
            <!-- Search input -->
            <input class="form-control me-2" type = "search" name = "search" placeholder = "Search for books" aria-label="Search">
        </form>
        <!-- Navbar toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <!-- Home link -->
                    <a class="nav-link active" href="/library_project/">
                        <i class="bi bi-house-door-fill"></i>
                        Home</a>
                </li>
                <li class="nav-item">
                    <!-- Books link -->
                    <a class="nav-link active" href="/library_project/books.php">Books</a>
                </li>

            </ul>


            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class = "nav-item">
                    <!-- Wishlist link -->
                    <a class="nav-link active" href="/library_project/wishlist.php">Wishlist</a>
                </li>
                <li class = "nav-item">
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                        ?>
                        <div class="dropdown">
                            <!-- Dropdown for logged-in user -->
                            <button class = "nav-link active dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" ><?php echo $_SESSION["username"] ?></button>

                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">

                                <li>
                                    <!-- Manage account link -->
                                    <a class="dropdown-item" href = "/library_project/account.php">Manage Account</a>
                                </li>

                                <li>
                                    <!-- Logout link -->
                                    <a class = "dropdown-item" href = "/library_project/logout.php">Logout</a>
                                </li>
                            </ul>
                        </div>
                        <?php
                    } elseif (!(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true)) {
                        ?>
                        <!-- Login link -->
                        <a class = "nav-link active" href = "/library_project/login.php">Login</a>
                        <?php
                    }
                    ?>


                </li>


                <li class = "nav-item">
                    <?php
                    // Check if admin is logged in
                    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
                        ?>

                        <div class="dropdown">
                            <!-- Dropdown for admin user -->
                            <button class = "nav-link active dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" >Admin</button>

                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                <li>
                                    <!-- Loan books link -->
                                    <a class="dropdown-item" href = "/library_project/loan_books.php">Loan Books</a>
                                </li>
                                <li>
                                    <!-- All loans link -->
                                    <a class="dropdown-item" href = "/library_project/loans.php">All Loans</a>
                                </li>
                                <li>
                                    <!-- Logout link -->
                                    <a class = "dropdown-item" href = "/library_project/logout.php">Logout</a>
                                </li>
                            </ul>
                        </div>
                        <?php
                    } elseif (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)) {
                        ?>
                        <!-- Admin login link -->
                        <a class = "nav-link active" href = "/library_project/admin_login.php">Admin</a>
                        <?php
                    }
                    ?>

                </li>
                <li class = "nav-item">
                    <?php
                    // Check if user or admin are logged in and if not
                    if (!((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)) && !((isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true))){
                        ?>
                        <!-- Signup link -->
                        <a class = "nav-link active" href = "/library_project/signup.php">Signup</a>
                        <?php
                    } ?>

                </li>

            </ul>
        </div>
    </div>
</header>
