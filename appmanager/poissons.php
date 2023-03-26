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
    $enclos = $telephone->getEnclos(2);
    $telephone->getAnimalFromEnclosure($enclos);
    
    foreach ($enclos->getAnimals() as $key => $poisson) {
  echo '
   <a href="fullscreen.php?id='.$poisson->getId().'&enclos='. $enclos->getId().'">
    <div class="item animal'.$key.'">
      <div class="col2">
       <p class="carte">Nom : '. $poisson->getName(). ' </p>
        <p class="carte">Poid : '. $poisson->getPoid(). ' </p>
        <p class="carte">Taille : '. $poisson->getTaille(). ' </p>
        </div>
           <img class="col1 poisson" src="../img/objets/poissons/poisson'.$poisson->getImgid().'.png">
           </div> 
           </a>
  ';
}
?>
 
  <!-- <div class="item-list">
    <ul>
      <div class="item-row">
        <li class="item"><img class="item-image" src="../img/shop/fox.png"/></li>
        <li class="item"><img class="item-image" src="../img/shop/poisson.png"/></li>
      </div>
      <div class="item-row">
        <li class="item"><img class="item-image" src="../img/shop/mouton.png"/></li>
        <li class="item"><img class="item-image" src="../img/shop/poulet.png"/></li>
      </div>
    </ul>
  </div> -->
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