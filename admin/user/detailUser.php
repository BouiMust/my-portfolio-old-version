<!-- USER DETAIL (ADMIN UNIQUEMENT) -->
<!-- Page qui affiche les détails sur un utilisateur depuis l'id en parametre url-->

<?php include '../../assets/inc/back/head.php' ?>
<title>Détail utilisateur</title>

<!-- Vérifie si l'utilisateur connecté est Admin -->
<?php require '../../core/authentificationAdmin.php' ?>

<!-- GET ONE USER FROM DB -->
<?php
require '../../core/userController.php';
$user = getOneUser($_GET['id']);
$role = $user['role'] === '1' ? '<span style="color:blue;">Admin</span>' : 'Utilisateur';
?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Détails sur l'utilisateur n°<?= $user['id_user'] ?></h4>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <div class="pb-0" style="border: 2px solid #666;">
        <div class="row w-100 mx-auto my-2">

            <div class='col-4 ps-4 d-flex align-items-center justify-content-center'><img class='rounded border border-dark' src='../../assets/images/profiles/<?= $user['profile'] ?>' alt='image de la compétence' width=90%></div>
            <div class="col-8">
                <table class='table table-striped table-hover text-center border border-secondary'>

                    <tr class='align-middle'>
                        <th class='text-end col-3'>Id :</th>
                        <td><?= $user['id_user'] ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Prénom :</th>
                        <td class='text-break'><?= $user['first_name'] ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Nom :</th>
                        <td><?= $user['last_name'] ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Email :</th>
                        <td class='text-break'><?= $user['email'] ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Rôle :</th>
                        <td class='text-break fw-bold'><?= $role ?></td>
                    </tr>

                    <tr>
                        <th></th>
                        <td class='text-center'>
                            <a href='./updateUser.php?id=<?= $user['id_user'] ?>' title='Modifier'>
                                <div class='btn btn-info fs-5 py-1 px-3 border border-dark'>&#128394;</div>
                            </a>
                            <a href='./confirmDeleteUser.php?id=<?= $user['id_user'] ?>' title='Supprimer'>
                                <div class='btn btn-danger fs-5 py-1 px-3 border border-dark'>&#128465;</div>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <a href="./" class="btn btn-success border border-dark w-100">Retour à la liste des utilisateurs</a>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>