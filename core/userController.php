<?php
// Ce fichier permet de :
// - logger l'user en récupérant les champs du formulaire admin/index.php
// - deconnecter l'user en cliquant le bouton 'deconnecter'

// Démarre la session si aucune existe
if (session_status() === 1) session_start();

// Aucune action n'est programmée au départ (on initialise la var)
$action = '';

// Vérifie si la clé 'action' est présente dans $_POST (contient la nature de l'action dans la value du input hidden)
if (isset($_POST['action'])) {
    // On récupère la valeur et on la sauvegarde dans $action
    $action = $_POST['action'];
}

// Execute une fonction selon la nature de l'action
switch ($action) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    case 'create':
        createUser();
        break;
    case 'update':
        updateUser();
        break;
    case 'delete':
        deleteUser();
        break;
    default;
        break;
}

// FONCTION LOGIN (quand l'utilisateur se connecte)
function login()
{
    // Vérifie si un des champs est vide
    if (!$_POST['email'] || !$_POST['password']) {
        redirectWithError('../admin/index.php', 'Veuillez remplir tous les champs.');
    }

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
        redirectWithError('../admin/index.php', 'Aucun compte ne correspond.');
    }

    // Sinon on met sous forme de tableau associatif les données de l'admin récupérés
    $user = mysqli_fetch_assoc($query);

    // Vérification password
    if (!password_verify(trim($_POST['password']), $user['password'])) {
        redirectWithError('../admin/index.php', 'Mot de pase incorrect.');
    }

    // Vérification role (1 = Admin)
    // if ((int)$user['role'] !== 1) {
    //     var_dump('ok');
    //     exit;
    //     redirectWithError('../index.php', 'Accès refusé.');
    // }

    // Sinon la connexion est réussie
    // on sauvegarde des données dans la session (qui permettent de donner accès au back-office)
    // puis redirige l'admin au tableau de bord
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['isLog'] = true;
    $_SESSION['role'] = $user['role'];
    redirectWithSuccess('../admin/dashboardAdmin.php', "Bonjour {$user['first_name']} {$user['last_name']}.");
}

// FONCTION LOGOUT (quand l'utilisateur se déconnecte)
function logout()
{
    // supprime la session courante et toutes les données en session
    session_destroy();
    session_start();
    redirectWithSuccess('../index.php', 'Vous vous êtes déconnecté.');
}

// FUNCTION READ ALL USERS (quand on récupère tous les utilisateurs)
function readAllUsers()
{
    // Fichier databaseConnexion.php requis pour la connexion à la BDD
    require '../core/databaseConnexion.php';

    // Préparation de la requête : Récupérer toutes les lignes de la table user
    $sql = "SELECT * FROM user";

    // Execution de la requête avec les params de connexion et sauvegarde la reponse dans $query
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    // Retourne sous forme de tableau associatif toutes les données de la table user
    return  mysqli_fetch_all($query, MYSQLI_ASSOC);
}

// FUNCTION READ ONE USER (quand on récupère un utilisateur depuis son id)
function readOneUser($id)
{
    // Fichier databaseConnexion.php requis pour la connexion à la BDD
    require '../core/databaseConnexion.php';

    // Préparation de la requête : Récupère la ligne correspondant à l'id dans la table user
    $sql = "SELECT * FROM user WHERE id = '$id'";

    // Execution de la requête avec les params de connexion et sauvegarde la reponse dans $query
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    // Retourn les données sous forme de tableau associatif et exploitable
    return mysqli_fetch_assoc($query);
}

// FUNCTION COUNT ALL USERS (quand on compte le nombre total d'utilisateurs)
function countAllUsers()
{
    // Fichier requis pour la connexion à la BDD
    require '../core/databaseConnexion.php';

    // Préparation de la requête : Récupèrer toutes les lignes de la table user
    $sql = "SELECT * FROM user";

    // Execution de la requête avec les params de connexion et sauvegarde la reponse dans $query
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    // Compte le nombre de lignes obtenus
    return mysqli_num_rows($query);
}

// FUNCTION CREATE (quand on crée un utilisateur)
function createUser()
{
    // Vérifie si tous les champs du formulaire sont remplis
    if (!$_POST['last_name'] || !$_POST['first_name'] || !$_POST['email'] || !$_POST['password']) {
        redirectWithError('../admin/createUser.php', 'Veuillez remplir tous les champs.');
    }

    // Vérifie la longueur des caractères saisies
    if (strlen($_POST['last_name']) > 255) {
        redirectWithError('../admin/createUser.php', 'Le nom doit comporter entre 1 et 255 caractères.');
    }
    if (strlen($_POST['first_name']) > 255) {
        redirectWithError('../admin/createUser.php', 'Le prénom doit comporter entre 1 et 255 caractères.');
    }
    if (strlen($_POST['email']) > 255) {
        redirectWithError('../admin/createUser.php', 'L\'email doit comporter entre 1 et 255 caractères.');
    }
    if (strlen($_POST['password']) > 255) {
        redirectWithError('../admin/createUser.php', 'Le mot de passe doit comporter entre 1 et 255 caractères.');
    }

    // Vérifie le format d'écriture de l'email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        redirectWithError('../admin/createUser.php', 'Email non valide');
    }

    // on récupère le fichier de connexion databaseConnexion.php qui correspond aux params de connexion de la bdd
    require_once '../core/databaseConnexion.php';

    // addslashes prend en compte les caract spec, trim supprime les espaces, ucfirst met la 1ere lettre en maj
    // strtolower pour mettre en min
    $first_name = strip_tags(addslashes(trim(ucfirst($_POST["first_name"]))));
    $last_name = strip_tags(addslashes(trim(ucfirst($_POST["last_name"]))));
    $email = strip_tags(trim(strtolower($_POST["email"])));
    $password = strip_tags(password_hash(trim($_POST['password']), PASSWORD_BCRYPT, ['cost' => 12]));
    $role = (int)2; // ROLE 2 = ROLE UTILISATEUR LAMBDA (DE BASE)
    if (isset($_POST["isAdmin"])) {
        $role = (int)1; // ROLE 1 = ROLE ADMIN
    }

    // Création de la requête SQL pour enregistrer l'utilisateur
    $sql = "
    INSERT INTO user (first_name,last_name,email,password,role)
    VALUE ('$first_name', '$last_name', '$email', '$password', '$role')
    ";

    // Envoie de la requête avec les params de connexion du fichier databaseConnexion.php
    // Retourne une erreur si la requête echoue
    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    redirectWithSuccess('../admin/manageUsers.php', "L'utilisateur $first_name $last_name est ajouté à la base de données.");
}

// FONCTION UPDATE (quand on modifie un utilisateur)
function updateUser()
{
    require './authentificationAdmin.php';

    // Vérifie si tous les champs du formulaire sont remplis
    if (!$_POST['last_name'] || !$_POST['first_name'] || !$_POST['email'] || !$_POST['role'] || !$_POST['password']) {
        redirectWithError("../admin/updateUser.php?id={$_POST['id']}", 'Veuillez remplir tous les champs.');
    }

    // Vérifie la longueur des caractères saisies
    if (strlen($_POST['last_name']) > 255) {
        redirectWithError("../admin/updateUser.php?id={$_POST['id']}", 'Le nom doit comporter entre 1 et 255 caractères');
    }
    if (strlen($_POST['first_name']) > 255) {
        redirectWithError("../admin/updateUser.php?id={$_POST['id']}", 'Le prénom doit comporter entre 1 et 255 caractères');
    }
    if (strlen($_POST['email']) > 255) {
        redirectWithError("../admin/updateUser.php?id={$_POST['id']}", 'L\'email doit comporter entre 1 et 255 caractères');
    }
    if (strlen($_POST['password']) > 255) {
        redirectWithError("../admin/updateUser.php?id={$_POST['id']}", 'Le nom doit comporter entre 1 et 255 caractères');
    }

    // Vérifie le format d'écriture de l'email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        redirectWithError("../admin/updateUser.php?id={$_POST['id']}", 'Email non valide');
    }

    // Vérifie si le rôle est bien défini
    if ($_POST['role'] !== '1' && $_POST['role'] !== '2') {
        redirectWithError("../admin/updateUser.php?id={$_POST['id']}", 'Le rôle n\'est pas défini.');
    }

    // Récupère le fichier de connexion database
    require_once '../core/databaseConnexion.php';

    // addslashes prend en compte les caract spec, trim supprime les espaces, ucfirst met la 1ere lettre en maj
    // strtolower pour mettre en min
    $first_name = strip_tags(addslashes(trim(ucfirst($_POST["first_name"]))));
    $last_name = strip_tags(addslashes(trim(ucfirst($_POST["last_name"]))));
    $email = strip_tags(trim(strtolower($_POST["email"])));
    $password = strip_tags(password_hash(trim($_POST['password']), PASSWORD_BCRYPT, ['cost' => 12]));
    $role = (int)$_POST["role"];

    // Requête SQL pour modifier l'utilisateur
    $sql = "
        UPDATE user
        SET first_name = '$first_name',
        last_name = '$last_name',
        email = '$email',
        password = '$password',
        role = '$role'
        WHERE id = {$_POST['id']}
    ";

    // Envoie de la requête
    // Retourne une erreur si la requête echoue
    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    redirectWithSuccess("../admin/detailUser.php?id={$_POST['id']}", 'Compte utilisateur modifié.');
}

// FONCTION DELETE (quand on supprime un utilisateur)
function deleteUser()
{
    require './authentificationAdmin.php';

    require_once '../core/databaseConnexion.php';

    // Préparation de la requête : Récupère la ligne correspondant à l'id dans la table user
    $sql = "SELECT * FROM user WHERE id = '{$_POST["id"]}'";
    // Execution de la requête avec les params de connexion et sauvegarde la reponse dans $query
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    $user = mysqli_fetch_assoc($query);

    // Vérifie si le compte à supprimer est Admin
    if ($user['role'] === '1') {
        redirectWithError('../admin/manageUsers.php', 'Vous ne pouvez pas supprimer un compte administrateur.');
    } else {
        // Requête SQL pour supprimer l'utilisateur
        $sql = "
            DELETE FROM user
            WHERE id = {$_POST['id']}
        ";

        // Execution de la requête ou retourne erreur
        mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

        redirectWithSuccess('../admin/manageUsers.php', "Compte utilisateur n°{$_POST['id']} supprimé.");
    }
}

// FONCTION REDIRECTION AVEC SUCCES (redirige l'utilisateur avec un message de succès)
function redirectWithSuccess($path, $message)
{
    $_SESSION['message'] = "<p class='alert alert-success fs-5 text-center p-1'>$message</p>";
    header("Location: $path");
    exit;
}

// FONCTION REDIRECTION AVEC ERREUR (redirige l'utilisateur avec un message d'erreur)
function redirectWithError($path, $error)
{
    $_SESSION['message'] = "<p class='alert alert-danger fs-5 text-center p-1'>$error</p>";
    header("Location: $path");
    exit;
}
