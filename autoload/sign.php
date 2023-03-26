
<div class="panneau-container">
    <img class="panneau" src="./img/panneau.png">
    <div class="textpanneau">
        <p> L'enclos contient <?php echo $enclos->getAnimals_amount();?> animaux</p>
        <p> Condition de l'enclos : <?php echo $enclos->getDirty(); ?>  </p>
        <p> Type de l'enclos : <?php echo $enclos->getType(); ?>  </p>
    </div>
</div>