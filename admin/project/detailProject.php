<!-- PROJECT DETAIL (ACCES ADMIN UNIQUEMENT) -->
<!-- Page qui affiche les détails sur une réalisation (depuis l'id en parametre url)-->

<?php include '../../assets/inc/back/head.php' ?>
<title>Détail réalisation</title>

<!-- Vérifie si l'utilisateur connecté est Admin -->
<?php require '../../core/authentificationAdmin.php' ?>

<!-- GET ONE PROJECT FROM DB -->
<?php
require '../../core/projectController.php';
$project = getOneProject($_GET['id']);
$text = !empty($project['text']) ? $project['text'] : '&#8211';
$image = !empty($project['image']) ? $project['image'] : 'no-image.png';
$date_start = implode('/', array_reverse(explode('-', $project['date_start'])));
$date_end = !is_null($project['date_end']) ? implode('/', array_reverse(explode('-', $project['date_end']))) : '&#8211';
$link = !empty($project['link']) ? "<a href='{$project['link']}' class='fw-bold' target='_blank'>{$project['link']}</a>" : '&#8211';
$active = $project['active'] === '1' ? 'Activé' : 'Désactivé';
?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Détails sur la réalisation n°<?= $project['id_project'] ?></h4>
    </div>
    <div class="pb-0" style="border: 2px solid #666;">

        <div class="row w-100 mx-auto my-2">

            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            };
            ?>
            <div class='col-4 ps-4 my-auto text-center'>
                <a href="http://localhost/portfolio/assets/images/upload/<?= $image ?>">
                    <img class='rounded' src='http://localhost/portfolio/assets/images/upload/<?= $image ?>' alt='image de la réalisation' width=99%>
                </a>
            </div>
            <div class="col-8">
                <table class='table table-striped table-hover text-center border border-secondary'>

                    <tr class='align-middle'>
                        <th class='text-end col-3'>Id :</th>
                        <td><?= $project['id_project'] ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Titre :</th>
                        <td class='text-break'><?= $project['title'] ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Description :</th>
                        <td class='text-break'><?= $text ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Date de début :</th>
                        <td class='text-break'><?= $date_start ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Date de fin :</th>
                        <td class='text-break'><?= $date_end ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Lien :</th>
                        <td class='text-break'><?= $link ?></td>
                    </tr>

                    <tr>
                        <th class='text-end col-3'>Statut :</th>
                        <td><?= $active ?></td>
                    </tr>

                    <tr>
                        <th></th>
                        <td class='text-center'>
                            <a href='./updateProject.php?id=<?= $project['id_project'] ?>' class="text-decoration-none" title='Modifier'>
                                <div class='btn btn-info fs-5 py-1 px-3 border border-dark'>&#128394;</div>
                            </a>
                            <a href='./confirmDeleteProject.php?id=<?= $project['id_project'] ?>' class="text-decoration-none" title='Supprimer'>
                                <div class='btn btn-danger fs-5 py-1 px-3 border border-dark'>&#128465;</div>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <a href="./" class="btn btn-success border border-dark w-100">Retour à la liste des réalisations</a>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>