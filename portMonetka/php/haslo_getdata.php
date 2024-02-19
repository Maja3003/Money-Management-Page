<?php
    session_start();

    if (isset($_SESSION['komunikat']) && $_SESSION['komunikat'] == 1){
        echo json_encode(1);
    }
    else if(isset($_SESSION['komunikat']) && $_SESSION['komunikat'] == 0){
        echo json_encode(0);
    } else {
        echo json_encode(2);
    }
?>