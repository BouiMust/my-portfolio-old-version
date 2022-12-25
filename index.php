<!-- PAGE D'ACCUEIL DU PORTFOLIO -->

<?php include './assets/inc/front/head.php' ?>
<title>Portfolio</title>

<?php include './assets/inc/front/header.php' ?>

<main>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <div class="bg-dark mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-2">&#x1F4E3; MES REALISATIONS &#x1F4E3;</h4>
    </div>
    <div class="card bg-dark" style="border: 2px solid #666;">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
    </div>
    <div class="bg-dark mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-2">&#x1F3AF; MES COMPETENCES &#x1F3AF;</h4>
    </div>
    <div class="card bg-dark" style="border: 2px solid #666;">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
    </div>
    <div class="bg-dark mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-2">&#x1F3F2; MON PARCOURS &#x1F3F2;</h4>
    </div>
    <div class="card bg-dark" style="border: 2px solid #666;">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
    </div>
</main>

<?php include './assets/inc/front/footer.php' ?>