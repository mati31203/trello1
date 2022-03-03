<?php

function connection()
{
    $db_conn = new PDO("mysql:host=localhost;dbname=trello_trial", "root", "");

    try{
        $db_conn= new PDO("mysql:host=localhost;dbname=trello_trial", "root", "");
    } catch (PDOException $e){
        echo "Błąd połączenia z bazą danych";
    }
    return $db_conn;
}
connection();
