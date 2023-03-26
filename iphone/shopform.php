<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    
    <div class=iphonecontainer>
       <img src="../img/iphone.png" class="iphoneon">
       <div id="app-parent">
<div id="app2">
  <img class="amazon" src="../img/shop/amazon2.png">
  <hr id="hr"/>
 <script>
		// Ajouter un écouteur d'événements pour capturer le message envoyé par l'iframe
		window.addEventListener('message', function(event) {
			if (event.origin !== 'http://example.com') {
				return;
			}

			alert(event.data);
		}, false);
	</script>
	<form action="process.php" method="POST">
		<label for="name">Nom de l'animal:</label>
		<input type="text" name="name" required><br>

		<label for="poid">Poids de l'animal:</label>
		<input type="number" name="poid" required><br>

		<label for="age">Âge de l'animal:</label>
		<input type="number" name="age" required><br>
	    
       <input type="hidden" name="race" value="<?php
        if ($_GET['enclos'] == 1) {
        echo 'Mouton';
        } elseif ($_GET['enclos'] == 2) {
        echo 'Poissons';
        } elseif ($_GET['enclos'] == 3) {
        echo 'Poulet';
        } elseif ($_GET['enclos'] == 4) {
        echo 'Renard';
        } else {
        echo 'Autre';
        }
        ?>">
		
		

		<label for="taille">Taille de l'animal:</label>
		<input type="number" name="taille" required><br>

		<input type="hidden" name="enclos_id" value="<?php echo $_GET['enclos']; ?>">

		<input type="submit" value="Ajouter">

<div id="navigation">
  <a href="./iphonemain.php"><i class="fa fa-home" style="color: white;" title="Accueil"></i></a>
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
