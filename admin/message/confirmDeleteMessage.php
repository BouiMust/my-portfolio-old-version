<!-- PAGE DE DEMANDE DE CONFIRMATION DE SUPPRESSION DE COMPTE (ACCES ADMIN UNIQUEMENT) -->

<?php include '../../assets/inc/back/head.php' ?>
<title>Confirmation de suppression</title>

<!-- Vérifie si le message connecté est Admin -->
<?php require '../../core/authentificationAdmin.php' ?>

<!-- GET ONE MESSAGE FROM DB -->
<?php
require '../../core/messageController.php';
$message = getOneMessage($_GET['id']);
$company = !empty($message['company']) ? $message['company'] : '&#8211';
$phone = !empty($message['phone']) ? $message['phone'] : '&#8211'; ?>
?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Suppression du compte n°<?= $message['id'] ?></h4>
    </div>
    <div class="pb-0" style="border: 2px solid #666;">
        <h5 class="text-center py-3">Voulez-vous vraiment supprimer ce compte ?</h5>
        <h5 class="text-center text-danger fw-bold p-0">Attention, cette action est irréversible.</h5>
        <div class="col-6 mx-auto py-3">
            <table class="table table-striped table-hover border border-secondary">

                <!-- AFFICHE LE MESSAGE RECUPERé DANS LA BDD -->
                <tr>
                    <th class='text-end col-6'>Id :</th>
                    <td class='col-6'><?= $message['id'] ?></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Prénom :</th>
                    <td class='col-6'><?= $message['first_name'] ?></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Nom :</th>
                    <td class='col-6'><?= $message['last_name'] ?></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Email :</th>
                    <td class='col-6'><?= $message['email'] ?></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Société :</th>
                    <td class='col-6 fw-bold'><?= $company ?></td>
                </tr>
                <tr>
                    <th class='text-end col-6'>Téléphone :</th>
                    <td class='col-6 fw-bold'><?= $phone ?></td>
                </tr>
            </table>
            <table class='table table-striped table-hover text-center border border-secondary'>
                <tr>
                    <th class='text-center'>Message :</th>
                </tr>
                <tr>
                    <td class='text-break fw-bold text-justify' style='text-align:justify'><?= nl2br($message['text']) ?></td>
                </tr>
            </table>
            <form action="../../core/messageController.php" method="post">
                <input type='hidden' name='action' value='delete'>
                <input type='hidden' name='id' value='<?= $message['id'] ?>'>
                <div class="py-3 text-center">
                    <button type='submit' class='btn btn-success py-2 px-4 border border-dark'>Valider</button>
                    <a href="./detailMessage.php?id=<?= $message['id'] ?>" class='btn btn-danger py-2 px-4 border border-dark'>Retour</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>