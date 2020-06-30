<?php
    $songQuery = mysqli_query($conn, "SELECT * FROM songs ORDER BY RAND() LIMIT 10 ");
    $resultArray = array();

    while ($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    $jsonArray = json_encode($resultArray);
?>

<script>

    $(document).ready(function() {
        currentPlayList = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        setTrack(currentPlayList[0], currentPlayList, false);

        //Getting contol of progress Bar
        $(".playbackBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".playbackBar .progressBar").mousemove(function(e) {
            if(mouseDown == true) {
                timeFromOffset(e, this);
            }
        });

        $(".playbackBar .progressBar").mouseup(function(e) {
            timeFromOffset(e, this);
        });

        $(document).mouseup(function() {
            mouseDown = false;
        })
    });

    function timeFromOffset(e, progressBar) {
        var percentage = e.offsetX / $(progressBar).width() * 100;
        var seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }

    function nextSong() {
        audioElement.setTime(0);

        if(repeat) {
            audioElement.setTime(0);
            playSong();
            return;
        }

        if(currentIndex == currentPlayList.length - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }

        let trackToPlay = currentPlayList[currentIndex];
        setTrack(trackToPlay, currentPlayList, true);
    }

    function prevSong() {
        if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
            audioElement.setTime(0);
        } else {
            currentIndex = currentIndex--;
            setTrack(currentPlayList[currentIndex], currentPlayList, true);
        }
    }

    function setTrack(trackId, newPlaylist, play) {
        currentIndex = currentPlayList.indexOf(trackId);
        pauseSong();

        $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {

            const track = JSON.parse(data);
            $(".trackName span").text(track.title);

            $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
                const artist = JSON.parse(data);
                $(".artistName span").text(artist.name);
            });

            $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
                const album = JSON.parse(data);
                $(".albumLink img").attr("src", album.artworkPath);
            });

            audioElement.setTrack(track);
        });

        if (play) {
            audioElement.play();
        }
    }

    function playSong() {

        if(audioElement.audio.currentTime == 0) {
            $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id });
        }

        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }

    function pauseSong() {
        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        audioElement.pause();
    }

    function setRepeat() {
        repeat = !repeat;

        repeat ? repeat = false : repeat = true
    }

</script>

<div id="nowPlayingBar">
    
    <div id="nowPlayingLeft">
        <div class="content">
            <span class="albumLink">
                <img class="albumArtwork" src="https://ae01.alicdn.com/kf/HTB1zZKTfxTI8KJjSspiq6zM4FXa2/Oct-Home-Textile-Azur-Lane-USS-Vestal-Anime-Girl-One-sided-Two-sided-Polyester-Square-Pillow.jpg" >
            </span>
            <div class="trackInfo">
                <span class="trackName">
                    <span></span>
                </span>
                <span class="artistName">
                    <span></span>
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

                <button class="controlButton previous" title="Previous button" onclick="prevSong()">
                    <img src="assets/svg/024-previous.svg" alt="Previous">
                </button>

                <button class="controlButton play" title="Play button" onclick="playSong()">
                    <img src="assets/svg/020-play.svg" alt="Play">
                </button>

                <button class="controlButton pause" title="Pause button" style="display: none;" onclick="pasuseSong()">
                    <img src="assets/svg/021-pause.svg" alt="Pause">
                </button>

                <button class="controlButton next" title="Next button" onclick="nextSong()">
                    <img src="assets/svg/023-next.svg" alt="Next">
                </button>

                <button class="controlButton repeat" title="Repeat button" onclick="repeat()">
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