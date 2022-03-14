<?php
include_once "utils\db.php";
if (!empty($_POST['add'])):
    if (!empty($_POST['name'])):
        $taskname = $_POST['name'];
        $taskdesc = $_POST['description'];
        $position = setposition();

        $filename = $_FILES["picture"]["name"];
        $tempname = $_FILES["picture"]["tmp_name"];
        $fileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $filename = sha1(rand(1000,999999999999999)."-".date('d-m-y h:i:s')."-".$filename).".".$fileType;
        $folder = "images/".$filename;
        $allowTypes = array('jpg', 'png', 'jpeg');

        if (in_array($fileType, $allowTypes)):
            move_uploaded_file($tempname, $folder);

            create($taskname, $taskdesc, $filename, $position);
            header("Location: index.php");
        else:
            echo "Add a file with any of these extensions: 'jpg', 'png', 'jpeg'. <br><br>";
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
    <div class="all form">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="all input">Name: <br><textarea name="name"></textarea></div>
            <div class="all input">Picture: <br><input type="file" name="picture"></div>
            <div class="all input">Description: <br><textarea name="description"></textarea></div>
            <input type="submit" name="add" value="Add task">
            <div class="allbuttons"><a href="index.php">Back</a></div>
        </form>
    </div>
</body>
</html>