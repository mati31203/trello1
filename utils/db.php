<?php

function startConnection(): ?PDO
{
    try
    {
        $db_conn= new PDO("mysql:host=localhost;dbname=trello_trial", "root", "");
        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
        return null;
    }
    return $db_conn;
}

function getAll(): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)) {
        $stmt = $db_conn->prepare('SELECT * FROM tasks');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return [];
}
