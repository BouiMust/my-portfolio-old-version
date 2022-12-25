<!-- PAGE DE DEMANDE DE CONFIRMATION DE SUPPRESSION DE COMPTE (ACCES ADMIN UNIQUEMENT) -->

<?php include '../assets/inc/back/head.php' ?>
<title>Confirmation de suppression</title>

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
        <h4 class="text-center pt-1">Suppression du compte n°<?= $user['id'] ?></h4>
    </div>
    <div class="card bg-dark pb-0" style="border: 2px solid #666;">
        <h5 class="text-center py-3">Voulez-vous vraiment supprimer ce compte ?</h5>
        <h5 class="text-center text-danger border border-danger rounded mx-auto p-1 bg-black">Attention, cette action est irréversible.</h5>
        <div class="col-4 mx-auto py-3">
            <table class="table table-striped table-dark table-hover">

                <!-- AFFICHE L'UTILISATEUR RECUPERé DANS LA BDD -->
                <?php
                $role = $user['role'] === '1' ? '<span style="color:orange;">Admin</span>' : '<span style="color:cornflowerblue;">Utilisateur</span>';
                echo "<tr>
                        <th class='text-end col-6'>Id :</th>
                        <td class='col-6'>{$user['id']}</td>
                        </tr>
                        <tr>
                        <th class='text-end col-6'>Nom :</th>
                        <td class='col-6'>{$user['last_name']}</td>
                        </tr>
                        <tr>
                        <th class='text-end col-6'>Prénom :</th>
                        <td class='col-6'>{$user['first_name']}</td>
                        </tr>
                        <tr>
                        <th class='text-end col-6'>Email :</th>
                        <td class='col-6'>{$user['email']}</td>
                        </tr>
                        <tr>
                        <th class='text-end col-6'>Rôle :</th>
                        <td class='col-6'>$role</td>
                        </tr>";
                ?>
            </table>
            <form action="../core/userController.php" method="post">
                <input type='hidden' name='action' value='delete'>
                <input type='hidden' name='id' value='<?= $user['id'] ?>'>
                <div class="py-3 text-center">
                    <button type='submit' class='btn btn-success py-2 px-4'>Valider</button>
                    <a href="./detailUser.php?id=<?= $user['id'] ?>" class='btn btn-danger py-2 px-4'>Retour</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../assets/inc/back/footer.php' ?>