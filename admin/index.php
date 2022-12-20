<!--
    Ce fichier va permettre à l'Admin de se connecter avec ses identifiants.
    Path : http://localhost/portfolio/admin/
-->
<?php include '../assets/inc/front/head.php' ?>
<title>Connexion Admin</title>
<?php include '../assets/inc/front/header.php' ?>

<main>
    <div class="bg-dark mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Connexion Admin</h4>
    </div>
    <div class="card bg-dark" style="border: 2px solid #666;">
        <div class="col-4 mx-auto py-4">
            <?php
            if (isset($_SESSION["message"])) {
                echo '<p class="alert alert-success fs-5 text-center p-1">' . $_SESSION["message"] . '</p>';
                unset($_SESSION["message"]);
            }
            if (isset($_SESSION['error'])) {
                echo '<p class="alert alert-danger fs-5 text-center p-1">' . $_SESSION["error"] . '</p>';
                unset($_SESSION["error"]);
            };
            ?>
            <form class="form-group" action="../core/userController.php" method="post">
                <input type="hidden" name="action" value="login">
                <label for="email">Adresse email :</label>
                <input type="email" class="form-control my-2" name="email" id="email">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control my-2" name="password" id="password">
                <button class="btn btn-success w-100 my-4" type="submit" name="submit">CONNEXION</button>
            </form>
        </div>
    </div>
</main>

<?php include '../assets/inc/front/footer.php' ?>