<!-- NEW SKILL (ACCES RESERVE A ADMIN UNIQUEMENT) -->
<!-- Ce fichier permet de créer une compétence qui sera sauvegardé dans la BDD -->

<?php include '../../assets/inc/back/head.php' ?>
<title>Nouvel compétence</title>

<!-- Vérifie si l'user est admin en analysant les données en session -->
<?php require '../../core/authentificationAdmin.php' ?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Ajouter une compétence</h4>
    </div>
    <div style="border: 2px solid #666;">
        <div class="col-5 mx-auto py-3">
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            };
            ?>
            <form action="../../core/skillController.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="action" value="create">
                <!-- TITLE -->
                <div>
                    <label for="title">Titre :</label>
                    <input class="form-control pointer border border-dark" type="text" name="title" id="title">
                </div>

                <!-- TYPE -->
                <div class="d-flex mx-auto justify-content-evenly mt-3">
                    <div class="form-check form-switch">
                        <label class="form-check-label pointer" for="front-end">
                            Front-end
                        </label>
                        <input class="form-check-input pointer border border-dark" type="radio" name="type" id="front-end" value="1">
                    </div>
                    <div class="form-check form-switch">
                        <label class="form-check-label pointer" for="back-end">
                            Back-end
                        </label>
                        <input class="form-check-input pointer border border-dark" type="radio" name="type" id="back-end" value="2">
                    </div>
                </div>

                <!-- TEXT -->
                <div class="my-2">
                    <label for="text">Description :</label>
                    <textarea class="form-control pointer border border-dark" name="text" id="text" rows="3"></textarea>
                </div>

                <!-- LINK -->
                <div class="my-2">
                    <label for="link">Lien :</label>
                    <input class="form-control pointer border border-dark" type="text" name="link" id="link">
                </div>

                <!-- IMAGE -->
                <div class="my-2 pointer">
                    <label for="image">Charger une image :</label>
                    <input class="form-control pointer border border-dark" type="file" name="image" id="image">
                </div>

                <!-- ACTIVE -->
                <div class="text-center my-3">
                    <label for="isActive">Activer la compétence ?</label>
                    <select class='pointer' style='padding: 10px;' name='isActive' id='isActive'>
                        <option value=1>Activer</option>
                        <option value=2>Désactiver</option>
                    </select>
                </div>

                <!-- SUBMIT BUTTON -->
                <button type="submit" name="submit" class="btn btn-success border border-dark w-100">ENREGISTRER</button>
            </form>
        </div>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>