<?php
include("includes/config.php");

    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    } else {
        header("Location: register.php");
    }
?>

<html>
<head>
    <title>Welcome to Slotify!</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    <div id="nowPlayingBarContainer">
        <div id="nowPlayingBar">
            
            <div id="nowPlayingLeft">
                <div class="content">
                    <span class="albumLink">
                        <img class="albumArtwork" src="https://ae01.alicdn.com/kf/HTB1zZKTfxTI8KJjSspiq6zM4FXa2/Oct-Home-Textile-Azur-Lane-USS-Vestal-Anime-Girl-One-sided-Two-sided-Polyester-Square-Pillow.jpg" >
                    </span>
                    <div class="trackInfo">
                        <span class="trackName">
                            <span>Gay song</span>
                        </span>
                        <span class="artistName">
                            <span>AnimeLover69</span>
                        </span>
                    </div>
                </div>
            </div>

            <div id="nowPlayingCenter">
                <div class="content playerControls">
                    <div class="buttons">
                        <button class="controlButton shuffle" title="Suffle button">
                            <img src="assets/svg/027-shuffle arrows.svg" alt="Shuffle">
                        </button>

                        <button class="controlButton previous" title="Previous button">
                            <img src="assets/svg/024-previous.svg" alt="Previous">
                        </button>

                        <button class="controlButton play" title="Play button">
                            <img src="assets/svg/020-play.svg" alt="Play">
                        </button>

                        <button class="controlButton pause" title="Pause button" style="display: none;">
                            <img src="assets/svg/021-pause.svg" alt="Pause">
                        </button>

                        <button class="controlButton next" title="Next button">
                            <img src="assets/svg/023-next.svg" alt="Next">
                        </button>

                        <button class="controlButton repeat" title="Repeat button">
                            <img src="assets/svg/028-repeat.svg" alt="Repeat">
                        </button>
                    </div>
                    <div class="playbackBar">
                        <span class="progressTime current">
                            0.00
                        </span>
                        <div class="progressBar">
                            <div class="progressBarBg">
                                <div class="progress">
                                </div>
                            </div>
                        </div>
                        <span class="progressTime remaining">
                            0.00
                        </span>
                    </div>
                </div>
            </div>

            <div id="nowPlayingStart"></div>
        </div>
    </div>
</body>

</html>