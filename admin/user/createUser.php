<!-- NEW USER ACCOUNT (ACCES RESERVE A ADMIN UNIQUEMENT) -->
<!-- Ce fichier permet de créer un user dans la bdd  -->

<?php include '../assets/inc/back/head.php' ?>
<title>Nouvel utilisateur</title>

<!-- // Vérifie si l'user est admin en analysant les données en session -->
<?php require '../core/authentificationAdmin.php' ?>

<?php include '../assets/inc/back/header.php' ?>

<main>
    <div class="bg-dark mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Créer un compte utilisateur</h4>
    </div>
    <div class="card bg-dark" style="border: 2px solid #666;">
        <div class="col-4 mx-auto py-4">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
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

<?php include '../assets/inc/back/footer.php' ?>