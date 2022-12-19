<!--
    Ce fichier va permettre à l'Admin de se connecter avec ses identifiants.
    Path : http://localhost/portfolio/admin/
-->
<?php include '../assets/inc/front/head.php' ?>
<title>Login Admin</title>
<?php include '../assets/inc/front/header.php' ?>

<main>
    <?php
    if (isset($_SESSION["message"])) {
        echo '<div class="alert alert-success">' . $_SESSION["message"] . '</div>';
        unset($_SESSION["message"]);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION["error"] . '</div>';
        unset($_SESSION["error"]);
    };
    ?>
    <div class="container">
        <div class="row justidy-content-center">
            <form class="form-group" action="../core/userController.php" method="post">
                <input type="hidden" name="do" value="log-admin">
                <input type="email" class="form-control my-2" name="email" placeholder="Adresse email">
                <input type="password" class="form-control my-2" name="password" placeholder="Mot de passe">
                <button class="btn btn-success" type="submit" name="submit">CONNEXION</button>
            </form>
        </div>
    </div>
</main>

<?php include '../assets/inc/front/footer.php' ?>