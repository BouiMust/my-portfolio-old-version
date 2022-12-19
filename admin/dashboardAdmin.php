<!-- TABLEAU DE BORD ADMIN -->

<?php require_once '../assets/inc/back/head.php' ?>
<title>Tableau de bord</title>

<?php
// Vérifie si l'user est admin en analysant les données en session
if (!($_SESSION['isLog'] && $_SESSION['role'] === '1')) {
    $_SESSION['error'] = 'Accès refusé.';
    header('Location: ../index.php');
    exit();
}
?>

<body>

    <?php require_once '../assets/inc/back/header.php' ?>

    <main>
        <div class="card bg-dark" style="border: 2px solid #666;">
            <h1 class="text-center">TABLEAU DE BORD</h1>
        </div>
        <?php
        if (isset($_SESSION["message"])) {
            echo '<div class="alert alert-success fs-5 text-center">' . $_SESSION["message"] . '</div>';
            unset($_SESSION["message"]);
        };
        ?>
        <div class="card bg-dark" style="border: 2px solid #666;">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis magnam fuga beatae sit sunt dolorum, iste quae harum nulla recusandae vel amet soluta nam cumque, velit molestias numquam explicabo quo?</p>
        </div>
    </main>

    <?php require_once '../assets/inc/back/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>