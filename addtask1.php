<?php
include_once "utils\db.php";
if (!empty($_POST['add']) && !empty($_POST['name'])):
    switch ($_POST['add']):
        case (!empty($_POST['add'])):
            $taskname = $_POST['name'];
            $taskdesc = $_POST['description'];
            $button = $_POST['add'];

            $positions = getposition();
            foreach($positions as $maxposition):
                if ($maxposition['MAX(position)'] === NULL)
                {
                    $position = 1;
                }
                else
                {
                    $position = $maxposition['MAX(position)'] + 1;
                }
            endforeach;

            $filename = sha1($_FILES["picture"]["name"]);
            $tempname = $_FILES["picture"]["tmp_name"];    
            $folder = "images/".$filename;
            move_uploaded_file($tempname, $folder);

            create($taskname, $taskdesc, $filename, $position);
            //header("Location: index.php");
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