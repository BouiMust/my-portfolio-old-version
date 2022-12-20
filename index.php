<!-- PAGE INDEX -->

<?php require_once './assets/inc/front/head.php' ?>
<title>Portfolio</title>

<body>

    <?php require_once './assets/inc/front/header.php' ?>

    <main>
        <?php
        if (isset($_SESSION["message"])) {
            echo '<p class="alert alert-success fs-5 text-center p-1">' . $_SESSION["message"] . '</p>';
            unset($_SESSION["message"]);
        }
        if (isset($_SESSION['error'])) {
            echo '<p class="alert alert-danger fs-5 text-center p-1">' . $_SESSION["error"] . '</p>';
            unset($_SESSION["error"]);
        };
        ?>
        <div class="card bg-dark" style="border: 2px solid #666;">
            <p>MES REALISATION</p>
            <p>MES COMPETITIONS</p>
            <p>MON PARCOURS</p>
        </div>
    </main>

    <?php require_once './assets/inc/front/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>