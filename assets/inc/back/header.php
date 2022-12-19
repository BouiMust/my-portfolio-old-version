<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark my-2" style="border: 2px solid #666;">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/portfolio/admin/dashboardAdmin.php">ADMINISTRATION</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost/portfolio/admin/dashboardAdmin.php">TABLEAU DE BORD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/portfolio/admin/manageUsers.php">MANAGE USERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/portfolio/admin/manageSkills.php">MANAGE SKILLS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/portfolio/admin/manageMessages.php">MANAGE MESSAGES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/portfolio/admin/createAdminAccount.php">NEW ADMIN</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ACCOUNT
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"></a></li>
                            <li><a class="dropdown-item" href="#"></a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li> -->
                </ul>
                <form action="../core/userController.php" method="post">
                    <input type="hidden" name="do" value="logout">
                    <button class="btn btn-danger" type="submit">DECONNEXION</button>
                </form>
            </div>
        </div>
    </nav>
</header>