<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Plantifarm</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>



    <?php 
 include_once ("./autoload/logo.php");
 require_once("./iphone/iphone.php");
 ?>
<img class="tracteur" id="monImage" src="./img/boutontracteur.png" onmouseover="changerImage()" onmouseout="retirerImage()">
<?php 
        $changerSrc="./img/boutton2.png";
        $retirerSrc="./img/boutontracteur.png";
        $constbouton=".tracteur";
        include_once("./autoload/autoloadjs.php");
    ?>
<div class="container2">
	<div class="container">
	<div class="panneau-container">
</div>
</div>
</div>
	</body>
</html>