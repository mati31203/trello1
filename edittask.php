<?php

include_once "utils\db.php";
$details = getdetails($_GET['id']);

if (!empty($_POST['edit'])):
    if (!empty($_POST['name'])):
        $taskname = $_POST['name'];
        $taskdesc = $_POST['description'];
        $id=$details['id'];
        $filename = EditPicture($_FILES, $id);

        if ($filename == "error"):
            echo "Add a file with any of these extensions: 'jpg', 'png', 'jpeg'. <br><br>";

        else:
            edittask ($taskname, $taskdesc, $filename, $id);
            $details = getdetails($_GET['id']);
            //header("Location: details.php?id=".$id);
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
    <title>Trello_trial - Edit Task</title>
    <link rel="stylesheet" href="addtask_style.css">
</head>

<body>
    
<div class="all form">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="all input">Name: <br><textarea name="name"><?=$details['name'];?></textarea>
            </div>
            
            <div class="all input">Picture: <br><input type="file" name="picture"><br><br>
                <?php
                    $path = "images/".$details['picture'];
                    echo "<img src='".$path."'>";
                ?>
            </div>
            
            <div class="all input">Description: <br><textarea name="description"><?=$details['description'];?></textarea>
            </div>
            <input type="submit" name="edit" value="Edit task">
            <div class="allbuttons"><a href="details.php?id=<?=$details['id'];?>">Back</a></div>
        </form>
    </div>
</body>
</html>


