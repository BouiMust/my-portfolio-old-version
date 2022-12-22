<!-- NEW USER ACCOUNT (ACCES RESERVE A ADMIN UNIQUEMENT) -->
<!-- Ce fichier permet de créer un user dans la bdd  -->

<?php include '../assets/inc/back/head.php' ?>
<title>Nouvel compétence</title>

<!-- // Vérifie si l'user est admin en analysant les données en session -->
<?php require '../core/authentificationAdmin.php' ?>

<?php include '../assets/inc/back/header.php' ?>

<main>
    <div class="bg-dark mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Ajouter une compétence</h4>
    </div>
    <div class="card bg-dark" style="border: 2px solid #666;">
        <div class="col-4 mx-auto py-4">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            };
            ?>
            <form action="../core/skillController.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="action" value="create">
                <!-- TITLE -->
                <div>
                    <label for="title">Titre :</label>
                    <input class="form-control" type="text" name="title" id="title">
                </div>

                <!-- TYPE -->
                <div class="d-flex mx-auto justify-content-evenly mt-3">
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="front-end">
                            Front-end
                        </label>
                        <input class="form-check-input" type="radio" name="type" id="front-end" value="1">
                    </div>
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="back-end">
                            Back-end
                        </label>
                        <input class="form-check-input" type="radio" name="type" id="back-end" value="2">
                    </div>
                </div>

                <!-- TEXT -->
                <div class="my-2">
                    <label for="text">Texte :</label>
                    <textarea class="form-control" name="text" id="text" rows="5"></textarea>
                </div>

                <!-- LINK -->
                <div class="my-2">
                    <label for="link">Lien :</label>
                    <input class="form-control" type="text" name="link" id="link">
                </div>

                <!-- IMAGE -->
                <div class="my-2">
                    <label for="image">Charger une image :</label>
                    <input class="form-control" type="file" name="image" id="image">
                </div>

                <!-- ACTIVE -->
                <div class="d-flex justify-content-center">
                    <div class="form-check form-switch mt-3 mx-auto">
                        <label for="isActive">Activer la compétence</label>
                        <input class="form-check-input" type="checkbox" id="isActive" name="isActive">
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-success w-100 my-4">ENREGISTRER</button>
            </form>
        </div>
    </div>
</main>

<?php include '../assets/inc/back/footer.php' ?>