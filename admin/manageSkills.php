<!-- MANAGE SKILLS (ADMIN UNIQUEMENT) -->

<?php include '../assets/inc/back/head.php' ?>
<title>Gestion des Compétences</title>

<?php require_once '../core/authentificationAdmin.php' ?>

<?php include '../assets/inc/back/header.php' ?>

<main>
    <div class="bg-dark mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Gestion des Compétences</h4>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <div class="card bg-dark" style="border: 2px solid #666;">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
    </div>
</main>

<?php include '../assets/inc/back/footer.php' ?>