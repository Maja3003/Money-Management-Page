<?php
session_start();

$_SESSION['pLogin1'] = False; 
$_SESSION['pEmail1'] = False; 

require("connect.php");
        
    $login = $_POST['login_rejestracja'];
    $haslo = $_POST['haslo_rejestracja'];
    $email = $_POST['email_rejestracja'];

    // //SPRAWDZANIE CZY LOGIN ISTNIEJE
    $checkLoginCount = "SELECT LOGIN FROM users WHERE login ='$login';";
    $check_login=$conn->query($checkLoginCount);

    $loginRows=mysqli_num_rows($check_login);


    //SPRAWDZANIE CZY EMAIL ISTNIEJE
    $checkMailCount = "SELECT EMAIL FROM users WHERE email = '$email';";
    $checkMail=$conn->query($checkMailCount);

    $mailRows = mysqli_num_rows($checkMail);
        
    if($loginRows > 0){
        $_SESSION['pLogin1'] = 0;
    }
    else{
        $_SESSION['pLogin1'] = 1;
    }

    if($mailRows > 0){
        $_SESSION['pEmail1'] = 0;
    }
    else{
        $_SESSION['pEmail1'] = 1;
    }

    if ((isset($_SESSION['pLogin1']) && $_SESSION['pLogin1'] === 1) && (isset($_SESSION['pEmail1']) && $_SESSION['pEmail1'] === 1)){
        $sql="INSERT INTO `users` (`ID`, `LOGIN`, `PASSWORD`, `EMAIL`) VALUES (NULL, '$login', '$haslo', '$email');";
        $result= $conn->query($sql);
    }

$conn->close();
?>