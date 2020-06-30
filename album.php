<?php include ("includes/header.php") ?>

<?php

    if(isset($_GET['id'])) {
        $albumId = $_GET['id'];

        $album = new Album($conn, $albumId);
        $artist = $album->getArtist();

    } else {
        header("Location: index.php");
    }
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath() ?>">
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p><?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs(); ?> songs.</p>
    </div>
</div>

<div class="trackListContainer">
    <ul class="trackList">
        <?php
            $songIdArray = $album->getSongIds();
            $i = 1;

            foreach($songIdArray as $songId) {
                $albumSong = new Song($conn, $songId);
                $albumArtist = $albumSong->getArtist();

                echo "
                    <li class='trackListRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/svg/020-play.svg' onclick='setTrack(" . $albumSong->getId() . ", tempPlayList, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>

                        <div class='trackInfo'>
                            <span class='trackName'>" . $albumSong->getTitle() . "</span>
                            <span class='artistName'>" . $albumArtist->getName() . "</span>
                        </div>

                        <div class='trackDuration'>
                            <span class='duration'>". $albumSong->getDuration() . "</span>
                        </div>
                    </li>
                ";

                $i++;
            }
        ?>

        <script>
            let tempSongIds = '<?php echo json_encode($songIdArray); ?>'
            console.log(tempSongIds, 'tempSongIds')

            tempPlayList = JSON.parse(tempSongIds);
        </script>
    </ul>
</div>

<?php include ("includes/footer.php") ?>