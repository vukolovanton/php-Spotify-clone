<?php
    ob_start();
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "spotify");
    if (mysqli_connect_error()) {
        echo "FAILED TO CONNECT: " . mysqli_connect_error($conn);

    }
?>
