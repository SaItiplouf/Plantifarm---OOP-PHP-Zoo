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

    <div class=iphonecontainer>
        <img src="../img/iphone.png" class="iphoneon">
        <div id="app-parent">
            <div id="app">
                <div class="item-list">
                    <?php
                    require_once("../autoload/database.php");
                    // Récupération des données du formulaire
                    $name = $_POST['name'];
                    $poid = $_POST['poid'];
                    $age = $_POST['age'];
                    $race = $_POST['race'];
                    $taille = $_POST['taille'];
                    $enclos_id = $_POST['enclos_id'];
                    $imgid = null; //initialiser la variable $imgid

                    if ($race == "Poissons") { //vérifier si la race est égale à Poissons
                        $imgid = rand(1, 22); //générer un nombre aléatoire entre 1 et 23 pour $imgid
                    } else {
                        $imgid = rand(1, 6);
                    }

                    // Requête pour récupérer le nombre d'animaux pour l'enclos spécifié
                    $stmt = $db->prepare("SELECT COUNT(*) FROM animal WHERE enclos_id = :enclos_id AND race = 'mouton'");
                    $stmt->bindParam(':enclos_id', $enclos_id);
                    $stmt->execute();
                    $animal_count = $stmt->fetchColumn();

                    // Vérification du nombre d'animaux
                    if ($animal_count < 6) {
                        // Requête pour insérer une nouvelle entrée dans la table "animaux"
                        $stmt = $db->prepare("INSERT INTO animal (name, poid, age, race, taille, enclos_id, imgid, created_at, lastfoodupdate, lastvieupdate, lastageupdate, lastfrauduleuxvieupdate) VALUES (:name, :poid, :age, :race, :taille, :enclos_id, :imgid, NOW(), NOW(), NOW(), NOW(), NOW())");
                        $stmt->bindParam(':name', $name);
                        $stmt->bindParam(':poid', $poid);
                        $stmt->bindParam(':age', $age);
                        $stmt->bindParam(':race', $race);
                        $stmt->bindParam(':taille', $taille);
                        $stmt->bindParam(':enclos_id', $enclos_id);
                        $stmt->bindParam(':imgid', $imgid); //lier la variable $imgid à la requête
                        $stmt->execute();

                        // Requête pour mettre à jour le nombre d'animaux dans la table "enclos"
                        $stmt = $db->prepare("UPDATE enclos SET animals_amount = animals_amount + 1 WHERE id = :enclos_id");
                        $stmt->bindParam(':enclos_id', $enclos_id);
                        $stmt->execute();

                        // Redirection vers la page d'accueil
                        header('Location: shop.php');
                        exit();
                    } else {
                        // Retourner un message d'erreur
                        echo "<p>Impossible d'ajouter un nouvel animal : <br> l'enclos contient déjà 6 moutons.</p>";
                    }
                    ?>
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