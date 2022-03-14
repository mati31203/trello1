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
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare('SELECT * FROM `tasks` ORDER BY `tasks`.`position` ASC' );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    endif;
}

function create($name, $description, $picture, $position)
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("INSERT INTO tasks (name, picture, description, position) VALUES(:name, :picture, :description, :position)");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('picture', $picture);
        $stmt->bindParam('description', $description);
        $stmt->bindParam('position', $position);
        $stmt->execute();
    endif;
}

function reorderTasks($order)
{
    $position = 1;
    foreach ($order as $id):
        $db_conn = startConnection();
        if(!is_null($db_conn)):
            $stmt = $db_conn->prepare("UPDATE tasks SET position = :position WHERE tasks.id = :id");
            $stmt->bindParam('position', $position);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            $position++;
        endif;
    endforeach;
}

function getposition(): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("SELECT MAX(position) FROM `tasks`");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    endif;
}

function setposition()
{
    $positions = getposition();
        if ($positions['MAX(position)'] === NULL):
            $position = 1;
            return $position;
        else:
            $position = $positions['MAX(position)'] + 1;
            return $position;
        endif; 
}

function getdetails($id): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("SELECT * FROM tasks WHERE  id = :id");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    endif;
}

function getpicture($id) : bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("SELECT picture FROM `tasks` WHERE id = :id");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    endif;
}

function changePositions($position)
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $stmt = $db_conn->prepare("UPDATE `tasks` SET `position` = `position` - 1 WHERE `position` > :position ");
        $stmt->bindParam('position', $position);
        $stmt->execute();
    endif;
}

function deleteTask($id): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $pictures = getpicture($id);
        unlink("images/".$pictures['picture']);

        $stmt = $db_conn->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    endif;
}

function edittask($name, $description, $filename, $id)
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $picture = $filename;
        $stmt = $db_conn->prepare("UPDATE tasks SET name = :name, picture = :picture, description = :description WHERE tasks.id = :id");
        $stmt->bindParam('name', $name);
        $stmt->bindParam('picture', $picture);
        $stmt->bindParam('description', $description);
        $stmt->bindParam('id', $id);
        $stmt->execute();
    endif;
}


