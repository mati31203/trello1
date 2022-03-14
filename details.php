<?php

include_once "utils\db.php";
$details = getdetails($_GET['id']);

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
            <?php 
                $path = "images/".$details['picture'];
                echo "<img src='".$path."'>";
            ?>
        </div>

        <div class="all input">
            Name:<br>
            <?php echo $details['name']; ?>
        </div>

        <div class="all input">
            Description:<br>
            <?php echo $details['description']; ?>
        </div>

        <div class="allbuttons"><a href="deletetask.php?id=<?=$details['id'];?>&position=<?=$details['position'];?>">Delete</a></div>
        <div class="allbuttons"><a href="edittask.php?id=<?=$details['id'];?>">Edit</a></div>
        <div class="allbuttons"><a href="index.php">Back</a></div>
    </div>

</body>
</html>
