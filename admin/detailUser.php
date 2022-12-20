<!-- USER DETAIL (ADMIN UNIQUEMENT) -->
<!-- Page qui affiche les détails sur un utilisateur -->

<?php require_once '../assets/inc/back/head.php' ?>
<title>Détail utilisateur</title>

<!-- Vérifie si l'utilisateur connecté est Admin -->
<?php require_once '../core/authentificationAdmin.php' ?>


<!-- GET ONE USER FROM DB WITH ID IN URL PARAMS-->
<?php

// Fichier databaseConnexion.php requis pour la connexion à la BDD
require '../core/databaseConnexion.php';

// Préparation de la requête : Récupère la ligne correspondant à l'id dans la table user
$sql = "SELECT * FROM user WHERE id = '{$_GET['id']}'";

// Execution de la requête avec les params de connexion et sauvegarde la reponse dans $query
$query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

// Met les données sous forme de tableau associatif et exploitable
$user = mysqli_fetch_assoc($query);
?>

<body>

    <?php require_once '../assets/inc/back/header.php' ?>

    <main>
        <div class="bg-dark mb-2" style="border: 2px solid #666;">
            <h4 class="text-center pt-1">Détails sur l'utilisateur n°<?= $user['id'] ?></h4>
        </div>
        <div class="card bg-dark pb-0" style="border: 2px solid #666;">

            <table class="table table-striped table-dark table-hover">

                <!-- EN-TETES DU TABLEAU -->
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <!-- <th>Mot de passe</th> -->
                    <th>Rôle</th>
                    <th class="text-center">Modifier</th>
                    <th class="text-center">Supprimer</th>
                </tr>

                <!-- AFFICHE TOUS LES USERS -->

                <?php
                $role = $user['role'] === '1' ? 'Admin' : 'Utilisateur';
                echo "
                    <form action='#' method='post'>
                    <tr class='align-middle'>
                    <td>{$user['id']}</td>
                    <td>{$user['last_name']}</td>
                    <td>{$user['first_name']}</td>
                    <td>{$user['email']}</td>
                    <td>$role</td>
                    <td class='text-center'><a href='./updateUser.php?id={$user['id']}'>
                    <div class='btn btn-info fs-5 py-1 px-2'>&#128394;</div></a></td>
                    <td class='text-center'><form action='../core/userController.php?id={$user['id']}' method='post'>
                    <input type='hidden' name='action' value='delete'>
                    <button class='btn btn-danger fs-5 py-1 px-2' type='submit'>&#128465;</button></form></td>
                    </tr>
                    </form>";
                ?>
            </table>
        </div>
    </main>

    <?php require_once '../assets/inc/back/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>