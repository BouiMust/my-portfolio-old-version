<?php
// Ce fichier permet de récupérer, créer, modifier et supprimer un message

if (session_status() === 1) session_start();
$action = '';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}

// IMPORT FONCTIONS GENERALES
require __DIR__ . DIRECTORY_SEPARATOR . 'generalController.php';

switch ($action) {
    case 'create':
        createMessage();
        break;
    case 'update':
        updateMessage($_POST['id']);
        break;
    case 'delete':
        deleteMessage($_POST['id']);
        break;
    default;
        break;
}

// FUNCTION GET ALL MESSAGES (quand on récupère toutes les compétences)
function getAllMessages()
{
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'databaseConnexion.php';
    $sql = "SELECT * FROM message";
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    $messages = mysqli_fetch_all($query, MYSQLI_ASSOC);
    function sortById($a, $b)
    {
        if ($a == $b) return 0;
        return ($a < $b) ? -1 : 1;
    }
    usort($messages, "sortById");
    return $messages;
}

// FUNCTION GET ONE MESSAGE (quand on récupère une compétence depuis son id)
function getOneMessage($id)
{
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'databaseConnexion.php';
    $sql = "SELECT * FROM message WHERE id = '$id'";
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    return mysqli_fetch_assoc($query);
}

// FUNCTION CREATE (quand on crée une compétence)
function createMessage()
{
    require __DIR__ . DIRECTORY_SEPARATOR . 'authentificationAdmin.php';

    checkMessageForm($_POST['page']);

    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'databaseConnexion.php';

    $first_name = strip_tags(addslashes(trim(ucfirst($_POST["first_name"]))));
    $last_name = strip_tags(addslashes(trim(ucfirst($_POST["last_name"]))));
    $email = strip_tags(trim(strtolower($_POST["email"])));
    $company = strip_tags(addslashes(trim(ucfirst($_POST["company"]))));
    $phone = (int)$_POST['phone'];
    $message = (int)$_POST["message"];

    $sql = "
    INSERT INTO message (first_name,last_name,email,company,phone,message)
    VALUE ('$first_name', '$last_name', '$email', '$company', '$phone', '$message')
    ";

    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    redirectWithSuccess($_POST['page'], "Le message de $first_name $last_name a été ajouté.");
}

// FONCTION UPDATE (quand on modifie une compétence)
function updateMessage($id)
{
    require __DIR__ . DIRECTORY_SEPARATOR . 'authentificationAdmin.php';

    checkMessageForm("../admin/message/updateMessage.php?id=$id");

    // CONNEXION BDD
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'databaseConnexion.php';

    // Vérifie si l'utilisateur a chargé un fichier
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

        // Vérifie si le fichier chargé est une image
        if (strtolower(explode("/", $_FILES['image']['type'])[0]) === 'image') {

            // Nomme la nouvelle image
            $newImageName = nameImage();

            // Sauvegarde la nouvelle image sur le disque
            saveImageToDisk($newImageName);

            // Supprime l'ancienne image du disque
            deleteImageFromDisk($connexion, $id);

            // Sauvegarde le nom de la nouvelle image en BDD
            $sql = "
                    UPDATE message
                    SET image = '$newImageName'
                    WHERE id = $id
                    ";
            mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
        } else {
            redirectWithError('../admin/message/createMessage.php', 'Erreur de fichier.');
        }
    }

    // On récupère toutes les données du formulaire
    $title = strip_tags(ucwords(strtolower($_POST['title'])));
    $type = (int)$_POST['type'];
    $text = $_POST['text'];
    $link = $_POST['link'];
    $active = (int)$_POST['isActive'];

    // Requête SQL pour modifier la compétence
    $sql = "
        UPDATE message
        SET title = '$title',
        type = '$type',
        text = '$text',
        link = '$link',
        active = '$active'
        WHERE id = $id
    ";

    // Envoie de la requête
    // Retourne une erreur si la requête echoue
    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    redirectWithSuccess("../admin/message/detailMessage.php?id=$id", 'Compétence modifiée.');
}

// FONCTION DELETE (quand on supprime une compétence)
function deleteMessage($id)
{
    require __DIR__ . DIRECTORY_SEPARATOR . 'authentificationAdmin.php';
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'databaseConnexion.php';
    deleteImageFromDisk($connexion, $id);
    $sql = "
    DELETE FROM message
    WHERE id = $id
    ";
    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    redirectWithSuccess('../admin/message', "Compétence n°$id supprimée.");
}

// FONCTION CHECK FORM (vérifie la validité du formulaire, prend le chemin de redirection en param, en cas d'invalidité du form)
function checkMessageForm($redirectionPath)
{
    // Vérifie si les champs obligatoires sont remplis
    if (!$_POST['last_name']) redirectWithError($redirectionPath, 'Le nom est obligatoire.');
    if (!$_POST['first_name']) redirectWithError($redirectionPath, 'Le prénom est obligatoire.');
    if (!$_POST['email']) redirectWithError($redirectionPath, 'L\'adresse email est obligatoire.');
    if (!$_POST['message']) redirectWithError($redirectionPath, 'Le message est obligatoire.');

    // Vérifie le format d'écriture de l'email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        redirectWithError($redirectionPath, 'Email non valide');
    }

    // Vérifie la longueur des caractères saisies
    if (strlen($_POST['last_name']) > 255) {
        redirectWithError($redirectionPath, 'Le nom doit comporter entre 1 et 255 caractères');
    }
    if (strlen($_POST['first_name']) > 255) {
        redirectWithError($redirectionPath, 'Le prénom doit comporter entre 1 et 255 caractères');
    }
    if (strlen($_POST['email']) > 255) {
        redirectWithError($redirectionPath, 'L\'email doit comporter entre 1 et 255 caractères');
    }
    if ($_POST['phone'] && strlen($_POST['phone']) > 255) {
        redirectWithError($redirectionPath, 'Le n° téléphone ne doit pas dépasser 255 caractères.');
    }
    if ($_POST['message'] && strlen($_POST['message']) > 255) {
        redirectWithError($redirectionPath, 'Le message ne doit pas dépasser 255 caractères.');
    }
}
