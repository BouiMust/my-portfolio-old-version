<?php
// Ce fichier permet de récupérer, créer, modifier et supprimer une compétence

if (session_status() === 1) session_start();
$action = '';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}

switch ($action) {
    case 'create':
        createSkill();
        break;
        // case 'update':
        //     updateSkill();
        //     break;
        // case 'delete':
        //     deleteSkill();
        //     break;
        // default;
        //     break;
}

// FUNCTION CREATE (quand on crée un utilisateur)
function createSkill()
{
    // Vérifie si les champs obligatoires du formulaire sont remplis
    if (!$_POST['title']) {
        redirectWithError('../admin/createSkill.php', 'Le titre est obligatoire.');
    }
    if (!$_POST['type']) {
        redirectWithError('../admin/createSkill.php', 'Le type est obligatoire.');
    }

    // Vérifie la longueur des caractères saisies
    if (strlen($_POST['title']) > 255) {
        redirectWithError('../admin/createSkill.php', 'Le titre ne doit pas dépasser 255 caractères.');
    }
    if ($_POST['text'] && strlen($_POST['text']) > 255) {
        redirectWithError('../admin/createSkill.php', 'Le texte ne doit pas dépasser 255 caractères.');
    }
    if ($_POST['link'] && strlen($_POST['link']) > 255) {
        redirectWithError('../admin/createSkill.php', 'Le lien ne doit pas dépasser 255 caractères.');
    }

    // Vérifie la valeur du type
    if ($_POST['type'] !== '1' && $_POST['type'] !== '2') {
        redirectWithError('../admin/createSkill.php', 'Le type n\'est pas défini.');
    }

    // Aucun nom d'image de base
    $imageName = '';

    // Vérifie si l'utilisateur a chargé un fichier
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

        // Vérifie si le fichier chargé est une image
        if (strtolower(explode("/", $_FILES['image']['type'])[0]) === 'image') {
            $imageName = nameImage();
            saveImage(nameImage());
        } else {
            redirectWithError('../admin/createSkill.php', 'Erreur de fichier.');
        }
    }

    // CONNEXION BDD
    require_once '../core/databaseConnexion.php';

    // On récupère toutes les données du formulaire
    $title = strip_tags(ucwords(strtolower($_POST['title'])));
    $type = (int)$_POST['type'];
    $text = $_POST['text'];
    $image = $imageName;
    $link = $_POST['link'];
    $active = (int)2; // Non active
    if (isset($_POST['isActive'])) {
        $active = (int)1; // Active
    }

    // Création de la requête SQL avec les données ci-dessus
    $sql = "
    INSERT INTO skill (title,type,text,image,link,active)
    VALUE ('$title', '$type', '$text', '$image', '$link', '$active')
    ";

    // Envoie de la requête. Retourne une erreur si echoue
    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    redirectWithSuccess('../admin/manageSkills.php', "La compétence '$title' est ajoutée à la base de données.");
}

// FUNCTION READ ALL USERS (quand on récupère tous les utilisateurs)
function readAllSkills()
{
}

// FUNCTION READ ONE USER (quand on récupère un utilisateur depuis son id)
function readOneSkill($id)
{
}

// FONCTION UPDATE (quand on modifie un utilisateur)
function updateSkill()
{
}

// FONCTION DELETE (quand on supprime un utilisateur)
function deleteSkill()
{
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

// FONCTION DE NOMMAGE DE L'IMAGE (nomme l'image chargé)
function nameImage()
{
    // NOUVEAU NOM DE L'IMAGE
    $imageName = explode(".", $_FILES['image']['name'])[0] . '_' . uniqid() . '.' . explode("/", $_FILES['image']['type'])[1];

    // SI EXTENSION 'SVG+XML'
    if (strstr($imageName, "+xml")) {
        $imageName = explode("+xml", $imageName)[0];
    }

    // RETOURNE LE NOUVEAU NOM DE L'IMAGE
    return $imageName;
}

// FONCTION DE SAUVEGARDE DE L'IMAGE (sauvegarde l'image chargé dans le dossier 'upload')
function saveImage($imageName)
{
    // SAUVEGARDE L'IMAGE
    // prend 2 params : chemin du fichier source et chemin + nom de sauvegarde dans le back
    $imagePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
}
