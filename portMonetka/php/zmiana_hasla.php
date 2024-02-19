<?php
    session_start();
    require("../php/connect.php");

    if (isset($_SESSION['czyZalogowany']) && $_SESSION['czyZalogowany'] == True){    

        $login = $_SESSION['zalogowany_user'];
        $stare_haslo = $_POST['oldPassword'];
        $nowe_haslo = $_POST['newPassword'];


        $sql_haslo = "SELECT PASSWORD FROM users WHERE PASSWORD = '$stare_haslo'";
        $result_haslo = $conn->query($sql_haslo);
        
        while ($row = $result_haslo->fetch_assoc()) {
            $wlasciwe_haslo = $row['PASSWORD'];
        }

        if(isset($stare_haslo) && isset($nowe_haslo)){
            if($stare_haslo == $wlasciwe_haslo){
                $sql_aktualizacja = "UPDATE `users` SET PASSWORD = '$nowe_haslo' WHERE PASSWORD = '$stare_haslo' and LOGIN = '$login'";
                $result_aktualizacja=$conn->query($sql_aktualizacja);
                $_SESSION['komunikat'] = 1;
            } else {
                $_SESSION['komunikat'] = 0;
            }
        }
    }   
?>