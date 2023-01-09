<?php
// Ce fichier permet de récupérer, créer, modifier et supprimer un projet/une réalisation

if (session_status() === 1) session_start();
$action = '';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}

// IMPORT FONCTIONS GENERALES
require __DIR__ . DIRECTORY_SEPARATOR . 'generalController.php';

switch ($action) {
    case 'create':
        createProject();
        break;
    case 'update':
        updateProject($_POST['id']);
        break;
    case 'delete':
        deleteProject($_POST['id']);
        break;
    default;
        break;
}

// FUNCTION GET ALL PROJECTS (quand on récupère toutes les compétences)
function getAllProjects()
{
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'databaseConnexion.php';
    $sql = "SELECT * FROM project";
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    $projects = mysqli_fetch_all($query, MYSQLI_ASSOC);
    function sortById($a, $b)
    {
        if ($a == $b) return 0;
        return ($a < $b) ? -1 : 1;
    }
    usort($projects, "sortById");
    return $projects;
}

// FUNCTION GET ONE PROJECT (quand on récupère une compétence depuis son id)
function getOneProject($id)
{
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'databaseConnexion.php';
    $sql = "SELECT * FROM project WHERE id_project = '$id'";
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    return mysqli_fetch_assoc($query);
}

// FUNCTION CREATE (quand on crée une compétence)
function createProject()
{
    require __DIR__ . DIRECTORY_SEPARATOR . 'authentificationAdmin.php';

    checkProjectForm('../admin/project/createProject.php');

    // Aucun nom d'image de base
    $imageName = '';

    // Vérifie si l'utilisateur a chargé un fichier
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

        // Vérifie si le fichier chargé est une image
        if (strtolower(explode("/", $_FILES['image']['type'])[0]) === 'image') {
            $imageName = nameImage();
            saveImageToDisk($imageName);
        } else {
            redirectWithError('../admin/project/createProject.php', 'Erreur de fichier.');
        }
    }

    // CONNEXION BDD
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'databaseConnexion.php';

    // On récupère toutes les données du formulaire
    $title = strip_tags(ucwords(strtolower($_POST['title'])));
    $text = $_POST['text'];
    $date_start = $_POST['date-start'];
    $date_end = !empty($_POST['date-end']) ? $_POST['date-end'] : null;
    $image = $imageName;
    $link = $_POST['link'];
    // $active = (int)$_POST['active'];

    // Création de la requête SQL avec les données ci-dessus
    $sql = "
    INSERT INTO project (title,text, date_start, date_end, image,link)
    VALUE ('$title', '$text', '$date_start', '$date_end', '$image', '$link')
    ";

    // Envoie de la requête. Retourne une erreur si echoue
    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    redirectWithSuccess('../admin/project', "La réalisation '$title' a été ajoutée.");
}

// FONCTION UPDATE (quand on modifie une compétence)
function updateProject($id)
{
    require __DIR__ . DIRECTORY_SEPARATOR . 'authentificationAdmin.php';

    checkProjectForm("../admin/project/updateProject.php?id=$id");

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
                    UPDATE project
                    SET image = '$newImageName'
                    WHERE id = $id
                    ";
            mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
        } else {
            redirectWithError('../admin/project/createProject.php', 'Erreur de fichier.');
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
        UPDATE project
        SET title = '$title',
        type = '$type',
        text = '$text',
        link = '$link',
        active = '$active'
        WHERE id_project = $id
    ";

    // Envoie de la requête
    // Retourne une erreur si la requête echoue
    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    redirectWithSuccess("../admin/project/detailProject.php?id=$id", 'Compétence modifiée.');
}

// FONCTION DELETE (quand on supprime une compétence)
function deleteProject($id)
{
    require __DIR__ . DIRECTORY_SEPARATOR . 'authentificationAdmin.php';
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'databaseConnexion.php';
    deleteImageFromDisk($connexion, $id);
    $sql = "
    DELETE FROM project
    WHERE id_project = $id
    ";
    mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    redirectWithSuccess('../admin/project', "Compétence n°$id supprimée.");
}

// FONCTION CHECK FORM (vérifie la validité du formulaire, prend le chemin de redirection en param, en cas d'invalidité du form)
function checkProjectForm($redirectionPath)
{
    // Vérifie si les champs obligatoires sont remplis
    if (!$_POST['title']) redirectWithError($redirectionPath, 'Le titre est obligatoire.');
    if (!$_POST['date-start']) redirectWithError($redirectionPath, 'La date de début est obligatoire.');

    // Vérifie la longueur des caractères saisies
    if (strlen($_POST['title']) > 255) {
        redirectWithError($redirectionPath, 'Le titre ne doit pas dépasser 255 caractères.');
    }
    if ($_POST['text'] && strlen($_POST['text']) > 255) {
        redirectWithError($redirectionPath, 'Le texte ne doit pas dépasser 255 caractères.');
    }
    if ($_POST['link'] && strlen($_POST['link']) > 255) {
        redirectWithError($redirectionPath, 'Le lien ne doit pas dépasser 255 caractères.');
    }

    // Vérifie si le statut est bien défini
    // if ($_POST['isActive'] !== '1' && $_POST['isActive'] !== '2') {
    //     redirectWithError($redirectionPath, 'Le statut n\'est pas défini.');
    // }
}
