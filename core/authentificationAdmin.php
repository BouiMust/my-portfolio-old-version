<!-- Vérifie si l'utilisateur est admin, en analysant les données en session -->
<?php
if (!($_SESSION['isLog'] && $_SESSION['role'] === '1')) {
    $_SESSION['message'] = '<p class="alert alert-danger fs-5 text-center p-1">Accès refusé : vous n\'avez pas les droits d\'administrateur.</p>';
    exit(header('Location: http://localhost/portfolio/'));
}
?>