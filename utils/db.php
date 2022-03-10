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
        $stmt = $db_conn->prepare('SELECT * FROM `tasks` ORDER BY `tasks`.`position` ASC' );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return [];
}

function create($name, $description, $picture, $position)
{
    $db_conn = startConnection();
    {
        $stmt = $db_conn->prepare("INSERT INTO tasks (name, picture, description, position) VALUES(:name, :picture, :description, :position)");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('picture', $picture);
        $stmt->bindParam('description', $description);
        $stmt->bindParam('position', $position);

        $stmt->execute(); // on w tym momencie dodaje wpis do bazy
    }

    return [];
}

function getposition() : bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)) {
        $stmt = $db_conn->prepare("SELECT MAX(position) FROM `tasks`");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return [];
}

function setposition()
{
    $positions = getposition();
    foreach($positions as $maxposition):
        if ($maxposition['MAX(position)'] === NULL):
            $position = 1;
            return $position;
        else:
            $position = $maxposition['MAX(position)'] + 1;
            return $position;
        endif; 
    endforeach;
}

function edittask($name, $description, $filename, $id)
{
    $db_conn = startConnection();
    {
        $picture = $filename;
        $stmt = $db_conn->prepare("UPDATE tasks SET name = :name, picture = :picture, description = :description WHERE tasks.id = :id");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('picture', $picture);
        $stmt->bindParam('description', $description);
        $stmt->bindParam('id', $id);

        $stmt->execute();
    }

    return [];
}
