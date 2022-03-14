<?php

include_once "utils\db.php";
$details = getdetails($_GET['id']);

if (!empty($_POST['edit'])):
    if (!empty($_POST['name'])):
        if (!empty($_POST['edit'])):
            $taskname = $_POST['name'];
            $taskdesc = $_POST['description'];
            $button = $_POST['edit'];
            $id=$details['id'];

            if(!empty($_FILES["picture"]["name"])):
                $filename = $details['picture'];
                unlink("images/".$filename);
                $filename = $_FILES['picture']['name'];
                $tempname = $_FILES['picture']['tmp_name'];    
                $fileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                $filename = sha1(rand(1000,999999999999999)."-".date('d-m-y h:i:s')."-".$_FILES['picture']['name']).".".$fileType;
                $folder = "images/".$filename;
                $allowTypes = array('jpg', 'png', 'jpeg');

                if (in_array($fileType, $allowTypes)):
                    move_uploaded_file($tempname, $folder);
                    edittask ($taskname, $taskdesc, $filename, $id);
                    
                    header("Location: details.php"."?id=".$details['id']);
                else:
                    echo "Add a file with any of these extensions: 'jpg', 'png', 'jpeg'. <br><br>";
                endif;
                
            else:                    
                $filename = $details['picture'];
                edittask ($taskname, $taskdesc, $filename, $id);
                header("Location: details.php"."?id=".$details['id']);

            endif; 
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


