<?php



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

            <div class="allbtns" id="deletebtn"><a class="noDecoration" href="addtask1.php">Delete</a></div>
            <div class="allbtns" id="editbtn"><a class="noDecoration" href="edittask.php">Edit</a></div>
        </form>
    </div>
</body>
</html>