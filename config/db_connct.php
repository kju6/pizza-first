<?php
    $conn = mysqli_connect("localhost", "abood", "Abood@511966", "doze_pizza");
    if (!$conn) {
     echo 'connection error: ' . mysqli_connect_error();
    }

?>