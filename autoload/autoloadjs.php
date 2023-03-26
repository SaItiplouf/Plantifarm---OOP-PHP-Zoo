<script>
  function changerImage() {
    document.getElementById("monImage").src = '<?php echo $changerSrc; ?>';
  }

  function retirerImage() {
    document.getElementById("monImage").src = '<?php echo $retirerSrc; ?>';
  }
  const bouton = document.querySelector('<?php echo $constbouton; ?>');
  const contenu = document.querySelector("body");

  function zoomOut() {
    document.getElementById("monImage").style.display = "none";
    document.querySelector(".container").style.display = "none";
    document.querySelector(".container2").style.display = "none";
    document.querySelector(".panneau-container").style.display = "none";
    document.body.style.transition = "background-size 5s";
    document.body.style.backgroundSize = "100%";
    setTimeout(function() {
      document.body.style.backgroundSize = "150%";
      document.body.style.backgroundPosition = "top right";
    }, 1000);
  }
  bouton.addEventListener("click", function() {
    setTimeout(function() {
      window.location.href = "./loadingscreen.php";
    }, 2500);
    zoomOut();
  });


</script>