<!-- MESSAGE UPDATE (ADMIN UNIQUEMENT) -->
<!-- Page qui permet de modifier les infos d'un message -->

<?php include '../../assets/inc/back/head.php' ?>
<title>Modification Message</title>

<!-- Vérifie si le message connecté est Admin -->
<?php require '../../core/authentificationAdmin.php' ?>

<!-- GET ONE MESSAGE FROM DB -->
<?php
require '../../core/messageController.php';
$message = getOneMessage($_GET['id']);
?>

<?php include '../../assets/inc/back/header.php' ?>

<main>
    <div class="mb-2" style="border: 2px solid #666;">
        <h4 class="text-center pt-1">Modifier le message n°<?= $message['id'] ?></h4>
    </div>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <div class="py-2" style="border: 2px solid #666;">

        <form action="../../core/messageController.php" method="post">

            <div class="row col-8 justify-content-center mx-auto">

                <input type='hidden' name='action' value='update'>
                <input type='hidden' name='id' value='<?= $message['id'] ?>'>
                <input type="hidden" name="path" value=<?= $_SERVER['SCRIPT_NAME'] . '?id=' . $message['id'] ?>>

                <div class="col-6">
                    <div class="my-1">
                        <label for="last_name">Nom * :</label>
                        <input class="form-control pointer border border-dark" type="text" name="last_name" id="last_name" value="<?= $message['last_name'] ?>">
                    </div>
                    <div class="my-1">
                        <label for="first_name">Prénom * :</label>
                        <input class="form-control pointer border border-dark" type="text" name="first_name" id="first_name" value="<?= $message['first_name'] ?>">
                    </div>
                    <div class="my-1">
                        <label for="email">Adresse email * :</label>
                        <input class="form-control pointer border border-dark" type="email" name="email" id="email" value="<?= $message['email'] ?>">
                    </div>
                </div>

                <div class="col-6">
                    <div class="my-1">
                        <label for="company">Société :</label>
                        <input class="form-control pointer border border-dark" type="text" name="company" id="company" value="<?= $message['company'] ?>">
                    </div>
                    <div class="my-1">
                        <label for="phone">Téléphone :</label>
                        <input class="form-control pointer border border-dark" type="tel" name="phone" id="phone" value="<?= $message['phone'] ?>">
                    </div>
                </div>


                <div class="my-1">
                    <label for="message">Message * :</label>
                    <textarea class="form-control pointer border border-dark" name="message" id="message" rows="6"><?= $message['text'] ?></textarea>
                </div>

                <div class="my-3">
                    <button type="submit" name="submit" class="btn btn-success border border-dark w-100">ENREGISTRER</button>
                </div>
                <p>* : champ obligatoire</p>
            </div>
        </form>
    </div>
</main>

<?php include '../../assets/inc/back/footer.php' ?>