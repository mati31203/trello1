<?php
    include_once "utils\db.php";
    $tasks = getAll();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="list all">
        <div class="header all">Tasks:</div>
    
        <?php foreach($tasks as $task): ?>
            <div class="task all">
                <?=$task['name'];?>
            </div>
        <?php endforeach ?>
        
        <div class="all" id="addbutton"><a href="addtask.php">Add task</a></div>
    </div>

</body>
</html>
