<!-- PAGE D'ACCUEIL DU PORTFOLIO -->

<?php

include './assets/inc/front/head.php' ?>
<title>Portfolio</title>
<?php define('PROFILE_COLOR', ['#379', '#397', '#739', '#793', '#937', '#973']) ?>
<?php include './assets/inc/front/header.php' ?>

<?php
// GET ALL PROJECTS FROM DB
require 'core/projectController.php';
require 'core/skillController.php';
require 'core/messageController.php';
$projects = getAllProjects('active');
$skills = getAllSkills('active');
$messages = getAllMessages();
?>

<main>
    <?php
    if (isset($_SESSION['message']) && !isset($_SESSION['messageSection'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    };
    ?>
    <!-- BLOC PROJECTS -->
    <div class="my-2">

        <div class="border-bottom border-top border-dark">
            <h4 class="text-center pt-2">&#x1F4E3; MES REALISATIONS &#x1F4E3;</h4>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 p-3 justify-content-center">

            <?php foreach ($projects as $project) : ?>
                <div class="col" style="max-width:250px;">
                    <a href="<?= !empty($project['link']) ? $project['link'] : '#'; ?>" class="text-decoration-none d-block h-100 w-100 pt-2 rounded">
                        <div class="card bg-transparent h-100 border border-secondary" style="transition:300ms" onmouseout="this.style.transform='translate(0,0)'" onmouseover="this.style.transform='translate(0,-10px)'">
                            <img src="./assets/images/upload/<?= !empty($project['image']) ? $project['image'] : 'no-image.png'; ?>" class="card-img-top" alt="image de <?= $project['title'] ?>" style="max-height:200px;">
                            <div class="card-body text-white" style="background:#170046;">
                                <h5 class="card-title"><?= $project['title'] ?></h5>
                                <p class="card-text"><?= $project['text'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>

        </div>

        <!-- BLOC SKILLS -->
        <div class="my-2">

            <div class="border-bottom border-top border-dark">
                <h4 class="text-center pt-2">&#x1F3AF; MES COMPETENCES &#x1F3AF;</h4>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4 p-5 justify-content-center">
                <?php foreach ($skills as $skill) :
                    $image = !empty($skill['image']) ? $skill['image'] : 'no-image-2.png'; ?>
                    <div class="col-sm-4 " style="max-width:150px;max-height:150px;">
                        <div class="card border-warning border-top-0 border-bottom-0 border-start border-end shadow h-100 bg-transparent" style="transition:300ms" onmouseout="this.style.transform='rotate(0deg)'" onmouseover="this.style.transform='rotate(10deg)'">
                            <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">
                                <div class="icon-box icon-box--success">
                                    <img src="./assets/images/upload/<?= $skill['image'] ?>" title="<?= $skill['title'] ?>" alt="image de <?= $skill['title'] ?>" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>

        <!-- BLOC PARCOURS -->
        <div class="my-2">
            <div class="border-bottom border-top border-dark">
                <h4 class="text-center pt-2">&#x1F3F2; MON PARCOURS DEVELOPPEUR &#x1F3F2;</h4>
            </div>
            <div class="p-2 text-center">
                <h5 class="py-3">2023 : POEC Developpeur PHP</h5>
                <h5 class="py-3">2020 - 2022 : Apprentissage autodidacte</h5>
            </div>
        </div>
    </div>

    <!-- BLOC FORM MESSAGE -->
    <div id="messageForm" class="my-5 text-light bg-transparent">
        <div class="">
            <h4 class="text-center pt-1">Laisser un message</h4>
        </div>
        <div class="">
            <div class="col-6 mx-auto">
                <form action="./core/messageController.php" method="post">

                    <div class="row justify-content-center mx-auto">
                        <div>
                            <?php
                            if (isset($_SESSION['message']) && isset($_SESSION['messageSection'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                                unset($_SESSION['messageSection']);
                            };
                            ?>
                        </div>

                        <input type="hidden" name="action" value="create">
                        <input type="hidden" name="path" value=<?= $_SERVER['SCRIPT_NAME'] . '#messageForm' ?>>

                        <div class="col-6">
                            <div class="my-1">
                                <input class="form-control pointer border border-dark" type="text" name="last_name" id="last_name" placeholder="Nom *">
                            </div>
                            <div class="my-1">
                                <input class="form-control pointer border border-dark" type="text" name="first_name" id="first_name" placeholder="Pr??nom *">
                            </div>
                            <div class="my-1">
                                <input class="form-control pointer border border-dark" type="email" name="email" id="email" placeholder="Adresse email *">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="my-1">
                                <input class="form-control pointer border border-dark" type="text" name="company" id="company" placeholder="Soci??t??">
                            </div>
                            <div class="my-1">
                                <input class="form-control pointer border border-dark" type="tel" name="phone" id="phone" placeholder="T??l??phone">
                            </div>
                        </div>


                        <div class="my-1">
                            <textarea class="form-control pointer border border-dark" name="message" id="message" rows="3" placeholder="Votre message *"></textarea>
                        </div>

                        <div class="my-3 w-50">
                            <button type="submit" name="submit" class="btn btn-success border border-dark w-100">ENREGISTRER</button>
                        </div>
                        <p class="py-0 my-0">* : champ obligatoire</p>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- BLOC MESSAGES -->
    <div class="my-5 text-light bg-transparent w-50">

        <?php foreach ($messages as $message) :
            $date = implode('/', array_reverse(explode('-', explode(' ', $message['created_at'])[0])));
            $time = explode(' ', $message['created_at'])[1]; ?>
            <div class='p-2 mb-3' style="background-color: rgb(24, 0, 61, 0.5)">
                <div class="border-bottom border-secondary d-flex pb-1">
                    <div class="pe-3" style="width: max-content;">
                        <img src="./assets/images/icons/default-profile.svg" alt="photo par defaut" style="width:50px;border-radius:50%;background:<?= PROFILE_COLOR[mt_rand(0, count(PROFILE_COLOR) - 1)] ?>">
                    </div>
                    <div>
                        <p class="m-0"><?= $message['first_name'] ?> <?= $message['last_name'] ?>,</p>
                        <p class="m-0">le <?= $date ?> ?? <?= $time ?></p>
                    </div>
                </div>
                <p><?= nl2br($message['text']) ?></p>
            </div>
        <?php endforeach ?>

    </div>

</main>

<?php include './assets/inc/front/footer.php' ?>