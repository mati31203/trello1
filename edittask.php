<?php
include_once "utils\db.php";

function getdetails(): bool|array
{
    $db_conn = startConnection();
    if (!is_null($db_conn)):
        $id = $_GET['id'];
        $stmt = $db_conn->prepare("SELECT * FROM tasks WHERE id='".$id."'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    endif;
    return [];
}

$details = getdetails();

if (!empty($_POST['edit'])):
    if (!empty($_POST['name'])):
        switch ($_POST['edit']):
            case (!empty($_POST['edit'])):
                $taskname = $_POST['name'];
                $taskdesc = $_POST['description'];
                $button = $_POST['edit'];
                foreach($details as $task): $id=$task['id']; endforeach;
                foreach($_FILES as $array): $size = $array['size']; endforeach;

                if ($size == 0):
                        foreach($details as $task): $filename = $task['picture']; endforeach;
                        edittask ($taskname, $taskdesc, $filename, $id);
                        header("Location: details.php"."?id=".$task['id']);
                    
                elseif ($size > 0):
                        foreach($details as $task): $filename = $task['picture']; endforeach;
                        unlink("images/".$filename);
                        $filename = $_FILES['picture123']['name'];
                        $tempname = $_FILES['picture123']['tmp_name'];    
                        $fileType = pathinfo($filename,PATHINFO_EXTENSION);
                        $filename = sha1(rand(1000,999999999999999)."-".date('d-m-y h:i:s')."-".$_FILES['picture123']['name']).".".$fileType;
                        $folder = "images/".$filename;
                        $allowTypes = array('jpg', 'JPG','png', 'PNG', 'jpeg', 'JPEG', NULL);

                        if (in_array($fileType, $allowTypes)):
                            move_uploaded_file($tempname, $folder);
                            edittask ($taskname, $taskdesc, $filename, $id);
                            
                            foreach($details as $task): $task['id']; endforeach;
                            header("Location: details.php"."?id=".$task['id']);
                        else:
                            echo "Add a file with any of these extensions: 'jpg', 'png', 'jpeg'. <br><br>";
                        endif;
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
    <title>Trello_trial - Edit Task</title>
    <link rel="stylesheet" href="addtask_style.css">
</head>

<body>
    
<div class="all form">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="all input">Name: <br><textarea name="name"><?php foreach($details as $task): echo $task['name']; endforeach; ?></textarea>
            </div>
            
            <div class="all input">Picture: <br><input type="file" name="picture123"><br><br>
                <?php foreach($details as $task):
                    $path = "images/".$task['picture'];
                    echo "<img src='".$path."'>";
                endforeach; ?>
            </div>
            
            <div class="all input">Description: <br><textarea name="description"><?php foreach($details as $task): echo $task['description']; endforeach; ?></textarea>
            </div>
            <input type="submit" name="edit" value="Edit task">
            <div class="allbuttons"><a href="details.php?id=<?php echo $task['id']; ?>">Back</a></div>
        </form>
    </div>
</body>
</html>
