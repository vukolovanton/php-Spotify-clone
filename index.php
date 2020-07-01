<?php include ("includes/header.php") ?>

<h1 class="pageHeadingBig">You might also like</h1>
<div class="gridViewContainer">
    <?php
        $query = "SELECT * FROM albums ORDER BY RAND() LIMIT 10";
        $albumQuery = mysqli_query($conn, $query);

        while($row = mysqli_fetch_array($albumQuery)) {
            
            echo "
                <div class='gridViewItem'>
                    <a href='album.php?id=" . $row['id'] . "'>
                        <img src='" . $row['artworkPath'] . "'>
                        <div class='gridViewInfo'>
                        " . $row['title'] . "
                        </div>
                    </a>
                </div>
            ";
        }
    ?>
</div>

<?php include ("includes/footer.php") ?>