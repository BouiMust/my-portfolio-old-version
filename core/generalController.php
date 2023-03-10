<?php
// FONCTION REDIRECTION AVEC SUCCES (redirige l'utilisateur avec un message de succès)
function redirectWithSuccess($path, $message)
{
    $_SESSION['message'] = "<p class='alert alert-success fs-5 text-center p-1'>$message</p>";
    exit(header("Location: $path"));
}

// FONCTION REDIRECTION AVEC ERREUR (redirige l'utilisateur avec un message d'erreur)
function redirectWithError($path, $error)
{
    $_SESSION['message'] = "<p class='alert alert-danger fs-5 text-center p-1'>$error</p>";
    exit(header("Location: $path"));
}

// FUNCTION COUNT ALL DATAS (quand on compte le nombre total de lignes dans une table)
function countAllDatas($table)
{
    // Fichier requis pour la connexion à la BDD
    require '../core/databaseConnexion.php';

    // Préparation de la requête : Récupèrer toutes les lignes de la table user
    $sql = "SELECT * FROM $table";

    // Execution de la requête avec les params de connexion et sauvegarde la reponse dans $query
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));

    // Compte le nombre de lignes obtenus
    return mysqli_num_rows($query);
}

// FONCTION CAPTURE L'ERREUR SQL (quand la BDD retourne une erreur)
function catchSqlError($connexion, $redirectionPath)
{
    // Vérifie si l'erreur est liée au duplicata de l'adresse email (clé unique)
    if (mysqli_errno($connexion) === 1062 && strpos(mysqli_error($connexion), 'email')) {
        redirectWithError($redirectionPath, 'Adresse email déjà utilisée.');
    } else {
        exit(mysqli_error($connexion));
    }
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

// FONCTION DE SAUVEGARDE DE L'IMAGE SUR LE DISQUE (sauvegarde l'image dans le dossier 'upload')
function saveImageToDisk($imageName)
{
    // SAUVEGARDE L'IMAGE
    // prend 2 params : chemin du fichier source et chemin + nom de sauvegarde dans le back
    $imagePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
}

// FONCTION DE SUPPRESSION D'IMAGE DU DISQUE
function deleteImageFromDisk($connexion, $id, $table)
{
    // Récupère le nom de l'ancienne image dans la BDD
    $sql = "SELECT image FROM `$table` WHERE `id_$table` = $id";
    $query = mysqli_query($connexion, $sql) or exit(mysqli_error($connexion));
    $oldImageName = mysqli_fetch_assoc($query)['image'];
    // Supprime l'ancienne image du disque
    unlink(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . $oldImageName);
}

// TRIE UN TABLEAU
function sortById($a, $b)
{
    if ($a == $b) return 0;
    return ($a < $b) ? -1 : 1;
}
