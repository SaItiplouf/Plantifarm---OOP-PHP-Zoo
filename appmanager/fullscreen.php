<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/appmanager/fullscreen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <?php
    $db = require_once("../autoload/database.php");
    require_once("../autoload/autoload.php");
    ?>

    <div class=iphonecontainer>
        <img src="../img/iphone.png" class="iphoneon">
        <div id="app-parent">
            <div id="app">
                <div class="item-list">
                    <?php
                    function pretyDump($data)
                    {
                        highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
                    }
                    $idEnclos = $_GET['enclos'];

                    $telephone = new Telephone($db);
                    $enclosList = $telephone->getEnclos($idEnclos);
                    $telephone->getAnimalFromEnclosure($enclosList);

                    $id = $_GET['id'];
                    $animals = $enclosList->getAnimals();
                    $mouton = null;
                    foreach ($animals as $animal) {
                        if ($animal->getId() == $id) {
                            $mouton = $animal;
                            break;
                        }
                    }
                    if ($mouton) {
                    } else {
                        // Aucun animal trouvé avec cet ID
                        echo "Animal non trouvé avec l'ID $id";
                    }
                    // $mouton = $telephone->getAnimalById($id);

                    ?>

                    <div class="item">
                        <div class="col2">
                            <p class="carte">Nom : <?php echo $mouton->getName(); ?> </p>
                            <p class="carte">Taille : <?php echo $mouton->getTaille(); ?>cm </p>
                            <p class="carte">Race : <?php echo $mouton->getRace(); ?> </p>
                            <p class="carte">Poid : <?php echo $mouton->getPoid(); ?>kg </p>
                            <p class="carte">Vie : <?php echo $mouton->getVie(); ?>/100</p>
                            <p class="carte">Bouffe : <?php echo $mouton->getBouffe(); ?>/100</p>
                        </div>
                        <?php

                        if ($mouton->getRace() == "Mouton") {
                            echo '<img class="mouton" src="../img/objets/moutons.png">';
                        } else if ($mouton->getRace() == "Poulet") {
                            echo '<img class="mouton" src="../img/objets/poulet.png">';
                        } else if ($mouton->getRace() == "Renard") {
                            echo '<img class="mouton" src="../img/objets/renard.png">';
                        } else if ($mouton->getImgid() == null) {
                            echo '<img class="mouton" src="../img/stop.png">';
                        } else if ($mouton->getRace() == "Poissons") {
                            echo '<img class="moutons" src="../img/objets/poissons/poisson' . $mouton->getImgid() . '.png">';
                        } else {
                            echo '<p>Aucune image disponible pour cet enclos</p>';
                        }
                        ?>
                    </div>
                    <div class="food-bar">
                        <div class="base"></div>
                        <div class="remplissage"><img class="foodimg" src="../img/statutbar/feed.png"></div>
                    </div>
                    <div class="life-bar">
                        <div class="base2"></div>
                        <div class="remplissage2"><img class="vieimg" src="../img/statutbar/vie.png"></div>
                    </div>
                    <div class="button-container">


                        <form method="POST">
                            <input type="hidden" name="animal_id" class="button orange" value="<?php echo $mouton->getId(); ?>">
                            <button type="submit" class="button orange" name="food_button">Nourrir</button>
                        </form>


                        <form method="POST">
                            <input type="hidden" name="animal_id" value="<?php echo $mouton->getId(); ?>">
                            <button type="submit" class="button purple" name="kill_button">KILL</button>
                        </form>


                        <form method="POST">
                            <input type="hidden" name="enclos_id" class="button orange" value="<?php echo $idEnclos; ?>">
                            <button type="submit" class="button blue" name="dirty_button">Nettoyer enclos</button>
                        </form>

                        <form method="POST">
                            <input type="hidden" name="animal_id" value="<?php echo $mouton->getId(); ?>">
                            <select name="enclos_id">
                                <option value="1">Enclos des moutons</option>
                                <option value="2">Etang</option>
                                <option value="3">Poulailler</option>
                                <option value="4">Forêt</option>
                            </select>
                            <button type="submit" name="switch_button">Changer d'enclos</button>
                        </form>
                        <?php
                        if (isset($_POST['food_button']) && isset($_POST['animal_id'])) {
                            $animal_id = $_POST['animal_id'];
                            // Supprime l'animal de la base de données en utilisant son ID
                            $telephone->nourrir($animal_id);
                            header('Location: ../iphone/appmanager.php');

                            exit;
                        }
                        if (isset($_POST['kill_button']) && isset($_POST['animal_id'])) {
                            $animal_id = $_POST['animal_id'];
                            // Supprime l'animal de la base de données en utilisant son ID
                            $telephone->deleteAnimal($animal_id);
                            // Redirige l'utilisateur vers une page appropriée (par exemple, la liste des animaux dans l'enclos)
                            if ($idEnclos == 1) {
                                header('Location: mouton.php');
                                exit;
                            } else if ($idEnclos == 2) {
                                header('Location: poissons.php');;
                            } else if ($idEnclos == 3) {
                                header('Location: poulet.php');
                            } else if ($idEnclos == 4) {
                                header('Location: renard.php');
                            }
                            exit;
                        }

                        if (isset($_POST['dirty_button']) && isset($_POST['enclos_id'])) {
                            $enclos_id = $_POST['enclos_id'];
                            $telephone->nettoyer($enclos_id);
                            $animal_id = $id;
                            header('Location: fullscreen.php?id=' . $animal_id . '&enclos=' . $idEnclos);

                            exit;
                        }

                        if (isset($_POST['switch_button']) && isset($_POST['animal_id']) && isset($_POST['enclos_id'])) {
                            $animal_id = $_POST['animal_id'];
                            $idEnclos2 = $_POST['enclos_id'];
                            $telephone->switchAnimal($animal_id, $idEnclos2);
                            $telephone->updateEnclosAnimalCount($animal_id, $idEnclos2);
                            header('Location: fullscreen.php?id=' . $animal_id . '&enclos=' . $idEnclos2);
                            exit;
                        }
                        ?>


                    </div>
                    <div id="navigation">
                        <a href="../iphone/iphonemain.php"><i class="fa fa-home" style="color: white;" title="Accueil"></i></a>
                        <a href="javascript:history.back()"><i class="fa fa-arrow-left icon1" style="color: white;" title="Retour"></i></a>
                    </div>
                    <style>
                        .icon1 {
                            padding-left: 10vh;
                        }
                    </style>
                </div>
            </div>
        </div>
        <script>
            let foodValue = <?php echo $mouton->getBouffe(); ?>;
            let foodRemplissage = document.querySelector(".food-bar .remplissage");

            foodRemplissage.style.width = foodValue + "%";

            let lifeValue = <?php echo $mouton->getVie(); ?>;
            let lifeRemplissage = document.querySelector(".life-bar .remplissage2");

            lifeRemplissage.style.width = lifeValue + "%";
        </script>











        <style>
            .food-bar {
                position: relative;
                width: 43vh;
                height: 5vh;
                margin: 2vh;
                overflow: hidden;
            }

            .food-bar .base {
                background-image: url('../img/statutbar/feedempty.png');
                background-repeat: no-repeat;
                background-size: 100% 100%;
                width: 100%;
                height: 100%;
            }

            .food-bar .remplissage {
                position: absolute;
                top: 0;
                left: 0;
                right: auto;
                background-repeat: no-repeat;
                background-size: 100% 100%;
                width: 0;
                height: 100%;
                transition: width 0.3s ease-in-out;
            }


            .life-bar {
                position: relative;
                width: 43vh;
                height: 5vh;
                margin: 2vh;
            }

            .life-bar .base2 {
                background-image: url('../img/statutbar/vieempty.png');
                background-repeat: no-repeat;
                background-size: 100% 100%;
                width: 100%;
                height: 100%;
            }

            .life-bar .remplissage2 {
                position: absolute;
                top: 0;
                left: 0;
                background-repeat: no-repeat;
                background-size: 100% 100%;
                width: 0;
                height: 100%;
                transition: width 0.3s ease-in-out;
            }

            .button-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                max-width: 50vh;
                margin: 0 auto;
            }

            .button {
                display: inline-block;
                height: 5vh;
                width: 45vh;
                margin-bottom: 0.5vh;
                border: none;
                border-radius: 1vh;
                font-size: 18px;
                font-weight: bold;
                color: #fff;
                cursor: pointer;
            }

            .orange {
                background-color: orange;
            }

            .blue {
                background-color: purple;
            }

            .green {
                background-color: blue;
            }

            .purple {
                background-color: red;
            }
        </style>


</body>

</html>