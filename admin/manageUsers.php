<!-- MANAGE USERS (ADMIN UNIQUEMENT) -->

<?php require_once '../assets/inc/back/head.php' ?>
<title>Gestion des Utilisateurs</title>

<?php require_once '../core/authentificationAdmin.php' ?>

<?php
// Fichier databaseConnexion.php requis pour la connexion
require './databaseConnexion.php';

// formatage du mail
$email = trim(strtolower($_POST['email']));

// Vérifie l'email de l'admin (unique). le champ email possède une clé unique dans la BDD
// Préparation de la requête : vérifie si l'email est présente 
$sql = "
    SELECT * FROM user WHERE email = '$email'
    ";

// Execution de la requête avec les params de connexion et sauvegarde la reponse dans $query
$query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

// Traitement des données : vérification de l'email dans la BDD
// On utilise mysqli_num_row qui compte le nombre de lignes dans la table user

// S'il n'y a pas d'utilisateur dans la BDD 
if (mysqli_num_rows($query) < 1) {
    // message alerte
    $_SESSION['error'] = 'No user matches.';
    // redirection
    header('Location: ../admin/index.php');
    exit();
}

// Sinon on met sous forme de tableau associatif les données de l'admin récupérés
$user = mysqli_fetch_assoc($query);
?>

<body>

    <?php require_once '../assets/inc/back/header.php' ?>

    <main>
        <div class="bg-dark mb-2" style="border: 2px solid #666;">
            <h4 class="text-center pt-1">Gestion des Utilisateurs</h4>
        </div>
        <div class="card bg-dark" style="border: 2px solid #666;">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
        </div>
    </main>

    <?php require_once '../assets/inc/back/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>