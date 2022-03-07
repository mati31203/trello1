<?php
include_once "utils\db.php";
if (!empty($_POST['add'])):
    if (!empty($_POST['name'])):
        switch ($_POST['add']):
            case (!empty($_POST['add'])):
                $taskname = $_POST['name'];
                $taskdesc = $_POST['description'];
                $button = $_POST['add'];

                $positions = getposition();
                foreach($positions as $maxposition):
                    if ($maxposition['MAX(position)'] === NULL):
                        $position = 1;
                    else:
                        $position = $maxposition['MAX(position)'] + 1;
                    endif; 
                endforeach;

                $filename = $_FILES["picture"]["name"];
                $tempname = $_FILES["picture"]["tmp_name"];    
                $fileType = pathinfo($filename,PATHINFO_EXTENSION);
                $filename = sha1(rand(1000,999999999999999)."-".date('d-m-y h:i:s')."-".$_FILES["picture"]["name"]).".".$fileType;
                $folder = "images/".$filename;
                $allowTypes = array('jpg', 'JPG','png', 'PNG', 'jpeg', 'JPEG', NULL);

                if (in_array($fileType, $allowTypes)):
                    move_uploaded_file($tempname, $folder);

                    create($taskname, $taskdesc, $filename, $position);
                    header("Location: index.php");
                else:
                    echo "Add a file with any of these extensions: 'jpg', 'png', 'jpeg'. <br><br>";
                endif;
                break;
        endswitch;
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