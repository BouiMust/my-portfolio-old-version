<!-- NEW MESSAGE (ACCES ADMIN UNIQUEMENT) -->
<!-- Ce fichier permet de créer un message  -->

<?php include '../../assets/inc/back/head.php' ?>
<title>Nouveau message</title>

<?php require '../../core/authentificationAdmin.php' ?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Ajouter un message</h4>
    </div>
    <div class="" style="border: 2px solid #666;">
        <div class="col-6 mx-auto py-3">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            };
            ?>
            <form action="../../core/messageController.php" method="post">

                <div class="row justify-content-center mx-auto">

                    <input type="hidden" name="action" value="create">

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
</main>

<?php include '../../assets/inc/back/footer.php' ?>