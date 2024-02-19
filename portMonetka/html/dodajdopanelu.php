<?php
session_start();
require("../php/connect.php");
//zmienne
$email=$_SESSION['email_user'];
$transakcja= $_POST['transakcja'];
$idusera= $_SESSION['id_user'];
$opis= $_POST['opis'];

// $food = $_POST['food'];

$select = $_POST['jelop'] ?? '';
$result = match ($select) {
    'przychod' => 'przychod',
    'transport' => 'wydatki_transport',
    'zakupy' => 'wydatki_zakupy',
    'zdrowie' => 'wydatki_zdrowie',
    'aktywnosc' => 'wydatki_aktywnosc',
    'jedzenie' => 'wydatki_jedzenie',
    'wynajem' => 'wydatki_wynajem',
    default => 'unknown value',
};

$sql_przychod = "UPDATE users SET $result= $result+$transakcja WHERE  EMAIL like '$email';";
$przychod_result=$conn->query($sql_przychod);
$sql_dodawanie = "INSERT INTO wydatkihistoria (id,wydatekNazwa,kwota,idUser,Opis) VALUES (NULL, '$select', '$transakcja', '$idusera','$opis');";
$dodawanie_result=$conn->query($sql_dodawanie);


header('Location: ../html/analityka.php');


?>