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

    <!-- BLOC PROJECTS -->
    <div class="my-2">
        <div class="border border-dark">
            <h4 class="text-center pt-2">&#x1F4E3; MES REALISATIONS &#x1F4E3;</h4>
        </div>
        <div class="border border-dark p-2">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        </div>
    </div>

    <!-- BLOC SKILLS -->
    <div class="my-2">
        <div class="border border-dark">
            <h4 class="text-center pt-2">&#x1F3AF; MES COMPETENCES &#x1F3AF;</h4>
        </div>
        <div class="border border-dark p-2">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        </div>
    </div>

    <!-- BLOC PARCOURS -->
    <div class="my-2">
        <div class="border border-dark">
            <h4 class="text-center pt-2">&#x1F3F2; MON PARCOURS &#x1F3F2;</h4>
        </div>
        <div class="border border-dark p-2">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio fugit, </p>
        </div>
    </div>

    <!-- BLOC MESSAGES -->
    <div></div>

    <!-- BLOC NEW MESSAGE -->

    <div class="my-2">
        <div class="border border-dark">
            <h4 class="text-center pt-1">Ajouter un message</h4>
        </div>
        <div class="border border-dark">
            <div class="col-6 mx-auto py-3">
                <form action="./core/messageController.php" method="post">

                    <div class="row justify-content-center mx-auto">

                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="page" value=<?= $_SERVER['SCRIPT_NAME'] ?>>

                        <div class="col-6">
                            <div class="my-1">
                                <label for="last_name">Nom * :</label>
                                <input class="form-control pointer border border-dark" type="text" name="last_name" id="last_name">
                            </div>
                            <div class="my-1">
                                <label for="first_name">Prénom * :</label>
                                <input class="form-control pointer border border-dark" type="text" name="first_name" id="first_name">
                            </div>
                            <div class="my-1">
                                <label for="email">Adresse email * :</label>
                                <input class="form-control pointer border border-dark" type="email" name="email" id="email">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="my-1">
                                <label for="company">Société :</label>
                                <input class="form-control pointer border border-dark" type="text" name="company" id="company">
                            </div>
                            <div class="my-1">
                                <label for="phone">Téléphone :</label>
                                <input class="form-control pointer border border-dark" type="tel" name="phone" id="phone">
                            </div>
                        </div>


                        <div class="my-1">
                            <label for="message">Message * :</label>
                            <textarea class="form-control pointer border border-dark" name="message" id="message" rows="3"></textarea>
                        </div>

                        <div class="my-3">
                            <button type="submit" name="submit" class="btn btn-success border border-dark w-100">ENREGISTRER</button>
                        </div>
                        <p>* : champ obligatoire</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include './assets/inc/front/footer.php' ?>