<?php
session_start();
$_SESSION['czyZalogowany'] = FALSE;  

require("./connect.php");

$email = $_POST['email_logowanie'];
$haslo = $_POST['haslo_logowanie'];

$sql_email = "SELECT * FROM `users` WHERE EMAIL like '$email';";
$sql_haslo = "SELECT PASSWORD FROM `users` WHERE PASSWORD like '$haslo';";
$sql_login = "SELECT LOGIN FROM `users` WHERE EMAIL like '$email';";
$sql_id = "SELECT ID FROM `users` WHERE EMAIL like '$email';";

$result_email=$conn->query($sql_email);
$result_haslo=$conn->query($sql_haslo);
$result_login=$conn->query($sql_login);
$result_id=$conn->query($sql_id);

$wlasciwy_mail = 0;
$wlasciwe_haslo = 0;
$wlasciwy_login = 0;
$wlasciwe_id = 0;


while ($row = $result_email->fetch_assoc()) {
    $wlasciwy_mail=$row['EMAIL'];
}

while ($www = $result_haslo->fetch_assoc()) {
    $wlasciwe_haslo=$www['PASSWORD'];
}

while ($l = $result_login->fetch_assoc()) {
    $wlasciwy_login=$l['LOGIN'];
}
while ($i = $result_id->fetch_assoc()) {
    $wlasciwe_id=$i['ID'];
}


if((isset($wlasciwy_mail) && $wlasciwy_mail == $email) && (isset($wlasciwe_haslo) && $wlasciwe_haslo==$haslo)){
    $_SESSION['czyZalogowany'] = TRUE;
    $_SESSION['zalogowany_user'] = $wlasciwy_login;
    $_SESSION['email_user'] = $wlasciwy_mail;
    $_SESSION['id_user']= $wlasciwe_id;
    $_SESSION['haslo_user']=$wlasciwe_haslo;
}
else{
    $_SESSION['czyZalogowany'] = FALSE;   
}

echo $_SESSION['zalogowany_user'];


$conn->close();
?>