<!-- INDEX MESSAGE (ACCES ADMIN UNIQUEMENT) -->
<!-- Page qui affiche tous les messages -->

<?php include '../../assets/inc/back/head.php' ?>
<title>Gestion des Messages</title>

<!-- Vérifie si l'utilisateur connecté est Admin -->
<?php require '../../core/authentificationAdmin.php' ?>

<!-- GET ALL MESSAGES FROM DB -->
<?php
// require '../../core/messageController.php';
// $messages = getAllMessages();
?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Gestion des Messages</h4>
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
                <th class="col-2">Prénom</th>
                <th class="col-2">Nom</th>
                <th class="col-2">Société</th>
                <th class="col-2">Email</th>
                <th class="col-2">Téléphone</th>
                <th class="col-2">Message</th>
                <th class="text-center col-1">Voir</th>
                <th class="text-center col-1">Modifier</th>
                <th class="text-center col-1">Supprimer</th>
            </tr>

            <!-- AFFICHE TOUS LES MESSAGES -->
            <?php
            // foreach ($messages as $message) :
            //     $role = $message['role'] === '1' ? '<span style="color:orange;">Admin</span>' : '<span style="color:cornflowerblue;">Utilisateur</span>';
            //     echo "
            //         <tr class='align-middle'>
            //         <td>{$message['id']}</td>
            //         <td><img src='../../assets/images/profiles/{$message['profile']}' alt='photo de profil' width='40%'></td>
            //         <td>{$message['first_name']}</td>
            //         <td>{$message['last_name']}</td>
            //         <td>{$message['email']}</td>
            //         <td>$role</td>
            //         <td class='text-center'><a href='./detailMessage.php?id={$message['id']}' title='Voir'>
            //         <div class='btn btn-success fs-5 py-1 px-2'>&#128209;</div></a></td>
            //         <td class='text-center'><a href='./updateMessage.php?id={$message['id']}' title='Modifier'>
            //         <div class='btn btn-info fs-5 py-1 px-2'>&#128394;</div></a></td>
            //         <td class='text-center'><a href='./confirmDeleteMessage.php?id={$message['id']}' title='Supprimer'>
            //         <div class='btn btn-danger fs-5 py-1 px-2'>&#128465;</div></a></td>
            //         </tr>";
            // endforeach;
            ?>
        </table>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>