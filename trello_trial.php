<?php

$serwer = "localhost";
$user = "root";
$pass = "";
$base = "trello_trial";

$db = @new mysqli($serwer, $user, $pass, $base);

if ($db->connect_error) 
{
    die("<br>Błąd połączenia z bazą danych: ". $db->connect_error. ". <br>");
}

else
{
    echo "<br>Nawiązano połączenie z bazą danych: ". $base. ". <br>";
    $login = !empty($_POST['login']) ? htmlspecialchars(stripslashes(trim($_POST['login']))) : false;
    $haslo = !empty($_POST['haslo']) ? htmlspecialchars(stripslashes(trim($_POST['haslo']))) : false;
    $powtorz = !empty($_POST['powtorz']) ? htmlspecialchars(stripslashes(trim($_POST['powtorz']))) : false;
    
}


$db->close();

?>
