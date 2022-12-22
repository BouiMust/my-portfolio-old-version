<!-- Vérifie si l'utilisateur est admin, en analysant les données en session -->
<?php
if (!($_SESSION['isLog'] && $_SESSION['role'] === '1')) {
    $_SESSION['message'] = '<p class="alert alert-danger fs-5 text-center p-1">Accès refusé.</p>';
    header('Location: ../index.php');
    exit();
}
?>