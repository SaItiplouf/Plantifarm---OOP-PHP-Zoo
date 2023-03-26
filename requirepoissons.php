<?php
echo '
    <script>
        var container = document.querySelector(\'.container\');
        var animals = document.querySelectorAll(\'.animal\');

        var containerWidth = container.offsetWidth;
        var containerHeight = container.offsetHeight;

        var margin = 50; // marge en pixels

        for (var i = 0; i < animals.length; i++) {
            var animal = animals[i];
            var x = Math.random() * (containerWidth - animal.offsetWidth - margin * 2) + margin;
            var y = Math.random() * (containerHeight - animal.offsetHeight - margin * 2) + margin;
            var speedX = (Math.random() - 0.5) * 0.15;
            var speedY = (Math.random() - 0.5) * 0.15;

            animate(animal, x, y, speedX, speedY);
        }

        function animate(animal, x, y, speedX, speedY) {
            var posX = x;
            var posY = y;

            function update() {
                posX += speedX;
                posY += speedY;

                if (posX < margin) {
                    posX = margin;
                    speedX = -speedX;
                } else if (posX > containerWidth - animal.offsetWidth - margin) {
                    posX = containerWidth - animal.offsetWidth - margin;
                    speedX = -speedX;
                }

                if (posY < margin) {
                    posY = margin;
                    speedY = -speedY;
                } else if (posY > containerHeight - animal.offsetHeight - margin) {
                    posY = containerHeight - animal.offsetHeight - margin;
                    speedY = -speedY;
                }

                animal.style.transform = \'translate(\' + posX + \'px, \' + posY + \'px)\';

                requestAnimationFrame(update);
            }

            update();
        }
    </script>';

     $requin = 1;
    for ($i = 0; $i < $requin; $i++) {
        echo '<div class="requin"><img src="./img/objets/requin.png"></div>';
    }

    echo '<script>
        const shark = document.querySelector(\'.requin\');
        const container2 = document.querySelector(\'.container2\');

        function animateShark() {
            const sharkRect = shark.getBoundingClientRect();
            const containerRect = container2.getBoundingClientRect();

            if (sharkRect.right >= containerRect.right || sharkRect.left <= containerRect.left) {
                shark.style.animationDirection = \'reverse\';
            }

            requestAnimationFrame(animateShark);
        }

        animateShark();
    </script>';