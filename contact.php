<!-- PAGE INDEX -->

<?php require_once './assets/inc/front/head.php' ?>
<title>Contact</title>

<body>

    <?php require_once './assets/inc/front/header.php' ?>

    <main>
        <div class="card bg-dark text-center mx-auto" style="border: 2px solid #666;">
            <div class="card-body">
                <h2>&#x260E; CONTACT &#x260E;</h2>
                <p class="card-text">Vous avez des questions ou souhaitez me contacter ? Remplissez ce formulaire.</p>
                <form action="" method="post" style="width:40%" class="form-group mx-auto">
                    <input class="form-control my-2" type="text" name="last_name" id="last_name" placeholder="Nom">
                    <input class="form-control my-2" type="email" name="email" id="email" placeholder="Adresse email">
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