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
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial - Details</title>
    <link rel="stylesheet" href="addtask_style.css">
</head>

<body>
    <div class="all form">
        <div id="pic">
            <?php foreach($details as $task):
                $path = "images/".$task['picture'];
                echo "<img src='".$path."'>";
            endforeach; ?>
        </div>

        <div class="all input">
            Name:<br>
            <?php foreach($details as $task): 
                echo $task['name'];
            endforeach;?>
        </div>

        <div class="all input">
            Description:<br>
            <?php foreach($details as $task):
                echo $task['description'];
            endforeach; ?>
        </div>

        <div class="allbuttons"><a href="deletetask.php?id=<?php echo $task['id'];?>&position=<?php echo $task['position'];?>">Delete</a></div>
        <div class="allbuttons"><a href="edittask.php">Edit</a></div>
        <div class="allbuttons"><a href="index.php">Back</a></div>
    </div>

</body>
</html>
