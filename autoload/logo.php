<div class="mobile-blackout">
  <div class="mobile-message">
    Veuillez tourner votre téléphone en mode paysage pour une meilleure expérience.
  </div>
</div>
<nav>
        <a href="index.php"><img class="logo" src="./img/artboard.png"></a>
</nav>

<style>

    .logo {
 width: 15.706806282722512vh;
    max-width: 15.706806282722512vh;
    padding-left: 4.18848167539267vh;
    padding-top: 4.18848167539267vh;
    transform: translate(0, 0);
}
@media (orientation: portrait) and (max-width: 768px) {
    .mobile-blackout {
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #000;
        z-index: 9999;
    }

    .mobile-message {
        font-size: 24px;
        color: #fff;
        text-align: center;
        padding: 20px;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.1);
    }
}

@media (orientation: landscape) or (min-width: 769px) {
    .mobile-blackout {
        display: none;
    }
}


</style>

	
