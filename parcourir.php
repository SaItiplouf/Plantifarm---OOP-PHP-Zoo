<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  $enclos = isset($_GET['enclos']) ? intval($_GET['enclos']) : null;

  if (!in_array($enclos, [1, 2, 3, 4])) {
    header('Location: index.php');
    exit;
  }

  $enclos = intval($_GET['enclos']); // Convertir la valeur en entier
  $css_classes = array('moutons', 'poissons', 'poulet', 'renard');
  $css = isset($css_classes[$enclos - 1]) ? $css_classes[$enclos - 1] : 'default'; // Récupérer la classe CSS correspondante ou la valeur par défaut
  echo '<link rel="stylesheet" href="css/' . $css . '.css">';
  ?>
  <title>Document</title>
</head>

<body>
  <?php
  include_once("./autoload/logo.php");
  $db = require_once("./autoload/database.php");
  require_once("./autoload/autoload.php");
  require_once("./iphone/iphone.php");
  ?>

  <?php
  $enclos = intval($_GET['enclos']); // Convertir la valeur en entier
  $img_classes = array('camion', 'moto', 'moto', 'moto'); // Classes CSS correspondantes aux différents enclos
  $changerSrc = './img/boutton4.png'; // Définition des variables pour chaque enclos
  $retirerSrc = './img/boutoncamion.png';
  $constbouton = '.camion';

  if (isset($img_classes[$enclos - 1])) { // Vérifier si l'enclos est défini dans le tableau
    $class = $img_classes[$enclos - 1]; // Récupérer la classe CSS correspondante
    echo '<img class="' . $class . '" id="monImage" src="./img/bouton' . $class . '.png" onmouseover="changerImage()" onmouseout="retirerImage()">';
    if ($enclos == 1) {
      $changerSrc = './img/boutton3.png'; // Modifier les variables selon l'enclos
    } else {
      $changerSrc = './img/boutton4.png';
    }
    $retirerSrc = './img/bouton' . $class . '.png';
    $constbouton = '.' . $class;
    include_once('./autoload/autoloadjs.php'); // Inclure le fichier js commun
  }
  ?>
  <div class="container">

    <?php

    $enclosImages = [
      1 => [
        'Bonne' => 'img/moutonsbg.png',
        'Moyen' => 'img/moutonsmoyenbg.png',
        'Mauvaise' => 'img/moutonsmauvaisbg.png'
      ],
      2 => [
        'Bonne' => 'img/poissons.png',
        'Moyen' => 'img/poissonsmoyenbg.png',
        'Mauvaise' => 'img/poissonsmauvaisbg.png'
      ],
      3 => [
        'Bonne' => 'img/pouletbg.png',
        'Moyen' => 'img/pouletmoyenbg.png',
        'Mauvaise' => 'img/pouletmauvaisbg.png'
      ],
      4 => [
        'Bonne' => 'img/renardbg.png',
        'Moyen' => 'img/renardmoyenbg.png',
        'Mauvaise' => 'img/renardmauvaisbg.png'
      ]
    ];

    if (isset($_GET['enclos']) && array_key_exists($_GET['enclos'], $enclosImages)) {
      $telephone = new Telephone($db);
      $enclos = $telephone->getEnclos($_GET['enclos']);
      $telephone->getAnimalFromEnclosure($enclos);

      $telephone->modifierProprete($enclos->getId());
      $proprete = $enclos->getDirty();


      echo "<script>
    let body = document.querySelector('body');
    let proprete = '$proprete';
    console.log(proprete);
  
    switch (proprete) {
      case 'Bonne':
        body.style.backgroundImage = 'url(\"{$enclosImages[$_GET['enclos']]['Bonne']}\")';
        break;
      case 'Moyen':
        body.style.backgroundImage = 'url(\"{$enclosImages[$_GET['enclos']]['Moyen']}\")';
        break;
      case 'Mauvaise':
        body.style.backgroundImage = 'url(\"{$enclosImages[$_GET['enclos']]['Mauvaise']}\")';
        break;
      default:
        break;
    }
  </script>";
    } else {
      Location:
      ('index.php');
    }
    ?>

    <?php
    foreach ($enclos->getAnimals() as $key => $data) {
      if ($data->getRace() != 'Poissons' && $enclos->getType() == 'Aquarium') {
        $telephone->newkill($data->getId(), 'Noyade');
      } else if ($data->getRace() == 'Poulet' && $telephone->hasRenard($enclos->getId())) {
        $telephone->newkill($data->getId(), 'Graille');
      }
      //   $updatedLastFoodUpdate = date('Y-m-d H:i:s', strtotime($data->getLastFoodUpdate()) - 60*60);
      // code update bouffe
      // $diff_hours = round((time() - strtotime($updatedLastFoodUpdate)) / (60 * 60), 1);
      date_default_timezone_set('Europe/Paris');
      // var_dump(round((time() - strtotime($data->getLastFoodUpdate())) / (60 * 60), 1));
      // var_dump(round((time() - strtotime($data->getLastFoodUpdate())) / (60 * 60), 1) * 20);
      // var_dump($data->getVie() + round((time() - strtotime($data->getLastFoodUpdate()))));

      // echo '<br> ';
      // var_dump($data->getVie());
      // var_dump($data->getBouffe());

      echo '
   <div class="animal animal' . $key . '" style="min-width: 5%; max-width: 12%; width:' . ($data->getTaille() * 0.3) . '%;">
    <div class="cartecontainer hidden">
        <p class="carte">Nom:' . $data->getName() . ' </p>
        <p class="carte">Poid:' . $data->getPoid() . ' </p>
        <p class="carte">Age:' . $data->getAge() . ' </p>
      </div>
  ';
      if ($data->getRace() == "Mouton") {
        echo '<img class="mouton" src="../img/objets/moutons' . $data->getImgid() . '.png" style="height:' . ($data->getPoid()) . 'vh; min-height: 12vh; max-height: 28vh;">';
      } else if ($data->getRace() == "Poulet") {
        echo '<img class="mouton" src="../img/objets/poulet' . $data->getImgid() . '.png" style="height:' . ($data->getPoid()) . 'vh; min-height: 12vh; max-height: 28vh;">';
      } else if ($data->getRace() == "Renard") {
        echo '<img class="mouton" src="../img/objets/renard' . $data->getImgid() . '.png" style="height:' . ($data->getPoid()) . 'vh; min-height: 12vh; max-height: 28vh;">';
      } else if ($data->getImgid() == null) {
        echo '<img class="mouton" src="../img/stop.png">';
      } else if ($data->getRace() == "Poissons") {
        echo '<img class="moutons" src="../img/objets/poissons/poisson' . $data->getImgid() . '.png">';
      } else {
        echo '<p>Aucune image disponible pour cet enclos</p>';
      };
      echo ' </div>';
    }
    ?>


    <?php
    if ($_GET['enclos'] == 2) {
      require_once('./requirepoissons.php');
    }
    ?>


    <script>
      let animaux = document.querySelectorAll('.animal');

      animaux.forEach(function(animal) {
        let cartecontainer = animal.querySelector('.cartecontainer');
        let enfants = cartecontainer.querySelectorAll('p.carte');

        animal.addEventListener('mouseover', function() {
          console.log("La souris est passée sur l'élément");
          enfants.forEach(function(enfant) {
            enfant.classList.remove('hidden');
          });
          cartecontainer.classList.remove('hidden');
        });

        animal.addEventListener('mouseout', function() {
          console.log("La souris a été retirée de l'élément");
          enfants.forEach(function(enfant) {
            enfant.classList.add('hidden');
          });
          cartecontainer.classList.add('hidden');
        });
      });
    </script>
  </div>
  <?php
  include_once("./autoload/sign.php");
  ?>

  <div class="container2">
  </div>
</body>

</html>