<!-- PAGE DE DEMANDE DE CONFIRMATION DE SUPPRESSION DE COMPTE (ACCES ADMIN UNIQUEMENT) -->

<?php include '../../assets/inc/back/head.php' ?>
<title>Confirmation de suppression</title>

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
        <h4 class="text-center pt-1">Suppression du compte n°<?= $user['id_user'] ?></h4>
    </div>
    <div class="pb-0" style="border: 2px solid #666;">
        <h5 class="text-center py-3">Voulez-vous vraiment supprimer ce compte ?</h5>
        <h5 class="text-center text-danger fw-bold p-0">Attention, cette action est irréversible.</h5>
        <div class="col-4 mx-auto py-3">
            <table class="table table-striped table-hover border border-secondary">

                <!-- AFFICHE L'UTILISATEUR RECUPERé DANS LA BDD -->
                <tr>
                    <td class='text-center' colspan='2'><img src='../../assets/images/profiles/<?= $user['profile'] ?>' alt='image de la competence' width=30% class='rounded border border-dark'></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Id :</th>
                    <td class='col-6'><?= $user['id_user'] ?></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Nom :</th>
                    <td class='col-6'><?= $user['last_name'] ?></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Prénom :</th>
                    <td class='col-6'><?= $user['first_name'] ?></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Email :</th>
                    <td class='col-6'><?= $user['email'] ?></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Rôle :</th>
                    <td class='col-6 fw-bold'><?= $role ?></td>
                </tr>
            </table>
            <form action="../../core/userController.php" method="post">
                <input type='hidden' name='action' value='delete'>
                <input type='hidden' name='id' value='<?= $user['id_user'] ?>'>
                <div class="py-3 text-center">
                    <button type='submit' class='btn btn-success py-2 px-4 border border-dark'>Valider</button>
                    <a href="./detailUser.php?id=<?= $user['id_user'] ?>" class='btn btn-danger py-2 px-4 border border-dark'>Retour</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>