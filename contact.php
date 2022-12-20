<!-- PAGE INDEX -->

<?php require_once './assets/inc/front/head.php' ?>
<title>Contact</title>

<?php
if (isset($_POST['submit'])) {
    if ($_POST['name'] && $_POST['email'] && $_POST['message']) {
        $_SESSION["message"] = 'Votre formulaire a été envoyé.';
    } else {
        $_SESSION["error"] = 'Veuillez remplir tous les champs';
    }
    header('Location: ./contact.php');
    exit();
}
?>

<body>

    <?php require_once './assets/inc/front/header.php' ?>

    <main>
        <div class="bg-dark mb-2" style="border: 2px solid #666;">
            <h4 class="text-center pt-2">&#x260E; CONTACT &#x260E;</h4>
        </div>
        <div class="card bg-dark mx-auto" style="border: 2px solid #666;">
            <div class="card-body">
                <p class="card-text text-center">Vous avez des questions ou vous souhaitez simplement me contacter ? Remplissez ce formulaire.</p>
                <?php
                if (isset($_SESSION["message"])) {
                    echo '<p class="alert alert-success fs-5 text-center p-1 w-50 mx-auto">' . $_SESSION["message"] . '</p>';
                    unset($_SESSION["message"]);
                }
                if (isset($_SESSION['error'])) {
                    echo '<p class="alert alert-danger fs-5 text-center p-1 w-50 mx-auto">' . $_SESSION["error"] . '</p>';
                    unset($_SESSION["error"]);
                };
                ?>
                <form action="" method="post" style="width:40%" class="form-group mx-auto">
                    <label for="name">Nom :</label>
                    <input class="form-control my-2" type="text" name="name" id="name">
                    <label for="email">Adresse email :</label>
                    <input class="form-control my-2" type="email" name="email" id="email">
                    <label for="message">Message :</label>
                    <textarea class="form-control my-2" name="message" id="message" rows="4" placeholder="Votre message"></textarea>
                    <button type="submit" name="submit" class="btn btn-success w-100 my-2">ENVOYER</button>
                </form>
            </div>
        </div>
    </main>

    <?php require_once './assets/inc/front/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>