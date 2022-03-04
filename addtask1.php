<?php
include_once "utils\db.php";
if (!empty($_POST['add'])):
    switch ($_POST['add']):
        case (!empty($_POST['add'])):
            $taskname = $_POST['name'];
            $taskdesc = $_POST['description'];
            $button = $_POST['add'];

            $tasks = position();
            foreach($tasks as $position1):
                if ($position1['MAX(position)'] === NULL)
                {
                    $position = 1;
                }
                else
                {
                    $position = $position1['MAX(position)'] + 1;
                }
            endforeach;

            create($taskname, $taskdesc, '', $position);
            header("Location: index.php");
            break;
    endswitch;
endif; 
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial</title>
    <link rel="stylesheet" href="addtask_style.css">
</head>

<body>
    <div id="form">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="input" id="name">Name: <br><textarea name="name" id="textname"></textarea></div>
            <div class="input" id="picture">Picture: <br><input type="file" name="picture"></div>
            <div class="input" id="description">Description: <br><textarea name="description" id="textdesc"></textarea></div>
            <div id="button"><input type="submit" name="add" value="Add task"></div>
        </form>
    </div>
</body>
</html>