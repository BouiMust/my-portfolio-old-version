<!-- Vérifie si l'user est admin en analysant les données en session -->
<?php
if (!($_SESSION['isLog'] && $_SESSION['role'] === '1')) {
    $_SESSION['error'] = 'Accès refusé.';
    header('Location: ../index.php');
    exit();
}
?>