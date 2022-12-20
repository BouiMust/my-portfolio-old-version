<!-- NEW ADMIN ACCOUNT (ADMIN UNIQUEMENT) -->
<!-- Ce fichier permet de créer un user avec le role Admin dans la bdd pour qu'il puisse gérer/administrer le site -->
<!-- Accès reservé à l'admin -->

<?php require_once '../assets/inc/back/head.php' ?>

<title>New Admin</title>

<?php
// Vérifie si l'user est admin en analysant les données en session
if (!($_SESSION['isLog'] && $_SESSION['role'] === '1')) {
    $_SESSION['error'] = 'Accès refusé.';
    header('Location: ../index.php');
    exit();
}
?>

<?php
// Si le formulaire est soumis
if (isset($_POST["submit"])) :
    // on récupère le fichier de connexion databaseConnexion.php qui correspond aux params de connexion de la bdd
    require_once '../core/databaseConnexion.php';
    // addslashes prend en compte les caract spec, trim supprime les espaces, ucfirst met la 1ere lettre en maj
    // strtolower pour mettre en min
    $first_name = addslashes(trim(ucfirst($_POST["first_name"])));
    $last_name = addslashes(trim(ucfirst($_POST["last_name"])));
    $email = trim(strtolower($_POST["email"]));
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT, ['cost' => 12]);
    $role = (int)2; // ROLE 2 = ROLE MEMBRE (DE BASE)
    if (isset($_POST["isAdmin"])) {
        $role = (int)1; // ROLE 1 = ROLE ADMIN
    }
    // création de la requête SQL
    $sql = "
    INSERT INTO user (first_name,last_name,email,password,role)
    VALUE ('$first_name', '$last_name', '$email', '$password', '$role')
    ";

    // envoie de la requête avec les params de connexion
    // envoie une erreur si echoue
    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    // message
    $_SESSION["message"] = "L'utilisateur $last_name $first_name est ajouté à la base de données.";

    // redirection vers notre page d'accueil
    header("Location: ./dashboardAdmin.php");
    exit();
endif;
?>

<body>

    <?php require_once '../assets/inc/back/header.php' ?>

    <main>
        <div class="container">
            <div class="row mt-4">
                <h1 class="text-center">CREATION D'UN COMPTE UTILISATEUR</h1>
                <div class="col-4 form-group text-center fs-4 mx-auto">
                    <form action="" method="post">
                        <label for="last_name">Nom</label>
                        <input class="form-control fs-4" type="text" name="last_name" id="last_name">
                        <label for="first_name">Prénom</label>
                        <input class="form-control fs-4" type="text" name="first_name" id="first_name">
                        <label for="email">Adresse email</label>
                        <input class="form-control fs-4" type="email" name="email" id="email">
                        <label for="password">Mot de passe</label>
                        <input class="form-control fs-4" type="password" name="password" id="password">
                        <!-- <div class=""> -->
                        <label for="isAdmin">Rôle Administrateur</label>
                        <input class="form-check-input bg-info" type="checkbox" id="isAdmin" name="isAdmin">
                        <!-- </div> -->
                        <button type="submit" name="submit" class="btn btn-success w-100 mt-4 fs-3">ENREGISTRER</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>