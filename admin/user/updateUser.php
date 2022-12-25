<!-- USER UPDATE (ADMIN UNIQUEMENT) -->
<!-- Page qui permet de modifier les infos d'un utilisateur -->

<?php include '../assets/inc/back/head.php' ?>
<title>Détail utilisateur</title>

<!-- Vérifie si l'utilisateur connecté est Admin -->
<?php require '../core/authentificationAdmin.php' ?>

<!-- GET ONE USER FROM DB -->
<?php
require '../core/userController.php';
$user = readOneUser($_GET['id']);
?>

<?php include '../assets/inc/back/header.php' ?>

<main>
    <div class="bg-dark mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Modifier l'utilisateur n°<?= $user['id'] ?></h4>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <div class="card bg-dark pb-0" style="border: 2px solid #666;">

        <form action='../core/userController.php' method='post'>
            <table class="table table-striped table-dark">

                <!-- EN-TETES DU TABLEAU -->
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
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
                    <td name='id' id='id' value='{$user['id']}'>{$user['id']}</td>
                    <input type='hidden' name='action' value='update'>
                    <input type='hidden' name='id' value='{$user['id']}'>
                    <td>
                    <input class='form-control' type='text' name='last_name' id='last_name' value='{$user['last_name']}'>
                    </td>
                    <td>
                    <input class='form-control' type='text' name='first_name' id='first_name' value='{$user['first_name']}'>
                    </td>
                    <td>
                    <input class='form-control' type='email' name='email' id='email' value='{$user['email']}'>
                    </td>
                    <td>
                    <input class='form-control' type='password' name='password' id='password'>
                    </td>
                    <td>
                    <select class='pointer' style='padding: 10px;' name='role' id='role'>
                    <option value=1>Admin</option>
                    <option value=2 $selected>Utilisateur</option>
                    </select>
                    </td>
                    <td class='text-center'>
                    <button class='btn btn-success py-2 px-4' type='submit'>Valider</button></td>
                    <td class='text-center'>
                    <a href='./detailUser.php?id={$user['id']}' class='btn btn-danger py-2 px-4'>Retour</a></td>
                    </tr>";
                ?>
            </table>
        </form>
    </div>
</main>

<?php include '../assets/inc/back/footer.php' ?>