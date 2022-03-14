<?php

include_once "utils\db.php";
$tasks = getAll();

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div class="all list" >
        <div class="all header">
            Tasks:
        </div>
        <div id="sortable">
                <?php foreach($tasks as $task):?>
                    <div class="all cell" data-id="<?=$task['id'];?>">
                        <div class="all task"><?=$task['name'];?></div>
                        <div class="all" id="detailsbutton"><a href="details.php?id=<?=$task['id']; ?>">Details</a></div>
                    </div>
                <?php endforeach ?>
        </div>
        <div class="all" id="addbutton">
            <a href="addtask1.php">Add task</a>
        </div>
        <div>
            <form action="reorder.php" method="POST">
                <input type="hidden" name="tasks_order">
                <input type="submit" name="reorder" value="Save order">
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function ()
        {
            $("#sortable").sortable(
            {
                stop: function ()
                {
                    var tasksIds = [];
                    $('.cell').each(function ()
                    {
                        tasksIds.push($(this).data('id'));
                    });
                    $('[name=tasks_order]').val(tasksIds.join(';'));
                }
            });
        });
    </script>
</body>
</html>


