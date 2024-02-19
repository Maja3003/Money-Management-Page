<?php
    session_start();
    
    if (isset($_SESSION['pLogin1']) && $_SESSION['pLogin1'] === 1 && isset($_SESSION['pEmail1']) && $_SESSION['pEmail1'] === 1){
        echo json_encode(1);    //logujesz sie
    }
    else if(!isset($_SESSION['pEmail1']) || $_SESSION['pEmail1']==0){
        echo json_encode(2);    // nie logujesz sie bo email zly
    }
    else if(!isset($_SESSION['pLogin1']) || $_SESSION['pLogin1']==0){
        echo json_encode(0);    // nie logujesz sie bo login zly  
    }
?>