<?php include ("includes/header.php") ?>

<?php
if(isset($_GET['term'])) {
    $term = urldecode($_GET['term']);
} else {
    $term = "";
}

?>

<div class="searchContainer">
    <h4>Search for an artist, album or song</h4>
    <input type="text" placeholder="Start typing..." class="searchInput" value="<?php echo $term ;?>" onfocus="this.value = this.value">
</div>

<script>
$(".searchInput").focus();

    $(function() {
    

        $(".searchInput").keyup(function() {
            clearTimeout(timer);

            timer = setTimeout(function() {
                let val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 1000)
        })
    })
</script>

<div>
    <h2>Songs</h2>
    <ul>
        <?php
            $songsQuery = mysqli_query($conn, "SELECT id FROM songs WHERE title LIKE '%$term%'");

            if(mysqli_num_rows($songsQuery) == 0) {
                echo "<span class='noResults'>No songs found matching " . $term . "</span>";
            }

            $songIdArray = array();

            while($row = mysqli_fetch_array($songsQuery)) {
                array_push($songIdArray, $row['id']);
                $albumSong = new Song($conn, $row['id']);
                $albumArtist = $albumSong->getArtist();


                echo "
                    <li class='trackListRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/svg/020-play.svg' onclick='setTrack(" . $albumSong->getId() . ", tempPlayList, true)'>
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
            }
        ?>
    </ul>
</div>

<div class="artistsContainer borderBottom">
        <h2>Artists</h2>
        <?php
            $artistsQuery = mysqli_query($conn, "SELECT id FROM artists WHERE name LIKE '$term%'");

            if(mysqli_num_rows($artistsQuery) == 0) {
                echo "<span class='noResults'>No artists found matching " . $term . "</span>";
            }

            while($row = mysqli_fetch_array($artistsQuery)) {
                $artistFound = new Artist($conn, $row['id']);

                echo "
                    <div class='searchResultRow'>
                        <div class='artistName>
                            <span>
                                " . $artistFound->getName() . "
                            </span>
                        </div>
                    </div>
                ";
            }
        ?>
</div>