<?php
    session_start();


    if (isset($_SESSION['czyZalogowany']) && $_SESSION['czyZalogowany'] == TRUE){
        echo json_encode(1);
    }
    else{
        echo json_encode(0);
    }
?>