<!-- NEW USER ACCOUNT (ACCES RESERVE A ADMIN UNIQUEMENT) -->
<!-- Ce fichier permet de créer un user qui sera sauvegardé dans la BDD  -->

<?php include '../../assets/inc/back/head.php' ?>
<title>Nouvel utilisateur</title>

<!-- // Vérifie si l'user est admin en analysant les données en session -->
<?php require '../../core/authentificationAdmin.php' ?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Créer un compte utilisateur</h4>
    </div>
    <div style="border: 2px solid #666;">
        <div class="col-9 mx-auto py-4">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            };
            ?>
            <form action="../../core/userController.php" method="post">

                <div class="row justify-content-center mx-auto">

                    <!-- PHOTO PROFIL -->
                    <div class="row mt-3 col-5 mx-0">
                        <?php for ($i = 1; $i < 10; $i++) : ?>
                            <div class="col-4 text-center my-1">
                                <label class="" for="<?= $i ?>">
                                    <img src="../../assets/images/profiles/<?= $i ?>.jpg" alt="photo de profil" class="border border-dark pointer" width="100%">
                                </label>
                                <input class="form-check-input border pointer" type="radio" name="profile" id="<?= $i ?>" value="<?= $i ?>" <?php if ($i == 1) echo 'checked' ?>>
                            </div>
                        <?php endfor ?>
                    </div>

                    <div class="col-5">
                        <input type="hidden" name="action" value="create">
                        <label for="last_name">Nom :</label>
                        <input class="form-control pointer border border-dark" type="text" name="last_name" id="last_name">
                        <label for="first_name">Prénom :</label>
                        <input class="form-control pointer border border-dark" type="text" name="first_name" id="first_name">
                        <label for="email">Adresse email :</label>
                        <input class="form-control pointer border border-dark" type="email" name="email" id="email">
                        <label for="password">Mot de passe :</label>
                        <input class="form-control pointer border border-dark" type="password" name="password" id="password">
                        <div class="text-center my-3">
                            <label for="role">Rôle : </label>
                            <select class='pointer' style='padding: 10px;' name='role' id='role'>
                                <option value=1>Admin</option>
                                <option value=2>Utilisateur</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success border border-dark w-100">ENREGISTRER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>