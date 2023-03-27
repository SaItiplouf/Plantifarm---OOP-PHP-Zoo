<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="shortcut icon" href="../favicon/favicon.png">

    <title>Document</title>
</head>

<body>
    <div id="wrapper">
        <div id="mouse"></div>
        <div class="loader">
        </div>
        <div class="loading-bar">
            <div class="progress-bar"></div>
        </div>
        <div class="status">
            <div class="state"></div>
            <div class="percentage"></div>
        </div>
    </div>
    <script>
        // Récupérer l'URL de la page précédente
        var previousPage = document.referrer;
        console.log(previousPage);

        if (previousPage.includes("index.php")) {
            setTimeout(function () {
                window.location.href = "./parcourir.php?enclos=1";
            }, 5500);
        } else if (previousPage.includes("parcourir.php?enclos=1")) {
            setTimeout(function () {
                window.location.href = "parcourir.php?enclos=2";
            }, 5500);
        }
        else if (previousPage.includes("parcourir.php?enclos=2")) {
            setTimeout(function () {
                window.location.href = "parcourir.php?enclos=3";
            }, 5500);
        }
        else if (previousPage.includes("parcourir.php?enclos=3")) {
            setTimeout(function () {
                window.location.href = "parcourir.php?enclos=4";
            }, 5500);
        } else {
            setTimeout(function () {
                window.location.href = "parcourir.php?enclos=1";
            }, 5500);
        }
    </script>
</body>

</html>