<?php

include_once "utils\db.php";

if (!empty($_POST['add'])):
    if (!empty($_POST['listname'])):
        $listname = $_POST['listname'];
        addList($listname);
        header("Location: index.php");
    else:
        echo "Add name of a list <br><br>";
    endif;
endif;

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial - Add List</title>
    <link rel="stylesheet" href="addtask_style.css">
</head>

<body>
    <div class="all form">
        <form action="" method="POST">
            <div class="all input">Name: <br><input type="text" name="listname"></div>
            <input type="submit" name="add" value="Add list">
            <div class="allbuttons"><a href="index.php">Back</a></div>
        </form>
    </div>
</body>
</html>