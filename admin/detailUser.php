<!-- USER DETAIL (ADMIN UNIQUEMENT) -->
<!-- Page qui affiche les détails sur un utilisateur depuis l'id en parametre url-->

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
        <h4 class="text-center pt-1">Détails sur l'utilisateur n°<?= $user['id'] ?></h4>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <div class="card bg-dark pb-0" style="border: 2px solid #666;">
        <table class="table table-striped table-dark table-hover">

            <!-- EN-TETES DU TABLEAU -->
            <tr>
                <th class="col-1">Id</th>
                <th class="col-2">Nom</th>
                <th class="col-2">Prénom</th>
                <th class="col-2">Email</th>
                <th class="col-2">Rôle</th>
                <th class="col-1"></th>
                <th class="text-center col-1">Modifier</th>
                <th class="text-center col-1">Supprimer</th>
            </tr>

            <!-- AFFICHE L'UTILISATEUR RECUPERé DANS LA BDD -->
            <?php
            $role = $user['role'] === '1' ? '<span style="color:orange;">Admin</span>' : '<span style="color:cornflowerblue;">Utilisateur</span>';
            echo "
                    <form action='#' method='post'>
                    <tr class='align-middle'>
                    <td>{$user['id']}</td>
                    <td>{$user['last_name']}</td>
                    <td>{$user['first_name']}</td>
                    <td>{$user['email']}</td>
                    <td>$role</td>
                    <td></td>
                    <td class='text-center'><a href='./updateUser.php?id={$user['id']}'>
                    <div class='btn btn-info fs-5 py-1 px-2'>&#128394;</div></a></td>
                    <td class='text-center'><a href='./confirmDeleteUser.php?id={$user['id']}'>
                    <div class='btn btn-danger fs-5 py-1 px-2'>&#128465;</div></a></td>
                    </tr>
                    </form>";
            ?>
        </table>
    </div>
</main>

<?php include '../assets/inc/back/footer.php' ?>