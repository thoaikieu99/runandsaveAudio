<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        audio {
            width: 100%;
        }

        audio::-webkit-media-controls-time-remaining-display {
            position: absolute;
            top: 0px;

        }

        .clickable-span {
            -webkit-tap-highlight-color: transparent;
            /* For iOS Safari and Chrome on mobile */
            user-select: none;
            /* Prevents text selection highlight */
            -webkit-user-select: none;
            /* For older WebKit browsers */
            -ms-user-select: none;
            /* For Internet Explorer */
            -moz-user-select: none;
            /* For Firefox */
            outline: none !important;
            /* Removes focus outline */
            padding: 5px;
            background-color: wheat;
        }

        .clickable-span1 {
            -webkit-tap-highlight-color: transparent;
            /* For iOS Safari and Chrome on mobile */
            user-select: none;
            /* Prevents text selection highlight */
            -webkit-user-select: none;
            /* For older WebKit browsers */
            -ms-user-select: none;
            /* For Internet Explorer */
            -moz-user-select: none;
            /* For Firefox */
            outline: none !important;
            /* Removes focus outline */
        }
    </style>
</head>

<body>
    <a href="./">Home</a><br>
    <?php
    $name = $_GET['name'];
    echo "Name: <span id='nameAudio' >" . preg_replace("([A-Z])", " $0",  substr($name, 0, -6)) . "</span><br>";
    ?>
    <audio id="myAudio" controls controlslist="nofullscreen nodownload noremoteplayback noplaybackrate foobar" ontimeupdate="myFunction(this)">
        <source src="./audio/<?= $name ?>" type="audio/mpeg">
    </audio>

    <p><span class="clickable-span1" id="demo"></span></p>
    <select name="cars" id="cars">
        <option value="0">1</option>
        <option value="3">1.3</option>
        <option value="4">1.4</option>
        <option value="5">1.5</option>
        <option value="6">1.6</option>
    </select>
    <select name="times" id="times">
        <option value="1">1</option>
        <option value="3">30</option>
        <option value="5">50</option>
        <option value="7">70</option>
    </select>
    <span id="timeOutt"></span>
    <div style="margin-top: 10px;">

        <span class="clickable-span" onclick="showMessage(-5)">-5</span>
        <span onclick="showMessage(-3)" class="clickable-span">-3</span>
        <span onclick="showMessage(-0.5)" class="clickable-span">-0.5</span>
        <span onclick="showMessage(0.5)" class="clickable-span">+0.5</span>
        <span onclick="showMessage(3)" class="clickable-span">+3</span>
        <span onclick="showMessage(5)" class="clickable-span">+5</span>
    </div>

    <script>
        function showMessage(v) {
            let audioPlayer = document.getElementById('myAudio');
            let daaa = audioPlayer.currentTime
            audioPlayer.currentTime = daaa + v * 60
        }


        function myTimer() {

            document.getElementById("timeOutt").innerHTML = covert(as);
            if (as == 0) {
                let audioPlayer = document.getElementById('myAudio');
                audioPlayer.pause();
                myStopFunction();
            }
            as--;
        }

        function myStopFunction() {
            clearInterval(myInterval);
            myInterval = null
        }
        var myInterval

        function myStartFunction() {
            myInterval = setInterval(myTimer, 1000);

        }
        var as = 1

        const mySelect = document.getElementById('times');
        mySelect.addEventListener('change', function(event) {
            let selectedValue = event.target.value;
            as = +selectedValue * 60 * 10
            if (!myInterval) {
                myStartFunction()
            }
        });



        const mySelect2 = document.getElementById('cars');
        mySelect2.addEventListener('change', function(event) {
            let selectedValue = event.target.value;
            let aa = 1 + selectedValue / 10
            let audioPlayer = document.getElementById('myAudio');
            audioPlayer.playbackRate = aa;
        });


        const myElement = document.getElementById('nameAudio');
        const innerText = myElement.innerText;
        var nameC = innerText;
        var getData = getCookie(nameC);
        if (getData) {
            document.getElementById("demo").innerHTML = covert(getData);
        }

        document.getElementById('demo').onclick = function() {
            let audioPlayer = document.getElementById('myAudio');
            audioPlayer.currentTime = getData;
            audioPlayer.play();
        }

        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function myFunction(event) {
            let crr = Math.floor(event.currentTime)
            if (crr > 0) {
                setCookie(nameC, crr, 7)
            }

        }

        function covert(totalSeconds) {
            let hours = Math.floor(totalSeconds / 3600);
            totalSeconds %= 3600;
            let minutes = Math.floor(totalSeconds / 60);
            let seconds = totalSeconds % 60;
            let time = `${hours < 10 ? "0" + hours : hours}:${
                minutes < 10 ? "0" + minutes : minutes
                }:${seconds < 10 ? "0" + seconds : seconds}`;
            return time;
        }
    </script>
</body>

</html>