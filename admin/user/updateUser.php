<!-- USER UPDATE (ADMIN UNIQUEMENT) -->
<!-- Page qui permet de modifier les infos d'un utilisateur -->

<?php include '../../assets/inc/back/head.php' ?>
<title>Modification Utilisateur</title>

<!-- Vérifie si l'utilisateur connecté est Admin -->
<?php require '../../core/authentificationAdmin.php' ?>

<!-- GET ONE USER FROM DB -->
<?php
require '../../core/userController.php';
$user = getOneUser($_GET['id']);
?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Modifier l'utilisateur n°<?= $user['id_user'] ?></h4>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <div class="pb-0" style="border: 2px solid #666;">

        <form action='../../core/userController.php' method='post'>
            <table class="table table-striped border border-secondary">

                <!-- EN-TETES DU TABLEAU -->
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                    <th>Rôle</th>
                    <th></th>
                    <th></th>
                </tr>

                <!-- AFFICHE L'UTILISATEUR A MODIFIER -->
                <!-- Je place l'action (=update) et l'id de l'user dans un input caché -->
                <!-- il me serviront pour modifier l'user (dans userController.php) -->
                <?php
                $selected = $user['role'] === '2' ? 'selected' : '';
                echo "
                    <tr class='align-middle'>
                    <input type='hidden' name='action' value='update'>
                    <input type='hidden' name='id' value='{$user['id_user']}'>
                    <td>
                    <input class='form-control pointer' type='text' name='first_name' id='first_name' value='{$user['first_name']}'>
                    </td>
                    <td>
                    <input class='form-control pointer' type='text' name='last_name' id='last_name' value='{$user['last_name']}'>
                    </td>
                    <td>
                    <input class='form-control pointer' type='email' name='email' id='email' value='{$user['email']}'>
                    </td>
                    <td>
                    <input class='form-control pointer' type='password' name='password' id='password'>
                    </td>
                    <td>
                    <select class='pointer' style='padding: 10px;' name='role' id='role'>
                    <option value=1>Admin</option>
                    <option value=2 $selected>Utilisateur</option>
                    </select>
                    </td>";
                ?>
            </table>
            <div class="row justify-content-center my-2">
                <?php for ($i = 1; $i < 10; $i++) : ?>
                    <div class="col-4 text-center" style="max-width: 110px;">
                        <label class="" for="<?= $i ?>">
                            <img src="../../assets/images/profiles/<?= $i ?>.jpg" alt="photo de profil" class="border border-dark pointer" width="100%">
                        </label>
                        <input class="form-check-input border pointer" type="radio" name="profile" id="<?= $i ?>" value="<?= $i ?>" <?php if ($i == $user['profile']) echo 'checked' ?>>
                    </div>
                <?php endfor ?>
            </div>
            <div class='text-center my-4'>
                <button class='btn btn-success py-2 px-4  border border-dark' type='submit'>Valider</button>
                <a href='./detailUser.php?id=<?= $user['id_user'] ?>' class='btn btn-danger py-2 px-4  border border-dark'>Retour</a>
            </div>
            </tr>
        </form>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>