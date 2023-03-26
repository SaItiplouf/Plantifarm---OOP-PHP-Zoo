<img src="./img/iphone.png" class="iphoneoff" id="iphone" onclick="changeClass()">
<iframe id="iphonewindow" class="iframetv"></iframe>
<script>
function changeClass() {
  const iphone = document.getElementById("iphone");
  const iphonewindow = document.getElementById("iphonewindow");
  if (iphone.classList.contains("iphoneoff")) {
    iphone.classList.remove("iphoneoff");
    iphone.classList.add("iphone");
    iphonewindow.src = "../iphone/iphonemain.php";
    iphonewindow.style.display = "block";
    iphonewindow.style.visibility = "visible";
    iphonewindow.classList.remove("iframetv");
    iphonewindow.classList.add("iframetv-all");
    document.addEventListener("click", outsideClick);
  } else {
    iphone.classList.remove("iphone");
    iphonewindow.classList.remove("iframetv-all");
    iphonewindow.classList.add("iframetv");
    iphone.classList.add("iphoneoff");
    iphonewindow.style.display = "none";
    document.removeEventListener("click", outsideClick);
  }
}

function outsideClick(e) {
  const iphone = document.getElementById("iphone");
  const iphonewindow = document.getElementById("iphonewindow");

  if (!iphone.contains(e.target) && e.target !== iphonewindow) {
    iphone.classList.remove("iphone");
    iphone.classList.add("iphoneoff");
    iphonewindow.style.display = "none";
    document.removeEventListener("click", outsideClick);
    location.reload();
  }
}
</script>

<style>

.iframetv {
    border: none;
    position: relative;
    bottom: 20vh;
    width: 100vh;
    height: 0vh;
    left: 0vh;
    z-index: 5;
    pointer-events: none;
}
.iframetv-all {
    border: none;
    position: relative;
    bottom: 20vh;
    width: 100vh;
    height: 100vh;
    left: 0vh;
    z-index: 5;
    pointer-events: all;
}

.iphoneoff {
    position: absolute;
    display: flex;
    flex-direction: column;
    justify-content: center;
    right: 0vh;
    top: 85vh;
    z-index: 2;
}

.iphone {
    display: none;
    opacity: 0;
    position: absolute;
    display: flex;
    flex-direction: column;
    justify-content: center;
    right: 0vh;
    top: 85vh;
    z-index: 2;
}
@media (max-height: 430px) {
    .iframetv {
        border: none;
        position: relative;
        bottom: 20vh;
        width: 100vh;
        height: 100vh;
        left: 0vh;

    }

    .iphoneoff {
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        right: -1vh;
        top: 86vh;
        width: 50vh;
        z-index: 2;
    }

    .iphone {
        display: none;
        opacity: 0;
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        right: 0vh;
        top: 85vh;
        z-index: 2;
    }
}

@media (max-height: 400px) {
    .iframetv {
        border: none;
        position: relative;
        bottom: 20vh;
        width: 100vh;
        height: 100vh;
        left: 0vh;
        z-index: 5;
    }

    .iphoneoff {
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        right: -1vh;
        top: 86vh;
        width: 50vh;
        z-index: 2;
    }

    .iphone {
        display: none;
        opacity: 0;
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        right: 0vh;
        top: 85vh;
        z-index: 2;
    }
}
</style>