<!-- TABLEAU DE BORD (ACCES ADMIN UNIQUEMENT) -->

<?php include '../assets/inc/back/head.php' ?>
<title>Tableau de bord</title>

<?php require '../core/authentificationAdmin.php' ?>

<?php
// COUNT DATAS FROM DB
require '../core/generalController.php';
$usersLength = countAllDatas('user');
$skillsLength = countAllDatas('skill');
?>

<?php include '../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">TABLEAU DE BORD</h4>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <div class="row mx-auto text-center justify-content-center py-4" style="border: 2px solid #666;">
        <div class="col-5 m-3 border border-secondary shadow pt-3 pb-2" style="background:#FEE">
            <h5>Nombre d'utilisateurs inscris</h5>
            <p class="fs-3"><?= $usersLength ?></p>
            <p><a href="./user" class="btn btn-secondary" style="transition:300ms" onmouseout="this.style.filter='invert(0)';this.style.transform='scale(1)'" onmouseover="this.style.filter='invert(1)';this.style.transform='scale(1.1)'">Voir la liste</a></p>
        </div>
        <div class="col-5 m-3 border border-secondary shadow pt-3 pb-2" style="background:#FFE">
            <h5>Nombre de compétences</h5>
            <p class="fs-3"><?= $skillsLength ?></p>
            <p><a href="./skill" class="btn btn-secondary" style="transition:300ms" onmouseout="this.style.filter='invert(0)';this.style.transform='scale(1)'" onmouseover="this.style.filter='invert(1)';this.style.transform='scale(1.1)'">Voir la liste</a></p>
        </div>
        <div class="col-5 m-3 border border-secondary shadow pt-3 pb-2" style="background:#EFF">
            <h5>Nombre de réalisations</h5>
            <p class="fs-3">-</p>
            <p><a href="./project" class="btn btn-secondary" style="transition:300ms" onmouseout="this.style.filter='invert(0)';this.style.transform='scale(1)'" onmouseover="this.style.filter='invert(1)';this.style.transform='scale(1.1)'">Voir la liste</a></p>
        </div>
        <div class="col-5 m-3 border border-secondary shadow pt-3 pb-2" style="background:#EEF">
            <h5>Nombre de messages</h5>
            <p class="fs-3">-</p>
            <p><a href="./message" class="btn btn-secondary" style="transition:300ms" onmouseout="this.style.filter='invert(0)';this.style.transform='scale(1)'" onmouseover="this.style.filter='invert(1)';this.style.transform='scale(1.1)'">Voir la liste</a></p>
        </div>
    </div>
</main>

<?php include '../assets/inc/back/footer.php' ?>