<!-- TABLEAU DE BORD (ACCES ADMIN UNIQUEMENT) -->

<?php include '../assets/inc/back/head.php' ?>
<title>Tableau de bord</title>

<?php require '../core/authentificationAdmin.php' ?>

<?php
// COUNT DATAS FROM DB
require '../core/generalController.php';
$usersLength = countAllDatas('user');
$skillsLength = countAllDatas('skill');
$projectsLength = countAllDatas('project');
$messagesLength = countAllDatas('message');
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

        <div class="col-5 p-0 m-3 shadow text-decoration-none text-danger" style="background:#EEF;max-width:400px;transition:300ms" onmouseout="this.style.transform='scale(1)'" onmouseover="this.style.transform='scale(1.05)'">
            <a href="./user" class="text-decoration-none text-dark d-block border border-secondary h-100 w-100 pt-4 pb-3 rounded" style="background:#FEE;">
                <h5>Nombre d'utilisateurs</h5>
                <p class="fs-4"><?= $usersLength ?></p>
                <p class="btn border border-secondary shadow" style="transition:300ms" onmouseout="this.style.color='initial';this.style.background='initial'" onmouseover="this.style.color='#FFF';this.style.background='#111'">Voir la liste</p>
            </a>
        </div>

        <div class="col-5 p-0 m-3 shadow text-decoration-none text-danger" style="background:#EEF;max-width:400px;transition:300ms" onmouseout="this.style.transform='scale(1)'" onmouseover="this.style.transform='scale(1.05)'">
            <a href="./skill" class="text-decoration-none text-dark d-block border border-secondary h-100 w-100 pt-4 pb-3 rounded" style="background:#FFE;">
                <h5>Nombre de compétences</h5>
                <p class="fs-4"><?= $skillsLength ?></p>
                <p class="btn border border-secondary shadow" style="transition:300ms" onmouseout="this.style.color='initial';this.style.background='initial'" onmouseover="this.style.color='#FFF';this.style.background='#111'">Voir la liste</p>
            </a>
        </div>

        <div class="col-5 p-0 m-3 shadow text-decoration-none text-danger" style="background:#EEF;max-width:400px;transition:300ms" onmouseout="this.style.transform='scale(1)'" onmouseover="this.style.transform='scale(1.05)'">
            <a href="./project" class="text-decoration-none text-dark d-block border border-secondary h-100 w-100 pt-4 pb-3 rounded" style="background:#EFF;">
                <h5>Nombre de réalisations</h5>
                <p class="fs-4"><?= $projectsLength ?></p>
                <p class="btn border border-secondary shadow" style="transition:300ms" onmouseout="this.style.color='initial';this.style.background='initial'" onmouseover="this.style.color='#FFF';this.style.background='#111'">Voir la liste</p>
            </a>
        </div>

        <div class="col-5 p-0 m-3 shadow text-decoration-none text-danger" style="background:#EEF;max-width:400px;transition:300ms" onmouseout="this.style.transform='scale(1)'" onmouseover="this.style.transform='scale(1.05)'">
            <a href="./message" class="text-decoration-none text-dark d-block border border-secondary h-100 w-100 pt-4 pb-3 rounded" style="background:#EEF;">
                <h5>Nombre de messages</h5>
                <p class="fs-4"><?= $messagesLength ?></p>
                <p class="btn border border-secondary shadow" style="transition:300ms" onmouseout="this.style.color='initial';this.style.background='initial'" onmouseover="this.style.color='#FFF';this.style.background='#111'">Voir la liste</p>
            </a>
        </div>

    </div>
</main>

<?php include '../assets/inc/back/footer.php' ?>