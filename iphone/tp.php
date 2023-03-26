<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/teleport.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    
    <div class=iphonecontainer>
       <img src="../img/iphone.png" class="iphoneon">
       <div id="app-parent">
<div id="app">
  <div class="item-list">
    <ul>
    <div class="item-row">
       <li class="item"><img class="item-image" src="../img/moutonappbg.png" onclick="redirectImage('../parcourir.php?enclos=1')"/></li>
    <li class="item"><img class="item-image" src="../img/poissonappbg.png" onclick="redirectImage('../parcourir.php?enclos=2')"/></li>
    </div>
    <div class="item-row">
        <li class="item"><img class="item-image" src="../img/foretappbg.png" onclick="redirectImage('../parcourir.php?enclos=4')"/></li>
    <li class="item"><img class="item-image" src="../img/pouletappbg.png" onclick="redirectImage('../parcourir.php?enclos=3')"/></li>
    </div>
    </ul>
  </div>
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
<script>
function redirectImage(page) {
    top.location.href = page;
}
</script>
</html>
