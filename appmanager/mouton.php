<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/appmanager/mouton.css">
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
    function pretyDump($data){
    highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
}


    $telephone = new Telephone($db);
    $enclos = $telephone->getEnclos($_GET['enclos']);
    $telephone->getAnimalFromEnclosure($enclos);
    foreach ($enclos->getAnimals() as $key => $mouton) {
  echo '
   <a href="fullscreen.php?id='.$mouton->getId().'&enclos='. $enclos->getId().'">
    <div class="item animal'.$key.'">
      <div class="col2">
        <p class="carte">Nom : '. $mouton->getName(). ' </p>
        <p class="carte">Poid : '. $mouton->getPoid(). ' </p>
        <p class="carte">Taille : '. $mouton->getTaille(). ' </p>
      </div>
      ';
      if ($mouton->getRace() == "Mouton") {
    echo '<img class="mouton" src="../img/objets/moutons.png">';
} else if ($mouton->getRace() == "Poulet") {
    echo '<img class="mouton" src="../img/objets/poulet.png">';
} else if ($mouton->getRace() == "Renard") {
    echo '<img class="mouton" src="../img/objets/renard.png">';
}else if ($mouton->getImgid() == null) {
    echo '<img class="mouton" src="../img/stop.png">';
} else if ($mouton->getRace() == "Poissons") {
    echo '<img class="moutons" src="../img/objets/poissons/poisson'.$mouton->getImgid().'.png">';
}  else {
    echo '<p>Aucune image disponible pour cet enclos</p>';
};
   echo ' </div>
    </a>';
}
?>

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
</body>
</html>