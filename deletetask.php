<?php
include "utils\db.php";

function deleteTask(): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $id = $_GET['id'];
        $stmt = $db_conn->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindParam('id', $id);
        $stmt->execute();
    endif;
    return [];
}

deleteTask();

function changePositions(): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $position = $_GET['position'];
        $stmt = $db_conn->prepare("UPDATE `tasks` SET `position` = `position` - 1 WHERE `position` > :position ");
        $stmt->bindParam('position', $position);
        $stmt->execute();
    endif;
    return [];
}

changePositions();

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial - delete</title>
    <link rel="stylesheet" href="addtask_style.css">
<body>

</body>
</html>