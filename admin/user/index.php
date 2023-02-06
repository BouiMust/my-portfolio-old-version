<!-- INDEX USERS (ACCES ADMIN UNIQUEMENT) -->
<!-- Page qui affiche tous les utilisateurs -->

<?php include '../../assets/inc/back/head.php' ?>
<title>Gestion des Utilisateurs</title>

<!-- Vérifie si l'utilisateur connecté est Admin -->
<?php require '../../core/authentificationAdmin.php' ?>

<!-- GET ALL USERS FROM DB -->
<?php
require '../../core/userController.php';
$users = getAllUsers();
?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <a href="http://localhost/portfolio/admin/user/createUser.php">
            <img src="../../assets/images/icons/add-button.svg" alt="ajouter un nouvel élément" title='Ajouter une réalisation' width=3% style='border-radius:50%;position:fixed; left:17vh;'>
        </a>
        <h4 class="text-center pt-1">Gestion des Utilisateurs</h4>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <div class="pb-0" style="border: 2px solid #666;">

        <table class="table table-striped table-hover">

            <!-- EN-TETES DU TABLEAU -->
            <tr>
                <th class="col-1">Id</th>
                <th class="col-2">Profil</th>
                <th class="col-2">Prénom</th>
                <th class="col-2">Nom</th>
                <th class="col-2">Email</th>
                <th class="col-2">Rôle</th>
                <th class="text-center col-1">Voir</th>
                <th class="text-center col-1">Modifier</th>
                <th class="text-center col-1">Supprimer</th>
            </tr>

            <!-- AFFICHE TOUS LES USERS -->
            <?php
            foreach ($users as $user) :
                $role = $user['role'] === '1' ? '<span style="color:blue;">Admin</span>' : 'Utilisateur';
                echo "
                    <tr class='align-middle'>
                    <td>{$user['id_user']}</td>
                    <td><img src='../../assets/images/profiles/{$user['profile']}' alt='photo de profil' class='border border-dark' width='40%'></td>
                    <td>{$user['first_name']}</td>
                    <td>{$user['last_name']}</td>
                    <td>{$user['email']}</td>
                    <td class='fw-bold'>$role</td>
                    <td class='text-center'><a href='./detailUser.php?id={$user['id_user']}' title='Voir'>
                    <div class='btn btn-success fs-5 py-1 px-2 border border-dark'>&#128209;</div></a></td>
                    <td class='text-center'><a href='./updateUser.php?id={$user['id_user']}' title='Modifier'>
                    <div class='btn btn-info fs-5 py-1 px-2 border border-dark'>&#128394;</div></a></td>
                    <td class='text-center'><a href='./confirmDeleteUser.php?id={$user['id_user']}' title='Supprimer'>
                    <div class='btn btn-danger fs-5 py-1 px-2 border border-dark'>&#128465;</div></a></td>
                    </tr>";
            endforeach;
            ?>
        </table>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>