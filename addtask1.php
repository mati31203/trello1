<?php

include_once "utils\db.php";

if (!empty($_POST['add'])):
    if (!empty($_POST['name'])):
        $id_l = $_GET['id_l'];
        $taskname = $_POST['name'];
        $taskdesc = $_POST['description'];
        $position = setposition($id_l);
        $filename = addNewPicture($_FILES);

        if ($filename == "error"):
            echo "Add a file with any of these extensions: 'jpg', 'png', 'jpeg'. <br><br>";

        else:
            create($taskname, $taskdesc, $filename, $position, $id_l);
            header("Location: index.php");
        endif;
    else:
        echo "Add name of a task <br><br>";
    endif;
endif;

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial - Add Task</title>
    <link rel="stylesheet" href="addtask_style.css">
</head>

<body>
<!--
    <div class="all form">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="all input">Name: <br><textarea name="name"></textarea></div>
            <div class="all input">Picture: <br><input type="file" name="picture"></div>
            <div class="all input">Description: <br><textarea name="description"></textarea></div>
            <input type="submit" name="add" value="Add task">
            <div class="allbuttons"><a href="index.php">Back</a></div>
        </form>
    </div>
    -->
</body>
</html>