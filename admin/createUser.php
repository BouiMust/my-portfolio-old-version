<!-- NEW USER ACCOUNT (ACCES RESERVE A ADMIN UNIQUEMENT) -->
<!-- Ce fichier permet de créer un user dans la bdd  -->

<?php require_once '../assets/inc/back/head.php' ?>
<title>Nouvel utilisateur</title>

<!-- // Vérifie si l'user est admin en analysant les données en session -->
<?php require_once '../core/authentificationAdmin.php' ?>

<body>

    <?php require_once '../assets/inc/back/header.php' ?>

    <main>
        <div class="bg-dark mb-2" style="border: 2px solid #666;">
            <h4 class="text-center pt-1">Créer un compte utilisateur</h4>
        </div>
        <div class="card bg-dark" style="border: 2px solid #666;">
            <div class="col-4 mx-auto py-4">
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<p class="alert alert-danger fs-5 text-center p-1">' . $_SESSION["error"] . '</p>';
                    unset($_SESSION["error"]);
                };
                ?>
                <form action="../core/userController.php" method="post">
                    <input type="hidden" name="action" value="create">
                    <label for="last_name">Nom :</label>
                    <input class="form-control" type="text" name="last_name" id="last_name">
                    <label for="first_name">Prénom :</label>
                    <input class="form-control" type="text" name="first_name" id="first_name">
                    <label for="email">Adresse email :</label>
                    <input class="form-control" type="email" name="email" id="email">
                    <label for="password">Mot de passe :</label>
                    <input class="form-control" type="password" name="password" id="password">
                    <div class="mt-3">
                        <label for="isAdmin">Rôle Administrateur ?</label>
                        <input class="form-check-input bg-info" type="checkbox" id="isAdmin" name="isAdmin">
                    </div>
                    <button type="submit" name="submit" class="btn btn-success w-100 my-4">ENREGISTRER</button>
                </form>
            </div>
        </div>
    </main>

    <?php require_once '../assets/inc/back/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>