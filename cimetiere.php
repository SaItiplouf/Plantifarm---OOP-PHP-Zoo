<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../favicon/favicon.png">
    <link rel="stylesheet" href="css/cimetiere.css">
    <title>Document</title>
</head>

<body>
    <div id="background"></div>
    <script>
        function updateBackground() {
            let date = new Date();
            let hour = date.getHours();
            console.log(hour);
            console.log(date);
            let background = document.getElementById("background");

            if (hour >= 6 && hour < 12) {
                background.style.backgroundImage = "url(img/cimetieremid.png)";
            } else if (hour >= 12 && hour < 18) {
                background.style.backgroundImage = "url(img/cimetiereday.png)";
            } else if (hour >= 18 && hour < 24) {
                background.style.backgroundImage = "url(img/cimetierenight.png)";
            } else {
                background.style.backgroundImage = "url(img/cimetieremid.png)";
            }
        }
        setInterval(updateBackground, 1);
    </script>
    <?php
    include_once("./autoload/logo.php");
    $db = require_once("./autoload/database.php");
    require_once("./autoload/autoload.php");
    require_once("./iphone/iphone.php");
    ?>

    <div class="container">

        <?php
        $telephone = new Telephone($db);
        $enclos = $telephone->getEnclos(5);
        $telephone->getDeadAnimalFromEnclosure($enclos);
        ?>

        <?php
        foreach ($enclos->getAnimals() as $key => $data) {
            date_default_timezone_set('Europe/Paris');
            echo '
   <div class="animal animal' . $key . '" style="min-width: 5%; max-width: 12%; width:8%;">
    <div class="cartecontainer hidden">
        <p class="carte">Nom:' . $data->getName() . ' </p>
        <p class="carte">Mort: ' . (!empty($data->getDeathcause()) ? $data->getDeathcause() : 'Inconnu') . '</p>
        <p class="carte">Age:' . $data->getAge() . ' </p>
      </div>
  ';
            if ($data->getRace() == "Mouton") {
                echo '<img class="mouton" src="../img/objets/moutons' . $data->getImgid() . '.png" >';
            } else if ($data->getRace() == "Poulet") {
                echo '<img class="mouton" src="../img/objets/poulet' . $data->getImgid() . '.png" >';
            } else if ($data->getRace() == "Renard") {
                echo '<img class="mouton" src="../img/objets/renard' . $data->getImgid() . '.png" >';
            } else if ($data->getImgid() == null) {
                echo '<img class="mouton" src="../img/stop.png">';
            } else if ($data->getRace() == "Poissons") {
                echo '<img class="moutons" src="../img/objets/poissons/poisson' . $data->getImgid() . '.png">';
            } else {
                echo '<p>Aucune image disponible pour cet enclos</p>';
            }
            ;
            echo ' </div>';
        }
        ?>

        <script>
            let animaux = document.querySelectorAll('.animal');

            animaux.forEach(function (animal) {
                let cartecontainer = animal.querySelector('.cartecontainer');
                let enfants = cartecontainer.querySelectorAll('p.carte');

                animal.addEventListener('mouseover', function () {
                    console.log("La souris est passée sur l'élément");
                    enfants.forEach(function (enfant) {
                        enfant.classList.remove('hidden');
                    });
                    cartecontainer.classList.remove('hidden');
                });

                animal.addEventListener('mouseout', function () {
                    console.log("La souris a été retirée de l'élément");
                    enfants.forEach(function (enfant) {
                        enfant.classList.add('hidden');
                    });
                    cartecontainer.classList.add('hidden');
                });
            });
        </script>

    </div>

    <div class="panneau-container">
        <img class="panneau" src="./img/panneau.png">
        <div class="textpanneau">
            <p> Le cimetière contient
                <?php echo $enclos->getAnimals_amount(); ?> morts
            </p>
        </div>
    </div>


    <div class="container2">
    </div>
</body>

</html>