<!-- USER UPDATE (ADMIN UNIQUEMENT) -->
<!-- Page qui permet de modifier les infos d'un utilisateur -->

<?php require_once '../assets/inc/back/head.php' ?>
<title>Détail utilisateur</title>

<!-- Vérifie si l'utilisateur connecté est Admin -->
<?php require_once '../core/authentificationAdmin.php' ?>

<!-- GET ONE USER FROM DB -->
<?php
require '../core/userController.php';
$user = readOneUser($_GET['id']);
?>

<body>

    <?php require_once '../assets/inc/back/header.php' ?>

    <main>
        <div class="bg-dark mb-2" style="border: 2px solid #666;">
            <h4 class="text-center pt-1">Modifier l'utilisateur n°<?= $user['id'] ?></h4>
        </div>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="alert alert-danger fs-5 text-center p-1">' . $_SESSION["error"] . '</p>';
            unset($_SESSION["error"]);
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

    <?php require_once '../assets/inc/back/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>